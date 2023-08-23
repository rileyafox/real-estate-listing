<?php

namespace Database\Seeders;

use App\Models\Listing;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ListingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,100) as $index) { // This will create 100 sample listings
            Listing::create([
                'title' => $faker->sentence(5),
                'description' => $faker->paragraph(3),
                'price' => $faker->randomFloat(2, 100000, 5000000), // Random price between 100,000 and 5,000,000
                'bedrooms' => $faker->numberBetween(1, 5),
                'bathrooms' => $faker->numberBetween(1, 5),
                'garage' => $faker->numberBetween(0, 3),
                'sqft' => $faker->numberBetween(500, 5000),
                'lot_size' => $faker->randomFloat(2, 0.1, 50), // Random lot size between 0.1 and 50 acres
                'location' => $faker->city, // Random city as the location
            ]);
        }
    }
}
