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
            $city = trim($city);

            try {
                $results = $this->weatherRepository->forecastByCityName($city);
            } catch (\Exception $e) {
                $this->warn($e->getMessage());
                $this->newLine();
                continue;
            }

            $this->info("Forecast for $city:");

            $headers = [
                'Day',
                'Conditions',
                'Max Temp',
                'Min Temp',
            ];

            $rows = [];

            foreach ($results as $key => $result) {
                $rows[] = [
                    $result['datetime']['formatted_day'] . ' (' . $result['datetime']['formatted_date'].')',
                    $result['condition']['name'] . ": " . $result['condition']['desc'],
                    $result['forecast']['temp_max'] . '˚C',
                    $result['forecast']['temp_min'] . '˚C',
                ];
            }

            $this->table($headers, $rows);

            $this->newLine();
        }

        return 0;
    }
}
