<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PageController;

Route::get('/', [PageController:: class, 'welcome']);
Route::get('/contact', [PageController:: class, 'contact']);

Route::get('/books', [BookController::class, 'index']);
Route::get('/search', [BookController::class, 'search']);
Route::get('/books/{slug}', [BookController::class, 'show']);
Route::get('/books/filter/{category}/{subcategory}', [BookController::class, 'filter']);

Route::get('/list', [ListController::class, 'show']);

Route::get('/example', function () {
    $foo = [1,2,3];
    Log::info($foo);
    return view('abc');
});