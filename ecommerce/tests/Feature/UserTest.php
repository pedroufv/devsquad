<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;


class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

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
    public function canCreateUser()
    {
        $response = $this->post('api/v1/login', [
            'email'    => 'test@email.com',
            'password' => '123456'
        ]);

        $content = json_decode($response->content());

        $response = $this->post('api/v1/users', [
            'name'     => 'Teste',
            'email'    => 'test2@email.com',
            'password' => '123456'
        ], ['Authorization' => "Bearer {$content->access_token}"]);

        $response->assertStatus(201);
    }
}
