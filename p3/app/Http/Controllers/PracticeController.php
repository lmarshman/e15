<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PracticeController extends Controller
{
    public function practice(){

        dump(DB::select('SHOW DATABASES;'));
        
    }
}