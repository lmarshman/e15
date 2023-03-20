<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    # Displays homepage
    public function welcome()
    {
        return view('pages/welcome');
    }

    # Displays the Recipe Form page
    public function recipe(Request $request)
    {
        return view('pages/RecipeForm', [
            'conversion' => session('conversion')
        ]);
    }

    # Processes the recipe form conversions
    public function recipeProcess(Request $request)
    {
        $request->validate([
            'convert1' => 'required',
            'convert2' => 'required',
            'amount' => 'required|numeric',
            'halve' => 'sometimes',
            'double' => 'sometimes',
            'triple' => 'sometimes',
        ]);
        
        # Obtain Recipe Form values
        $convert1 = $request->input('convert1', null);
        $convert2 = $request->input('convert2', null);
        $amount = $request->input('amount', '');

        # If a radio button was chosen (halve, double, triple), obtains value.
        $convertType = $request->input('convertType', null);

        # If the selected measurements are the same, returns the original amount.
        if ($convert1 == $convert2) {
            $conversion = $amount;
        }

        # Convert tsp
        if ($convert1 == 'tsp') {
            if ($convert2 == 'tbs') {
                $conversion = $amount / 3;
            } elseif ($convert2 = 'oz') {
                $conversion = $amount / 6;
            } elseif ($convert2 == 'cup') {
                $conversion = $amount / 48;
            }
        }

        # Convert tbs
        if ($convert1 == 'tbs') {
            if ($convert2 == 'tsp') {
                $conversion = $amount * 3;
            } elseif ($convert1 == 'oz') {
                $conversion = $amount / 2;
            } elseif ($convert2 == 'cup') {
                $conversion = $amount / 16;
            }
        }

        # Convert oz
        if ($convert1 == 'oz') {
            if ($convert2 == 'tsp') {
                $conversion = $amount * 6;
            } elseif ($convert2 == 'tbs') {
                $conversion = $amount * 2;
            } elseif ($convert2 == 'cup') {
                $conversion = $amount / 8;
            }
        }

        # Convert cup
        if ($convert1 == 'cup') {
            if ($convert2 == 'tsp') {
                $conversion = $amount * 48;
            } elseif ($convert2 == 'tbs') {
                $conversion = $amount * 16;
            } elseif ($convert2 == 'oz') {
                $conversion = $amount * 8;
            }
        }

        # If half, double, or triple is chosen
        if ($convertType == 'halve') {
            $conversion = $conversion / 2;
        } elseif ($convertType == 'double') {
            $conversion = $conversion * 2;
        } elseif ($convertType == 'triple') {
            $conversion = $conversion * 3;
        }

        return redirect('/recipe')->with([
            'conversion' => $conversion
        ])->withInput();

    }
}