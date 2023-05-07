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
        $this->addRandomlyGeneratedLocationUSA();
        $this->addRandomlyGeneratedLocationGlobal();
    }

    private function addRandomlyGeneratedLocationUSA()
    {
        for ($i = 0; $i < 100; $i++) {
            $location = new location();

            $name = $this->faker->words(rand(3, 6), true);
            $location->created_at =  $this->faker->dateTimeThisMonth();
            $location->updated_at =  $location->created_at;
            $location->name = Str::title($name);
            $location->address = $this->faker->streetAddress();
            $location->city= $this->faker->city();
            $location->state = $this->faker->stateAbbr();
            $location->country = 'United States';
            $location->lat = $this->faker->latitude($min = -90, $max = 90);
            $location->long = $this->faker->longitude($min = -180, $max = 180);
            $location->picture_url = 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.space.com%2F54-earth-history-composition-and-atmosphere.html&psig=AOvVaw0y7xSXGTh-Ffrig6tmMv3m&ust=1683248023792000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCNjQj9a52v4CFQAAAAAdAAAAABAE';
            $location->loc_url = 'https://www.google.com/search?q=about+earth&rlz=1C1GCEA_enUS948US948&oq=about+earth&aqs=chrome..69i57j0i512l9.1670j0j9&sourceid=chrome&ie=UTF-8';
            $location->description = $this->faker->paragraphs(1, true);

            $location->save();
        }
    }

    private function addRandomlyGeneratedLocationGlobal()
    {
        for ($i = 0; $i < 100; $i++) {
            $location = new location();

            $name = $this->faker->words(rand(3, 6), true);
            $location->created_at =  $this->faker->dateTimeThisMonth();
            $location->updated_at =  $location->created_at;
            $location->name = Str::title($name);
            $location->address = $this->faker->streetAddress();
            $location->city= $this->faker->city();
            $location->state = "N/A";
            $location->country = $this->faker->country();
            $location->lat = $this->faker->latitude($min = -90, $max = 90);
            $location->long = $this->faker->longitude($min = -180, $max = 180);
            $location->picture_url = 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.space.com%2F54-earth-history-composition-and-atmosphere.html&psig=AOvVaw0y7xSXGTh-Ffrig6tmMv3m&ust=1683248023792000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCNjQj9a52v4CFQAAAAAdAAAAABAE';
            $location->loc_url = 'https://www.google.com/search?q=about+earth&rlz=1C1GCEA_enUS948US948&oq=about+earth&aqs=chrome..69i57j0i512l9.1670j0j9&sourceid=chrome&ie=UTF-8';
            $location->description = $this->faker->paragraphs(1, true);

            $location->save();
        }
    }
}