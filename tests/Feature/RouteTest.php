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

    /**
     * Ensure passing a known city returns a 200 page
     *
     * @return void
     */
    public function testCityTest()
    {
        $response = $this->get('/adelaide');

        $response->assertStatus(200);
    }

    /**
     * Ensure passing an unknown city returns a 404 page
     *
     * @return void
     */
    public function testIncorrectCityTest()
    {
        $response = $this->get('/radelaide');

        $response->assertStatus(404);
    }
}
