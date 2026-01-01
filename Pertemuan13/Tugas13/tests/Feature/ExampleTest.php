<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        // Karena '/' redirect ke 'bukus.index', test redirect
        $response = $this->get('/');
        $response->assertRedirect(route('bukus.index'));
    }
}