<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{

    public function recipe(Request $request)
    {

        // $request->validate([
        //     'convert1' => 'required',
        //     'convert2' => 'required',
        //     'amount' => 'required|numeric',
        //     'halve' => 'sometimes',
        //     'double' => 'sometimes',
        //     'triple' => 'sometimes',
        // ]);

        $convert1 = $request->input('convert1', null);
        $convert2 = $request->input('convert2', null);
        $amount = $request->input('amount', '');

        $halve = $request->input('halve', null);
        $double = $request->input('double', null);
        $triple = $request->input('triple', null);

        if ($convert1 == $convert2) {
            $conversion = $amount;
        }

        if ($convert1 == 'tsp') {
            if ($convert2 == 'tbs') {
                $conversion = $amount / 3;
            } elseif ($convert2 = 'oz') {
                $conversion = $amount / 6;
            } elseif ($convert2 == 'cup') {
                $conversion = $amount / 48;
            }
        }

        if ($convert1 == 'tbs') {
            if ($convert2 == 'tsp'){
                $conversion = $amount * 3;
            } elseif ($convert1 == 'oz') {
                $conversion = $amount / 2;
            } elseif ($convert2 == 'cup') {
                $conversion = $amount / 16;
            }
        }

        if ($convert1 == 'oz') {
            if ($convert2 == 'tsp') {
                $conversion = $amount * 6;
            } elseif ($convert2 == 'tbs') {
                $conversion = $amount * 2;
            } elseif ($convert2 == 'cup') {
                $conversion = $amount / 8;
            }
        }

        if ($convert1 == 'cup') {
            if ($convert2 == 'tsp') {
                $conversion = $amount * 48;
            } elseif ($convert2 == 'tbs') {
                $conversion = $amount * 16;
            } elseif ($convert2 == 'oz')  {
                $conversion = $amount * 8;
            }
        }

        if ($halve) {
            $conversion = $conversion / 2;
        } elseif ($double) {
            $conversion = $conversion * 2;
        } elseif ($triple) {
            $conversion = $conversion * 3;
        }

        var_dump($convert2);
        var_dump($conversion);

        // return redirect('pages/RecipeForm');

        // return redirect('pages/RecipeForm')->with([
        //     'conversion' => $conversion
        // ])->withInput();

        
        return view('pages/RecipeForm', [
            'conversion' => $conversion,
            'convert2' => $convert2
        ]);
    }
}