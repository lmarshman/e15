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
        // $locations = $request->user()->locations->sortByDesc('pivot.created_at');

        $locations = $request->user()->locations->sortBy('pivot.city');

        return view('/list/listPage', ['locations' => $locations]);
    }

    public function addToList(Request $request, $name)
    {
        $location = Location::where('name', '=', $name)->first();

        return view('/list/addToList', ['location' => $location]);
    }

    public function getAddress($lat, $long)
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
            // CURLOPT_URL => "https://google-maps-geocoding.p.rapidapi.com/geocode/json?latlng=40.714224%2C-73.96145&language=en",
            CURLOPT_URL => "https://google-maps-geocoding.p.rapidapi.com/geocode/json?latlng=".$lat."%2C".$long."&language=en",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: google-maps-geocoding.p.rapidapi.com",
                "X-RapidAPI-Key: f3de2fd521msh6b5d0d93ff4aabep1b2f88jsnae4c606a8e41"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function addPlaceToList(Request $request, $lat, $long, $name)
    {
        $placeAddress = self::getAddress($lat, $long);
        $arr = json_decode($placeAddress, true);

        $address1 = $arr['results'][0]['address_components'][0]['long_name'];
        $address2 = $arr['results'][0]['address_components'][1]['long_name'];
        $addressCombined = $address1.' '.$address2;

        $city = $arr['results'][0]['address_components'][3]['long_name'];
        $state = $arr['results'][0]['address_components'][5]['short_name'];
        $country = $arr['results'][0]['address_components'][6]['long_name'];

        return view('/list/addPlacesToList')->with([
            'name' => $name,
            'addressCombined' => $addressCombined,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'lat' => $lat,
            'long' => $long
        ]);
    }

    public function addPlace(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:locations,name',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required|max:2',
            'country' => 'required',
            'picture_url' => 'required|max:250',
            'loc_url' => 'required',
            'description' => 'required|min:100',
        ]);

        $location = new Location();
        $location->name = $request->name;
        $location->address = $request->address;
        $location->city = $request->city;
        $location->state = $request->state;
        $location->country = $request->country;
        $location->picture_url = $request->picture_url;
        $location->loc_url = $request->loc_url;
        $location->lat = $request->lat;
        $location->long = $request->long;
        $location->description = $request->description;

        $location->save();

        $user = $request->user();

        $user->locations()->save($location, ['notes' => $request->notes]);

        return redirect('/list')->with(['flash-alert' => 'The location ' . $location->name. ' was added to your list.']);
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

        $location = Location::where('name', '=', $name)->first();
        $user = $request->user();

        $location = $user->locations()->where('locations.id', $location->id)->first();

        $location->pivot->notes = $request->notes;
        $location->pivot->save();

        return redirect('/list')->with([
            'flash-alert' => 'Your notes for '.$location->name.' was updated.'
        ]);

    }

    public function checkDelete(Request $request, $name)
    {
        $location = Location::where('name', '=', $name)->first();

        return view('/list/checkDelete', ['location' => $location]);
    }

    public function destroy(Request $request, $name)
    {
        $location = $request->user()->locations()->where('name', $name)->first();

        $location->pivot->delete();

        return redirect('/list')->with([
            'flash-alert' => 'The location ' . $location->name . ' was removed from your list'
        ]);
    }
}