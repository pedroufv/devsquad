<?php

namespace Tests\Feature;

use Tests\TestCase;

class CorsTest extends TestCase
{

    /**
     * check if route user is not allowed by cors
     * @test
     * @return void
     */
    public function routeUserIsNotAllowedTest()
    {
        config(['cors.allowedOrigins' => ['']]);

        $response = $this->get('/api/v1/users', ['HTTP_ORIGIN' => 'test.com']);

        $response->assertStatus(403);
        $response->assertSeeText("Not allowed in CORS policy");
    }

    /**
     * check if route user is allowed by cors
     * @test
     * @return void
     */
    public function routeUserIsAllowedTest()
    {
        config(['cors.allowedOrigins' => ['test.com']]);

        $response = $this->get('/api/v1/users', ['HTTP_ORIGIN' => 'test.com']);

        $response->assertStatus(200);
    }
}
