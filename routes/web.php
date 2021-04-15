<?php

    use App\Http\Controllers\WeatherController;
    use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WeatherController::class, 'index'])->name('index');

// Future development - preselected pages
Route::get('/{cityKey}', [WeatherController::class, 'show'])->name('show');

// Usually would have this at the api. subdomain with separate controllers, middleware, etc.
Route::get('/api/forecast/get', [WeatherController::class, 'apiGet'])->name('api.get');
Route::get('/api/cities/get', [WeatherController::class, 'apiCities'])->name('api.cities');
