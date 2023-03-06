<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{

    public function welcome()
    {
        return view('pages/welcome');
    }

    public function RecipeForm()
    {
        return view('pages/RecipeForm');
    }
}