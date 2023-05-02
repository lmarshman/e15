<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\RoutesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [RoutesController::class, 'homePage']);

Route::get('/routes/address/convert', [RoutesController::class, 'addressConvert']);
Route::get('/routes/address', [RoutesController::class, 'address']);

Route::get('/pages/list', [RoutesController::class, 'showList']);