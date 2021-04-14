<?php
    namespace App\Repository;

    interface CityRepositoryInterface
    {
        public function findByKey(string $cityKey);
        public function findByName(string $cityName);
    }