<?php

namespace Tests\Feature;

use App\Repository\WeatherRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ForecastReportTest extends TestCase
{
    /**
     * Ensure success with no data supplied
     *
     * @return void
     */
    public function testConsoleCommand()
    {
        // 1 correct city
        $this->artisan('report:forecast "adelaide"')
            ->assertExitCode(0);

        // 2 correct cities
        $this->artisan('report:forecast "adelaide,melbourne"')
            ->assertExitCode(0);

        // 2 cities, 1 incorrect
        $this->artisan('report:forecast "adelaide,bisbane"')
            ->assertExitCode(0);
    }
}
