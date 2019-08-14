<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = new User([
            'name'     => 'Teste',
            'email'    => 'test@email.com',
            'password' => '123456'
        ]);

        $user->save();
    }

    /**
     * @test
     */
    public function canLoginUser()
    {
        $response = $this->post('api/v1/login', [
            'email'    => 'test@email.com',
            'password' => '123456'
        ]);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }

    /**
     * @test
     */
    public function cannotLoginInvalidUser()
    {
        $response = $this->post('api/v1/login', [
            'email'    => 'test@email.com',
            'password' => 'notlegitpassword'
        ]);

        $response->assertStatus(401);
        $response->assertSeeText('Unauthorized');
        $response->assertJsonStructure(['message']);
    }
}
