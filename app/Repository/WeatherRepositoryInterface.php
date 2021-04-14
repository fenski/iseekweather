<?php
    namespace App\Repository;

    use Illuminate\Support\Collection;

    interface WeatherRepositoryInterface
    {
        public function forecastByCityKey(string $cityKey, int $days): Collection;
    }