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
        return view('pages/homePage');
    }

    public function showList(Request $request)
    {
        return view('pages/list');
    }

    public function discover(Request $request)
    {
        return view('pages/discover');
    }

    public function cityLatLong($city)
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://opentripmap-places-v1.p.rapidapi.com/en/places/geoname?name=".$city."",
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

    public function discoverCities(Request $request)
    {
        $request->validate([
            'city' => 'required',
        ]);

        $city = $request->input('city', null);

        $cityLatLong = self::cityLatLong($city);
        $arr = json_decode($cityLatLong);

        if ($arr == null) {

            $places = 'null';

            return view('/pages/results')->with([
                'places' => $places,
                'city' => $city,
            ]);

        } else {
            $cityLat = $arr->lat;
            $cityLong = $arr->lon;

            $arr2 = self::cityPlaces($cityLat, $cityLong);
            $places = $arr2;


            return view('/pages/results')->with([
                'places' => $places,
                'city' => $city
            ]);

        }

        // $cityLat = $arr->lat;
        // $cityLong = $arr->lon;

        // $arr2 = self::cityPlaces($cityLat, $cityLong);
        // $places = $arr2;


        // return view('/pages/results')->with([
        //     'places' => $places,
        //     'city' => $city
        // ]);

    }

    public function addressConvert(Request $request)
    {
        return view('routes/RoutesForm');
    }

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

    public function address(Request $request)
    {
        $request->validate([
            'start' => 'required',
            'loc1' => 'required',
            'loc2' => 'sometimes',
        ]);

        $start = $request->input('start', null);
        $loc1 = $request->input('loc1', null);
        $loc2 = $request->input('loc2', null);

        $startLatLong = self::getLatLong($start);
        $loc1LatLong = self::getLatLong($loc1);
        $loc2LatLong = self::getLatLong($loc2);

        $arr = json_decode($startLatLong, true);

        $location = $arr['results'][0]['geometry']['location'];
        $lat = $location['lat'];
        $long =$location['lng'];
        dump($lat);
        dump($long);

    }

    public function add(Request $request)
    {
        return view('pages/addPlace');
    }

    public function addLocation(Request $request)
    {
        $request->validate([
            'name' => 'required|max:225',
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

        return redirect('/pages/addLocation/new')->with(['flash-alert' => 'The location, '.$location->name.' was added.']);

    }

    public function makeRoute()
    {

    }

    public function test(Request $request)
    {
        return view('/pages/test');
    }


}