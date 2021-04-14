<?php

    namespace App\Repository;

    use Illuminate\Support\Collection;

    class CityRepository implements CityRepositoryInterface
    {
        // This would be replaced at scale with a data model reference or external storage
        public function data() {
            return [
                [
                    'name' => 'Adelaide',
                    'key' => 'adelaide',
                    'coordinates' => [-34.928497, 138.600739]
                ],
                [
                    'name' => 'Brisbane',
                    'key' => 'brisbane',
                    'coordinates' => [-27.470030, 153.022980]
                ],
                [
                    'name' => 'Canberra',
                    'key' => 'canberra',
                    'coordinates' => [-35.280937, 149.130005]
                ],
            ];
        }

        /**
         * Find a city by it's key
         * @param string $cityKey
         * @return array|null
         */
        public function findByKey(string $cityKey)
        {
            // Search our data collection for the city
            foreach ($this->data() as $city) {
                if ($city['key'] == $cityKey) {
                    return $city;
                }
            }

            return null;
        }

        /**
         * Find a city by it's name
         * @param string $cityName
         * @return array|null
         */
        public function findByName(string $cityName)
        {
            // Search our data collection for the city
            foreach ($this->data() as $city) {
                if ($city['name'] == $cityName) {
                    return $city;
                }
            }

            return null;
        }
    }