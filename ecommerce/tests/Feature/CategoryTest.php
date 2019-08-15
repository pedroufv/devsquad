<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $token;

    protected function setUp(): void
    {
        parent::setUp();

        $user = new User([
            'name'     => $this->faker->name,
            'email'    => $email = $this->faker->email,
            'password' => $password = $this->faker->password
        ]);
        $user->save();

        $response = $this->post('api/v1/login', [
            'email'    => $email,
            'password' => $password
        ]);
        $this->token = json_decode($response->content())->access_token;
    }

    /**
     * @test
     */
    public function canGetCategories()
    {
        factory(Category::class, 5)->create();

        $response = $this->get('api/v1/categories', ['Authorization' => "Bearer {$this->token}"]);

        $response->assertStatus(200);

        $this->assertCount(5, $response->getOriginalContent());
    }
}
