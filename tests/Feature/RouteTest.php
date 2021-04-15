<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * Ensure success with no data supplied
     *
     * @return void
     */
    public function testNoCityTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
