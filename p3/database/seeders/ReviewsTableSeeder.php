<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Review;

class ReviewsTableSeeder extends Seeder
{
    /**
    * @return void
    */
    public function run()
    {
        $this->faker = Factory::create();
        $this->addReviews();
    }

    private function addReviews()
    {

        # Array of review data to add
        $reviews = [
            ['Jill Harvard','1', 'Get here early to avoid the crouds!'],
            ['Jamal Harvard', '1', 'One of my favorite historic sites in Boston!'],
            ['Laura Marshman', '1', 'Did you know this is still a working church?! I had no idea!'],
            ['Jill Harcard', '2', 'This is a great spot for people watching!'],
            ['Jamal Harvard', '2', 'It was a great spot to have a picnic!'],
            ['Laura Marshman', '2', 'In the winter when the frog pond freezes, you can go ice skating!'],
        ];

        $count = count($reviews);

        # Loop through each review, adding them to the database
        foreach ($reviews as $reviewData) {

            $review = new Review();

            $review->created_at = $this->faker->dateTimeThisMonth();
            $review->updated_at = $this->faker->dateTimeThisMonth();

            $review->name = $reviewData[0];
            $review->location_id =$reviewData[1];
            $review->body = $reviewData[2];


            $review->save();

            $count--;
        }
    }
}