<?php

namespace App\Console\Commands;

use App\Repository\WeatherRepository;
use Illuminate\Console\Command;

class GenerateForecastReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:forecast {cities}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a forecast report for a comma separated list of cities.';

    /**
     * The amount of days to forecast.
     *
     * @var int
     */
    private $days = 5;

    /**
     * @var WeatherRepository
     */
    private $weatherRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(WeatherRepository $weatherRepository)
    {
        $this->weatherRepository = $weatherRepository;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cities = explode(',', $this->argument('cities'));

        // Validate cities against soon-to-be repo
        foreach ($cities as $city) {

            try {
                $results = $this->weatherRepository->forecastByCityName($city, $this->days);
            } catch (\Exception $e) {
                $this->info("The city '$city' is not resolvable.'");
                return 0;
            }

            $this->info("{$this->days} day forecast for $city:");

            foreach ($results as $key => $result) {
                $this->info($key);
            }
        }

        return 0;
    }
}
