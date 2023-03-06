<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class BookController extends Controller
{
    public function index()
    {
        return 'Showing all books';
    }
    
    public function show($title)
    {
        $bookFound = true;


        return view('books/show', [
            'title' => $title,
            'bookFound' => $bookFound
        ]);
    }
}