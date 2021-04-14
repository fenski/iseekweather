<?php

    namespace App\Repository;

    use Dnsimmons\OpenWeather\OpenWeather;
    use Illuminate\Support\Collection;

    class WeatherRepository implements WeatherRepositoryInterface
    {
        private $service;
        private $units = 'metric';
        private $days_default = 5;

        public function __construct()
        {
            $this->service = new OpenWeather();
        }

        /**
         * @param string $cityKey
         * @param int|null $days
         * @return Collection
         */
        public function forecastByCityKey(string $cityKey, int $days = null, bool $includeToday = true): Collection
        {
            // Add max days validation
            // Add city validation
            // Get lat/long from city name

//            $data = $this->service->getForecastWeatherByCityName($cityName, $this->units);
            $days = $days || $this->days_default;

            // If we don't want to include today as one of the days, skip the first result
            $start_index = $includeToday ? 0 : 1;

            $data = $this->service->getOnecallWeatherByCoords('-34.928497', '138.600739', $this->units);
            $days = array_slice($data['daily'], $start_index, $days ?? $this->days_default);

            return collect($days);
        }
    }