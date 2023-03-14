<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $searchResults = session('searchResults', null);
        $searchTerms = session('searchTerms', null);
        $searchType = session('searchType', null);

        return view('pages/welcome',[
            'searchResults' => $searchResults,
            'searchTerms' => $searchTerms,
            'searchType' => $searchType,
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