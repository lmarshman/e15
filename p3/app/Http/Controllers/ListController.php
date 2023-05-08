<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use App\Models\Location;

class ListController extends Controller
{
    public function showList(Request $request)
    {
        $locations = $request->user()->locations->sortByDesc('pivot.created_at');

        return view('/list/listPage', ['locations' => $locations]);
    }

    public function addToList(Request $request, $name)
    {
        $location = Location::where('name', '=', $name)->first();

        return view('/list/addToList', ['location' => $location]);
    }

    public function save(Request $request, $name)
    {
        $location = Location::where('name', '=', $name)->first();
        $user = $request->user();

        $user->locations()->save($location, ['notes' => $request->notes]);

        return redirect('/list')->with(['flash-alert' => 'The location ' . $location->name. ' was added to your list.']);

    }

    public function update(Request $request, $name)
    {

    }
}