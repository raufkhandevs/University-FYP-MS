<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_check_update()
    {
        $response1 = $this->get('/test/Name1');
        $response2 = $this->get('/test/Name2');

        $response1->assertStatus(200);
        $response2->assertStatus(200);
    }
}
