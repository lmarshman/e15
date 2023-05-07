<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\RoutesController;

Route::get('/', [RoutesController::class, 'homePage']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/routes/address/convert', [RoutesController::class, 'addressConvert']);
    Route::get('/routes/address', [RoutesController::class, 'address']);

    Route::get('/pages/addLocation/new', [RoutesController::class, 'add']);
    Route::post('/pages/addLocation', [RoutesController::class, 'addLocation']);

    Route::get('/pages/list', [RoutesController::class, 'showList']);

    Route::get('/pages/discover/cities', [RoutesController::class, 'discover']);
    Route::get('/pages/discover', [RoutesController::class, 'discoverCities']);
    Route::get('/pages/test', [RoutesController::class, 'test']);
});