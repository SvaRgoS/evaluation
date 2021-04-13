<?php


namespace Tests\Feature;

use App\Http\Resources\ContactsDetailResource;
use App\Models\Contact;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthUserTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    protected $seed = true;

    /** test */
    public function testSignUp()
    {
        $path = '/api/auth/sign-up';
        $params = [
            'name' => $this->faker->name(),
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'role_id' => RoleSeeder::ROLE_READER
        ];

        $response = $this->json('POST', $path, $params);

        $response->assertStatus(201);
    }

    /** test */
    public function testSignIn()
    {
        $path = '/api/auth/sign-in';
        $response = $this->json('POST', $path . '/', [
            'email' => env('API_USER_EMAIL'),
            'password' => env('API_USER_PASSWORD'),
        ]);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token', 'token_type', 'expires_in'
            ]);
    }

    /** test */
    public function testRedactorSignIn()
    {
        //Arrange
        $path = '/api/auth/sign-in';
        $redactor = User::where('role_id', RoleSeeder::ROLE_REDACTOR)->firstOrFail();
        $redactor->password = env('API_USER_PASSWORD');
        $redactor->save();

        //Act
        $response = $this->json('POST', $path . '/', [
            'email' => $redactor->email,
            'password' => env('API_USER_PASSWORD'),
        ]);

        //Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token', 'token_type', 'expires_in'
            ]);
    }


    /** test */
    public function testSignOut()
    {
        $path = '/api/auth/sign-out';
        $response = $this->json('GET', $path . '/');
        $response->assertStatus(200);
    }
}
