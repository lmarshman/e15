<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use App\Models\Location;
use App\Models\Review;

class RoutesController extends Controller
{
    // Displays the home page
    public function homePage(Request $request)
    {
        return view('/pages/homePage');
    }

    // Displays the discover page
    public function discover(Request $request)
    {
        return view('/pages/discover');
    }

    // Displays the form that allows users to add a location to the database
    public function create(Request $request)
    {
        return view('/pages/addPlace');
    }

    // Displays the reviews for a particular location
    public function showReviews(Request $request, $name)
    {
        // Query for location information
        $location = Location::where('name', '=', $name)->first();

        // Query for reviews for location and displays in decending order
        $reviews = Review::where('location_id', '=', $location->id)->orderBy('created_at', 'DESC')->get();

        return view('/pages/reviews')->with([
            'location' => $location,
            'reviews' => $reviews
        ]);

    }

    // Function for user to add a review to a location
    public function createReview(Request $request, $name)
    {
        $request->validate([
            'review' => 'required',
        ]);

        $user = $request->user();
        $location = Location::where('name', '=', $name)->first();

        $review = new Review();
        $review->name = $user->name;
        $review->body = $request->review;
        $review->location()->associate($location);

        $review->save();

        // Queries DB again to return reviews to the page, including the one just added by the user.
        $reviews = Review::where('location_id', '=', $location->id)->orderBy('created_at', 'DESC')->get();

        return redirect($request->headers->get('referer'))->with([
            'reviews' => $reviews,
            'flash-alert' => 'Your Review has been added'
        ]);

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

    // Generates a list of tourist locations for a city. Returns locations entered by users and locations
    // generated by the cityPlaces function.
    public function discoverCities(Request $request)
    {
        $request->validate([
            'city' => 'required',
        ]);

        $city = $request->input('city', null);

        // Gets the lat and long for the city
        $cityLatLong = self::cityLatLong($city);
        $arr = json_decode($cityLatLong);

        // Queries DB for locations from that city
        $locations = Location::where('city', '=', $city)->get();

        // If there aren't any results from the API or the DB
        if ($arr == null and $locations == false) {

            $places = 'null';
            $locations = 'false';

            return view('/pages/results')->with([
                'places' => $places,
                'city' => $city,
                'locations' => $locations
            ]);

        // If no locations from API
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

            // Call to API to generate list of tourist locations for city
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
            'picture_url' => 'required|max:250',
            'loc_url' => 'required',
            'description' => 'required|min:100',
        ]);

        $address = $request->input('address', null);
        $city = $request->input('city', null);
        $state = $request->input('state', null);
        $country = $request->input('country', null);

        // Formatted address parameter for function getLatLong
        $stringAddress = $address." ".$city." ".$state;

        // API call to get the lat and long for a location added by user
        $locLatLong = self::getLatLong($stringAddress);
        $arr = json_decode($locLatLong, true);

        // Isolating lat and long from API results
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

}