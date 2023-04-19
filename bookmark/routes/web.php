<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\ListController;

Route::any('/practice/{n?}', [PracticeController::class, 'index']);

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

    Route::get('/books/addAuthor', [BookController::class, 'addAuthor']);
    Route::post('/books/addAuthor/new', [BookController::class, 'newAuthor']);

    Route::get('/books/filter/{category}/{subcategory}', [BookController::class, 'filter']);

});

// Route::get('/list', [ListController::class, 'show']);