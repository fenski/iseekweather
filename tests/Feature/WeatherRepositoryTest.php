<?php

namespace Tests\Feature;

use App\Repository\WeatherRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class WeatherRepositoryTest extends TestCase
{
    /**
     * Ensure success with no data supplied
     *
     * @return void
     */
    public function testRepositoryLoads()
    {
        $repository = new WeatherRepository();

        $this->assertEquals(get_class($repository), WeatherRepository::class);
        $this->assertEquals(get_class($repository->forecastByCityKey('adelaide-sa')), Collection::class);
    }

    /**
     * Ensure passing a known city returns a 200 page
     *
     * @return void
     */
    public function testCityTest()
    {
        $response = $this->get('/?city=Adelaide');

        $response->assertStatus(200);
    }
}
