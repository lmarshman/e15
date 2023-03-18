<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\WelcomeController;


Route::get('/', [WelcomeController:: class, 'welcome']);
Route::get('/recipe', [FormController:: class, 'recipe']);