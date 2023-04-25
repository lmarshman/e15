<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\TestController;

if (!App::environment('production')) {
    Route::get('/test/login-as/{userId}', [TestController::class, 'loginAs']);
    Route::get('/test/refresh-database', [TestController::class, 'refreshDatabase']);

    # It’s a good idea to move the practice route into this if condition
    # so that our practice routes are not available on production
    Route::any('/practice/{n?}', [PracticeController::class, 'index']);
}

Route::get('/', [PageController::class, 'welcome']);
Route::get('/contact', [PageController::class, 'contact']);

Route::group(['middleware' => 'auth'], function () {

    # Make sure the create route comes before the `/books/{slug}` route so it takes precedence
    Route::get('/books/create', [BookController::class, 'create']);

    # Note the use of the post method in this route
    Route::post('/books', [BookController::class, 'store']);

    Route::get('/books', [BookController::class, 'index']);
    Route::get('/search', [BookController::class, 'search']);

    Route::get('/books/{slug}', [BookController::class, 'show']);

    # Show the form to edit a specific book
    Route::get('/books/{slug}/edit', [BookController::class, 'edit']);
    # Process the form to edit a specific book
    Route::put('/books/{slug}', [BookController::class, 'update']);

    Route::get('/books/{slug}/delete', [BookController::class, 'delete']);
    Route::delete('/books/{slug}', [BookController::class, 'destroy']);

    Route::get('/books/addAuthor', [BookController::class, 'add']);
    Route::post('/books/addAuthor/new', [BookController::class, 'newAuthor']);

    Route::get('/books/filter/{category}/{subcategory}', [BookController::class, 'filter']);

    Route::get('/list', [ListController::class, 'show']);
    Route::get('/list/{slug}/add', [ListController::class, 'add']);
    Route::post('/list/{slug}/save', [ListController::class, 'save']);

    Route::get('/list/{slug}/delete', [ListController::class, 'delete']);
    Route::delete('/list/{slug}', [ListController::class, 'destroy']);

});
