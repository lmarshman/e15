<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use App\Models\Location;

class RoutesController extends Controller
{
    public function homePage(Request $request)
    {
        return view('/pages/homePage');
    }

    public function discover(Request $request)
    {
        return view('/pages/discover');
    }

    public function create(Request $request)
    {
        return view('/pages/addPlace');
    }

    public function addressRoute(Request $request)
    {
        $locations = $request->user()->locations->sortByDesc('pivot.city');

        return view('/routes/RoutesForm', ['locations' => $locations]);
    }

    // API call to get the latitude and longitude of the city the user has searched for on the Discover page.
    public function cityLatLong($city)
    {
        $cityName = str_replace(' ', '%20', $city);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://opentripmap-places-v1.p.rapidapi.com/en/places/geoname?name=".$cityName."",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: opentripmap-places-v1.p.rapidapi.com",
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

    // API call to get a list of tourist locations for a specific city.
    // Gets $lat and $lon parameters from the cityLatLong function.
    public function cityPlaces($lat, $lon)
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://opentripmap-places-v1.p.rapidapi.com/en/places/radius?radius=500&lon=".$lon."&lat=".$lat."",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: opentripmap-places-v1.p.rapidapi.com",
                "X-RapidAPI-Key: f3de2fd521msh6b5d0d93ff4aabep1b2f88jsnae4c606a8e41"
            ],
        ]);

        $response = json_decode(curl_exec($curl), true);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return $results = $response['features'];
        }
    }

    // API call to get the latitude and longitude for locations added by users.
    public function getLatLong($address)
    {

        $addressURL = str_replace(' ', '%20', $address);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://google-maps-geocoding.p.rapidapi.com/geocode/json?address=".$addressURL."&language=en",
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

    // API call to calculate the didstance between two locations. Uses latitude and longitude for calculation.
    public function distCalc()
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://distance-calculator8.p.rapidapi.com/calc?startLatitude=-26.311960&startLongitude=-48.880964&endLatitude=-26.313662&endLongitude=-48.881103",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: distance-calculator8.p.rapidapi.com",
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

    // Generates a list of tourist locations for a city. Returns locations entered by users and locations
    // generated by the cityPlaces function.
    public function discoverCities(Request $request)
    {
        $request->validate([
            'city' => 'required',
        ]);

        $city = $request->input('city', null);

        $cityLatLong = self::cityLatLong($city);
        $arr = json_decode($cityLatLong);

        $locations = Location::where('city', '=', $city)->get();

        if ($arr == null and $locations == false) {

            $places = 'null';
            $locations = 'false';

            return view('/pages/results')->with([
                'places' => $places,
                'city' => $city,
                'locations' => $locations
            ]);

        } elseif ($arr == null) {

            $places = 'null';
            $locations = 'false';

            return view('/pages/results')->with([
                'places' => $places,
                'city' => $city,
                'locations' => $locations
            ]);

        } else {
            $cityLat = $arr->lat;
            $cityLong = $arr->lon;

            $arr2 = self::cityPlaces($cityLat, $cityLong);
            $places = $arr2;

            return view('/pages/results')->with([
                'places' => $places,
                'locations' => $locations,
                'city' => $city
            ]);

        }
    }

    // Adds a new location by the user to the database.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:locations,name',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required|max:2',
            'country' => 'required',
            'picture_url' => 'required',
            'loc_url' => 'required',
            'description' => 'required|min:100',
        ]);

        $address = $request->input('address', null);
        $city = $request->input('city', null);
        $state = $request->input('state', null);
        $country = $request->input('country', null);

        $stringAddress = $address." ".$city." ".$state;

        $locLatLong = self::getLatLong($stringAddress);
        $arr = json_decode($locLatLong, true);

        $location = $arr['results'][0]['geometry']['location'];
        $lat = $location['lat'];
        $long =$location['lng'];

        $location = new Location();
        $location->name = $request->name;
        $location->address = $address;
        $location->city = $city;
        $location->state = $state;
        $location->country = $country;
        $location->picture_url = $request->picture_url;
        $location->loc_url = $request->loc_url;
        $location->lat = $lat;
        $location->long = $long;
        $location->description = $request->description;
        $location->save();

        return redirect('/pages/addLocation/new')->with(['flash-alert' => 'The location '.$location->name.' was added.']);

    }

    public function address(Request $request)
    {
        $request->validate([
            'start' => 'required',
            'loc1' => 'required|unique:locations,name',
            'loc2' => 'required|unique:locations,name',
            'loc3' => 'sometimes|unique:locations,name',
            'loc4' => 'sometimes|unique:locations,name',
            'loc5' => 'sometimes|unique:locations,name',
        ]);

        $start = $request->input('start', null);
        $loc1 = $request->input('loc1', null);
        $loc2 = $request->input('loc2', null);
        $loc3 = $request->input('loc3', null);
        $loc4 = $request->input('loc4', null);
        $loc5 = $request->input('loc5', null);

        $startLatLong = self::getLatLong($start);
        $loc1LatLong =
        $loc2LatLong =

        $arr = json_decode($startLatLong, true);

        $location = $arr['results'][0]['geometry']['location'];
        $lat = $location['lat'];
        $long =$location['lng'];
        dump($lat);
        dump($long);

    }

    public function makeRoute()
    {

    }


}