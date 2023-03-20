<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;


Route::get('/', [FormController:: class, 'welcome']);
Route::get('/recipe', [FormController:: class, 'recipe']);