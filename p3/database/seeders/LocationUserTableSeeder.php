<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Location;

class LocationUserTableSeeder extends Seeder
{
    /**
    * @return void
    */
    public function run()
    {
        $user = User::where('email', '=', 'jill@harvard.edu')->first();

        $locations = [
            'Museum of Fine Arts Boston',
            'Fenway Park',
            'Boston Public Garden'
        ];

        foreach ($locations as $name) {
            $location = Location::where('name', '=', $name)->first();
            $user->locations()->save($location, ['notes' => 'I loved visiting' . $name]);
        }
    }
}