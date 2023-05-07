<?php

namespace App\Repository;

use GuzzleHttp\Client;
use App\Model\Location;

class LocationRepository
{
    /**
     * @return array
     */
    public static function get($lat, $lon): array
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

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return array_map(fn($value) => User::fromApiResult($value), json_decode($response->getBody(), true));
        }
    }
}