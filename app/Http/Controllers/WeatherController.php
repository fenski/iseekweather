<?php

namespace App\Http\Controllers;

use App\Repository\WeatherRepository;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    private $weatherRepository;

    public function __construct(WeatherRepository $weatherRepository)
    {
        $this->weatherRepository = $weatherRepository;
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
        $city = $cityKey;

        // Just testing that everything is plugged in
        try {
            $forecast = $city ? $this->weatherRepository->forecastByCityKey($city) : null;
        } catch (\Exception $e) {
            abort(404);
        }

        return view('forecast')->with(compact(['city', 'forecast']));
    }
}
