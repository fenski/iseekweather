<?php

namespace App\Http\Controllers;

use App\Repository\CityRepository;
use App\Repository\WeatherRepository;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    private $weatherRepository;

    public function __construct(WeatherRepository $weatherRepository, CityRepository $cityRepository)
    {
        $this->weatherRepository = $weatherRepository;
        $this->cityRepository = $cityRepository;
    }

    /**
     * Display a basic index page
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('forecast');
    }

    /**
     * Display the city and it's forecast
     *
     * @return \Illuminate\Http\Response
     */
    public function show($cityKey, Request $request)
    {
        // Would usually have better validation here
        $city = $cityKey;

        // Just testing that everything is plugged in
        try {
            $forecast = $city ? $this->weatherRepository->forecastByCityKey($city) : null;
        } catch (\Exception $e) {
            abort(404);
        }

        return view('forecast')->with(compact(['city', 'forecast']));
    }

    public function apiGet(Request $request)
    {
        $cityName = $request->has('cityName') ? $request->get('cityName') : null;

        if (!$cityName) {
            // Better is to return proper API error response with helpful message
            return 'The property "cityName" is missing.';
        }

        try {
            $forecast = $cityName ? $this->weatherRepository->forecastByCityName($cityName) : null;
        } catch (\Exception $e) {
            return null;
        }

        return response()->json($forecast);
    }
}
