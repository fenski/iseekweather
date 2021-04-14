<?php

    namespace App\Repository;

    use Dnsimmons\OpenWeather\OpenWeather;
    use Illuminate\Support\Collection;
    use function MongoDB\BSON\toJSON;

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

            // Test data to ensure I don't kill my API uses
            // TODO: Remove this
            return collect(json_decode('[{"datetime":{"timestamp":1618367400,"timestamp_sunrise":1618348079,"timestamp_sunset":1618388607,"formatted_date":"14\/04\/2021","formatted_day":"Wednesday","formatted_time":"02:30 AM","formatted_sunrise":"09:07 PM","formatted_sunset":"08:23 AM"},"condition":{"name":"Rain","desc":"light rain","icon":"https:\/\/openweathermap.org\/img\/w\/10d.png"},"forecast":{"temp":19,"temp_min":16,"temp_max":20,"pressure":1017,"humidity":51}}]'));

            $data = $this->service->getOnecallWeatherByCoords('-34.928497', '138.600739', $this->units);
            $days = array_slice($data['daily'], $start_index, $days ?? $this->days_default);

            return collect($days);
        }
    }