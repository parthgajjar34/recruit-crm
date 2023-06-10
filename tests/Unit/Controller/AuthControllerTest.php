<?php
namespace Tests\Unit\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use Tests\TestCase;
use Config;
use JWTAuth;

class AuthControllerTest extends TestCase
{
    /**
    * Login as default API user and get token back.
    *
    * @return void
    */
    public function testLogin()
    {
        $baseUrl = Config::get('app.url') . '/api/auth/login';
        $email = Config::get('api.apiEmail');
        $password = Config::get('api.apiPassword');

        $response = $this->json('POST', $baseUrl . '/', [
            'email' => $email,
            'password' => $password
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'access_token', 'token_type', 'expires_in'
            ]);
    }

    /**
    * Test logout.
    *
    * @return void
    */
    public function testLogout()
    {
        $user = User::where('email', Config::get('api.apiEmail'))->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = Config::get('app.url') . '/api/auth/logout?token=' . $token;

        $response = $this->json('POST', $baseUrl, []);

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'message' => 'User successfully signed out'
            ]);
    }

    /**
    * Test token refresh.
    *
    * @return void
    */
    public function testRefresh()
    {
        $user = User::where('email', Config::get('api.apiEmail'))->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = Config::get('app.url') . '/api/auth/refresh?token=' . $token;

        $response = $this->json('POST', $baseUrl, []);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'access_token', 'token_type', 'expires_in'
            ]);
    }
}