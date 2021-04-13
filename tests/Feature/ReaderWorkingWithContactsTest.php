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

class RewaderWorkingWithContactsTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    private $userRole = RoleSeeder::ROLE_READER;


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
    public function testReaderCanReadContact()
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
    public function testReaderCannotCreateContact()
    {
        //Arrange
        $routeName = 'contact.store';
        $data = Contact::factory()->raw();

        //Act
        $response = $this->postJson(
            route($routeName),
            $data,
        );

        //Assert
        $response->assertStatus(Response::HTTP_FORBIDDEN);
        $isModelHoweverExist = Contact::where($data)->count() > 0;
        $this->assertFalse($isModelHoweverExist);
    }

    /** test */
    public function testReaderCannotUpdateContact()
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
        $response->assertStatus(Response::HTTP_FORBIDDEN);
        $this->assertNotEquals($expectedEmail, $contactModel->email);
    }

    /** test */
    public function testReaderCannotRemoveContact()
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
