<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = [
            [
                'name' => "McDonald's",
                'location' => 'Dublin',
                'cuisine_type' => 'Fast Food'
            ],
            [
                'name' => 'The Gourmet Kitchen',
                'location' => 'Cork',
                'cuisine_type' => 'Fine Dining'
            ],
            [
                'name' => 'Sushi World',
                'location' => 'Dublin',
                'cuisine_type' => 'Japanese'
            ],
            [
                'name' => 'Pasta Palace',
                'location' => 'Galway',
                'cuisine_type' => 'Italian'
            ],
            [
                'name' => 'Burger Haven',
                'location' => 'Limerick',
                'cuisine_type' => 'American'
            ],
            [
                'name' => 'Taco Town',
                'location' => 'Dublin',
                'cuisine_type' => 'Mexican'
            ],
            [
                'name' => 'Vegan Delight',
                'location' => 'Cork',
                'cuisine_type' => 'Vegan'
            ],
            [
                'name' => 'Cafe Mocha',
                'location' => 'Galway',
                'cuisine_type' => 'Cafe'
            ],
            [
                'name' => 'Seafood Shack',
                'location' => 'Waterford',
                'cuisine_type' => 'Seafood'
            ],
            [
                'name' => 'Pizza Planet',
                'location' => 'Dublin',
                'cuisine_type' => 'Italian'
            ],
            [
                'name' => 'Late Night Bites',
                'location' => 'Dublin',
                'cuisine_type' => 'Street Food'
            ],
        ];

        foreach ($restaurants as $restaurant) {
            Restaurant::create($restaurant);
        }
    }
}