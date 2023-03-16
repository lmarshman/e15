<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $searchResults = session('searchResults', null);

        return view('pages/welcome', [
            'searchResults' => $searchResults,
        ]);
    }
    
    public function welcome()
    {

        $searchResults = session('searchResults', null);
        return view('pages/welcome', ['searchResults' => $searchResults]);
    }

    public function contact()
    {
        return view('pages/contact');
    }
}