<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;


Route::get('/', [FormController::class, 'welcome']);
# Route to display the Recipe Form Page.
Route::get('/recipe', [FormController::class, 'recipe']);
# Route to completes the measurment conversions.
Route::get('/recipe/process', [FormController::class, 'recipeProcess']);