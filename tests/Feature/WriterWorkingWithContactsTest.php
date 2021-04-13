<?php

namespace Tests\Feature;

use App\Http\Resources\ContactsDetailResource;
use App\Models\Contact;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Response;

class WriterWorkingWithContactsTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    private $userRole = RoleSeeder::ROLE_WRITER;

    protected function setUp(): void
    {
        parent::setUp();
        $this->json('GET', '/api/auth/sign-out/');
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->getBearerToken(),
            'Accept' => 'application/json'
        ]);
    }

    /**
     * @return string
     */
    private function getBearerToken(): string
    {
        $user = User::where('role_id', $this->userRole)->firstOrFail();
        return JWTAuth::fromUser($user);
    }

    /** test */
    public function testWriterCanReadContact()
    {
        //Arrange
        $routeName = 'contact.show';
        $contactModel = Contact::first();

        //Act
        $response = $this->getJson(
            route($routeName, [$contactModel]),
        );

        //Assert
        $response->assertStatus(Response::HTTP_OK);
    }


    /** test */
    public function testWriterCanCreateContact()
    {
        //Arrange
        $routeName = 'contact.store';
        $data = Contact::factory()->raw();

        //Act
        $response = $this->postJson(
            route($routeName),
            $data
        );

        //Assert
        $response->assertStatus(Response::HTTP_CREATED);
    }

    /** test */
    public function testWriterCanUpdateContact()
    {
        //Arrange
        $routeName = 'contact.update';
        $contactModel = Contact::firstOrFail();
        $contactModel->email = env('API_USER_EMAIL');

        $data = (new ContactsDetailResource($contactModel))->toArray(null);

        $expectedEmail = env('API_USER_EMAIL');

        //Act
        $response = $this->patchJson(
            route($routeName, [$contactModel]),
            $data,
        );
        $contactModel->refresh();

        //Assert
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals($expectedEmail, $contactModel->email);
    }

    /** test */
    public function testWriterCannotRemoveContact()
    {
        //Arrange
        $routeName = 'contact.destroy';
        $contactModel = Contact::firstOrFail();

        //Act
        $response = $this->deleteJson(
            route($routeName, [$contactModel])
        );

        //Assert
        $response->assertStatus(Response::HTTP_FORBIDDEN);
        $isModelStillExist = Contact::where('id', $contactModel->id)->count() > 0;
        $this->assertTrue($isModelStillExist);
    }
}
