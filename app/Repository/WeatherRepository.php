<?php

    namespace App\Repository;

    use Dnsimmons\OpenWeather\OpenWeather;
    use Illuminate\Support\Collection;

    class WeatherRepository implements WeatherRepositoryInterface
    {
        private $service;
        private $cityRepository;

        // Can create modifiers to this repo to change these default values
        private $units = 'metric';
        private $daysDefault = 5;
        private $includeToday = false;

        public function __construct(CityRepository $cityRepository)
        {
            $this->service = new OpenWeather();
            $this->cityRepository = $cityRepository;
        }

        /**
         * @param string $cityKey
         * @return Collection
         */
        public function forecastByCityKey(string $cityKey): Collection
        {
            $city = $this->cityRepository->findByKey($cityKey);

            if (!$city) {
                throw new \Exception("City with key '$cityKey' does not exist.");
            }

            return $this->forecastByCoordinates($city['coordinates'][0], $city['coordinates'][1]);
        }

        /**
         * @param string $cityName
         * @return Collection
         */
        public function forecastByCityName(string $cityName): Collection
        {
            $city = $this->cityRepository->findByName($cityName);

            if (!$city) {
                throw new \Exception("City with name '$cityName' does not exist.");
            }

            return $this->forecastByCoordinates($city['coordinates'][0], $city['coordinates'][1]);
        }

        /**
         * Call the weather API to return results using the city coordinates
         * @param string $latitude
         * @param string $longitude
         * @return Collection
         */
        public function forecastByCoordinates(string $latitude, string $longitude): Collection
        {
            // Test data to ensure I don't kill my API uses
            // TODO: Remove this
//            return collect(json_decode('[{"datetime":{"timestamp":1618367400,"timestamp_sunrise":1618348079,"timestamp_sunset":1618388607,"formatted_date":"14\/04\/2021","formatted_day":"Wednesday","formatted_time":"02:30 AM","formatted_sunrise":"09:07 PM","formatted_sunset":"08:23 AM"},"condition":{"name":"Rain","desc":"light rain","icon":"https:\/\/openweathermap.org\/img\/w\/10d.png"},"forecast":{"temp":19,"temp_min":16,"temp_max":20,"pressure":1017,"humidity":51}}]'));

            // If we don't want to include today as one of the days, skip the first result
            $startIndex = $this->includeToday ? 0 : 1;

            $data = $this->service->getOnecallWeatherByCoords($latitude, $longitude, $this->units);
            $days = array_slice($data['daily'], $startIndex, $this->daysDefault);

            return collect($days);
        }
    }