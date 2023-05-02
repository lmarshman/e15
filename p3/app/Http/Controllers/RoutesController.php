<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;

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

    public function addressConvert(Request $request)
    {
        return view('routes/RoutesForm');
    }

    public function getLatLong($address)
    {
        $addressURL = str_replace(' ', '%20', $address);
        $addressURL = str_replace(',', '', $addressURL);

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

        // $data = json_decode($startLatLong);

        // dump($data->geometry->location);

    }

    public function makeRoute()
    {

    }


}