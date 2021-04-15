<?php

    namespace App\Repository;

    use Dnsimmons\OpenWeather\OpenWeather;
    use Illuminate\Support\Collection;

    class WeatherRepository implements WeatherRepositoryInterface
    {
        private $service;
        private $cityRepository;

        // Can create modifiers to this repo to change these default values for specific calls vs. global config change
        private $units;
        private $daysDefault;
        private $includeToday;

        public function __construct(CityRepository $cityRepository)
        {
            $this->service = new OpenWeather();
            $this->cityRepository = $cityRepository;

            $this->daysDefault = config('weather.default-days');
            $this->includeToday = config('weather.include-today');
            $this->units = config('weather.units');
        }

        /**
         * Use the city key to return the forecast
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
         * Use the full city name to return the forecast
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
            // If we don't want to include today as one of the days, skip the first result
            $startIndex = $this->includeToday ? 0 : 1;

            $data = $this->service->getOnecallWeatherByCoords($latitude, $longitude, $this->units);
            $days = array_slice($data['daily'], $startIndex, $this->daysDefault);

            return collect($days);
        }
    }