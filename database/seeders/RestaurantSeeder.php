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
                'cuisine_type' => 'Fast Food',
                'description' => 'McDonald\'s is a globally recognised fast food chain offering a wide range of quick and affordable meals. Known for its iconic burgers, crispy fries, and signature sauces, it provides a convenient dining experience for people on the go. Whether you\'re stopping by for a quick lunch or a late-night snack, it\'s a reliable choice for familiar flavours.',
            ],
            [
                'name' => 'The Gourmet Kitchen',
                'location' => 'Cork',
                'cuisine_type' => 'Fine Dining',
                'description' => 'The Gourmet Kitchen delivers a refined dining experience with a focus on high-quality ingredients and elegant presentation. Each dish is carefully crafted by experienced chefs, blending modern culinary techniques with classic flavours. Ideal for special occasions, the restaurant offers a sophisticated atmosphere and a thoughtfully curated menu.',
            ],
            [
                'name' => 'Sushi World',
                'location' => 'Dublin',
                'cuisine_type' => 'Japanese',
                'description' => 'Sushi World specialises in authentic Japanese cuisine, offering a wide variety of sushi, sashimi, and traditional dishes. Using only the freshest ingredients, the restaurant creates beautifully presented meals that highlight the simplicity and balance of Japanese cooking. It\'s a popular spot for both casual dining and special nights out.',
            ],
            [
                'name' => 'Pasta Palace',
                'location' => 'Galway',
                'cuisine_type' => 'Italian',
                'description' => 'Pasta Palace brings the taste of Italy to Galway with its selection of freshly made pasta dishes and rich, flavourful sauces. From creamy carbonara to hearty bolognese, every dish is prepared with care and authenticity. The warm and inviting atmosphere makes it a perfect place for family meals or relaxed dining.',
            ],
            [
                'name' => 'Burger Haven',
                'location' => 'Limerick',
                'cuisine_type' => 'American',
                'description' => 'Burger Haven is a go-to destination for classic American comfort food. Known for its juicy, handcrafted burgers and generous portions, it offers a satisfying dining experience in a laid-back setting. The menu also includes loaded fries, milkshakes, and a variety of sides that complement the main dishes perfectly.',
            ],
            [
                'name' => 'Taco Town',
                'location' => 'Dublin',
                'cuisine_type' => 'Mexican',
                'description' => 'Taco Town brings bold Mexican flavours to the heart of Dublin with its vibrant and diverse menu. From freshly made tacos and burritos to zesty salsas and grilled meats, every dish is packed with flavour. The lively atmosphere and colourful presentation make it a fun place to enjoy a casual meal.',
            ],
            [
                'name' => 'Vegan Delight',
                'location' => 'Cork',
                'cuisine_type' => 'Vegan',
                'description' => 'Vegan Delight offers a creative take on plant-based dining, serving dishes that are both nutritious and full of flavour. The menu features a variety of options made from fresh, locally sourced ingredients, catering to vegans and non-vegans alike. It\'s a great spot for those looking for healthy and sustainable food choices.',
            ],
            [
                'name' => 'Cafe Mocha',
                'location' => 'Galway',
                'cuisine_type' => 'Cafe',
                'description' => 'Cafe Mocha is a cosy neighbourhood café known for its expertly brewed coffee and freshly baked pastries. It\'s the perfect place to relax, catch up with friends, or get some work done. The menu also includes light breakfast and brunch options, making it a popular daytime destination.',
            ],
            [
                'name' => 'Seafood Shack',
                'location' => 'Waterford',
                'cuisine_type' => 'Seafood',
                'description' => 'Seafood Shack offers a taste of the coast with its selection of freshly prepared seafood dishes. From grilled fish to crispy fried favourites, the menu celebrates the best of local catches. The relaxed setting and generous portions make it a favourite among seafood lovers.',
            ],
            [
                'name' => 'Pizza Planet',
                'location' => 'Dublin',
                'cuisine_type' => 'Italian',
                'description' => 'Pizza Planet serves a wide range of pizzas made with freshly prepared dough and high-quality toppings. Whether you prefer classic combinations or something more adventurous, there\'s something for everyone. The fun and casual atmosphere makes it a great choice for groups and families.',
            ],
            [
                'name' => 'Late Night Bites',
                'location' => 'Dublin',
                'cuisine_type' => 'Street Food',
                'description' => 'Late Night Bites is the perfect spot for satisfying late-night cravings. Offering a variety of street food-inspired dishes, it delivers bold flavours and quick service. Popular among night owls, it\'s known for its convenient hours and tasty, no-fuss meals.',
            ],
        ];

        foreach ($restaurants as $restaurant) {
            Restaurant::create($restaurant);
        }
    }
}