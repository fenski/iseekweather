<?php

    namespace App\Repository;

    use Illuminate\Support\Collection;

    class CityRepository implements CityRepositoryInterface
    {
        // This would be replaced at scale with a data model reference or external storage
        public function data() {
            /**
             * name => Human readable name. What is likely to be typed in and displayed.
             * key => Slug that can be used for maintaining unique references,
             *        and if we want to go the route of URL friendly pages. Must follow slug conventions.
             * coordinates => latitude and longitude of the city center
             */
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
                [
                    'name' => 'Darwin',
                    'key' => 'darwin',
                    'coordinates' => [-12.462320, 130.840942]
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