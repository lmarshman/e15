<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use App\Models\Location;
use Faker\Factory;

class LocationsTableSeeder extends Seeder
{
    private $faker;

    public function run(): void
    {
        $this->faker = Factory::create();
        $this->addLocationsFromBooksDotJsonFile();
    }

    private function addLocationsFromBooksDotJsonFile()
    {
        $locationData = file_get_contents(database_path('locations.json'));
        $locations = json_decode($locationData, true);

        foreach ($locations as $name => $locationData) {
            $location = new Location();

            $location->created_at =  $this->faker->dateTimeThisMonth();
            $location->updated_at =  $location->created_at;
            $location->name = $name;
            $location->address = $locationData['address'];
            $location->city= $locationData['city'];
            $location->state = $locationData['state'];
            $location->country = $locationData['country'];
            $location->lat = $locationData['lat'];
            $location->long = $locationData['long'];
            $location->picture_url = $locationData['picture_url'];
            $location->loc_url = $locationData['loc_url'];
            $location->description = $locationData['description'];

            $location->save();

        }
    }

}