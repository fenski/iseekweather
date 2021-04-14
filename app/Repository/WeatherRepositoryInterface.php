<?php
    namespace App\Repository;

    use Illuminate\Support\Collection;

    interface WeatherRepositoryInterface
    {
        public function forecastByCityKey(string $cityKey): Collection;

        public function forecastByCityName(string $cityKey): Collection;

        public function forecastByCoordinates(string $latitude, string $longitude): Collection;
    }