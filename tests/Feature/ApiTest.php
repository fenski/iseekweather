<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * Ensure cities API returns data
     *
     * @return void
     */
    public function testCitiesApi()
    {
        $response = $this->get('/api/cities/get');

        $response->assertStatus(200);
    }

    /**
     * Ensure success with no data supplied
     *
     * @return void
     */
    public function testForecastApi()
    {
        $response = $this->get('/api/forecast/get?cityName=Adelaide');

        $response->assertStatus(200);
    }
}
