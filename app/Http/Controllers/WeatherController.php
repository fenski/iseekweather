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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $city = $request->has('city') ? $request->get('city') : null;

        // Just testing that everything is plugged in
        $forecast = $city ? $this->weatherRepository->forecastByCityKey($city) : null;

        return view('forecast')->with(compact(['city', 'forecast']));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($cityKey, Request $request)
    {
        $city = $cityKey;

        // Just testing that everything is plugged in
        $forecast = $city ? $this->weatherRepository->forecastByCityKey($city) : null;

        return view('forecast')->with(compact(['city', 'forecast']));
    }
}
