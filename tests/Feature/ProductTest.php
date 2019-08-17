<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
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

        factory(Category::class, 5)->create();
    }

    /**
     * @test
     */
    public function checkRequiredFields()
    {
        $response = $this->post('api/v1/products', [
            'image' => $this->faker->url,
        ], ['Authorization' => "Bearer {$this->token}"]);

        $response->assertSessionHasErrors('name');
        $response->assertSessionHasErrors('description');
        $response->assertSessionHasErrors('price');
        $response->assertSessionHasErrors('category_id');
    }

    /**
     * @test
     */
    public function canCreateProduct()
    {
        $this->withoutExceptionHandling();

        $categories = Category::all('id')->pluck('id')->all();

        $response = $this->post('api/v1/products', [
            'name'  => $this->faker->name,
            'description' => $this->faker->text,
            'price' => $this->faker->randomNumber(2),
            'category_id' => $this->faker->randomElement($categories),
        ], ['Authorization' => "Bearer {$this->token}"]);

        $response->assertStatus(201);
    }

    /**
     * @test
     */
    public function cannotCreateProductsWithSameName()
    {
        $categories = Category::all('id')->pluck('id')->all();

        $this->post('api/v1/products', [
            'name'  => $name = $this->faker->name,
            'description' => $this->faker->text,
            'price' => $this->faker->randomNumber(2),
            'category_id' => $this->faker->randomElement($categories),
        ], ['Authorization' => "Bearer {$this->token}"])->assertStatus(201);

        $response = $this->json('POST', 'api/v1/products', [
            'name'  => $name,
            'description' => $this->faker->text,
            'price' => $this->faker->randomNumber(2),
            'category_id' => $this->faker->randomElement($categories),
        ], ['Authorization' => "Bearer {$this->token}"]);

        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function canCreateProductSameNameDeletedProduct()
    {
        $categories = Category::all('id')->pluck('id')->all();

        $response = $this->post('api/v1/products', [
            'name'  => $name = $this->faker->name,
            'description' => $this->faker->text,
            'price' => $this->faker->randomNumber(2),
            'category_id' => $this->faker->randomElement($categories),
        ], ['Authorization' => "Bearer {$this->token}"])->assertStatus(201);

        $id = $response->getOriginalContent()['data']['id'];

        Product::destroy($id);

        $this->assertDatabaseHas('products', [
            'id' => $id,
        ]);

        $this->json('POST', 'api/v1/products', [
            'name'  => $name,
            'description' => $this->faker->text,
            'price' => $this->faker->randomNumber(2),
            'category_id' => $this->faker->randomElement($categories),
        ], ['Authorization' => "Bearer {$this->token}"])->assertStatus(201);
    }
}
