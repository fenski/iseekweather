<?php

namespace Tests\Feature;

use App\Repository\CityRepository;
use Illuminate\Support\Collection;
use Tests\TestCase;

class CityRepositoryTest extends TestCase
{
    /**
     * Ensure success with no data supplied
     *
     * @return void
     */
    public function testRepositoryLoads()
    {
        $repository = app(CityRepository::class);

        $this->assertEquals(get_class($repository), CityRepository::class);
    }

    /**
     * Ensure passing a known city returns a 200 page
     *
     * @return void
     */
    public function testCitiesTest()
    {
        $repository = app(CityRepository::class);

        // Correct city
        $this->assertEquals($repository->findByKey('adelaide')['name'], 'Adelaide');
        $this->assertEquals($repository->findByName('Adelaide')['key'], 'adelaide');

        // Incorrect city
        $this->assertNull($repository->findByKey('radelaide'));
        $this->assertNull($repository->findByName('Radelaide'));
    }
}
