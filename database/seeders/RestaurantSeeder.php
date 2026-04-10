<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        $restaurants = [
            [
                'name' => "McDonald's",
                'description' => 'McDonald\'s is a globally recognised fast food chain offering a wide range of quick and affordable meals. Known for its iconic burgers, crispy fries, and signature sauces, it provides a convenient dining experience for people on the go. Whether you\'re stopping by for a quick lunch or a late-night snack, it\'s a reliable choice for familiar flavours.',
                'location' => 'Dublin',
                'cuisine' => 'Fast Food',
            ],
            [
                'name' => 'The Gourmet Kitchen',
                'description' => 'The Gourmet Kitchen delivers a refined dining experience with a focus on high-quality ingredients and elegant presentation. Each dish is carefully crafted by experienced chefs, blending modern culinary techniques with classic flavours. Ideal for special occasions, the restaurant offers a sophisticated atmosphere and a thoughtfully curated menu.',
                'location' => 'Cork',
                'cuisine' => 'Fine Dining',
            ],
            [
                'name' => 'Sushi World',
                'description' => 'Sushi World specialises in authentic Japanese cuisine, offering a wide variety of sushi, sashimi, and traditional dishes. Using only the freshest ingredients, the restaurant creates beautifully presented meals that highlight the simplicity and balance of Japanese cooking. It\'s a popular spot for both casual dining and special nights out.',
                'location' => 'Dublin',
                'cuisine' => 'Japanese',
            ],
            [
                'name' => 'Pasta Palace',
                'description' => 'Pasta Palace brings the taste of Italy to Galway with its selection of freshly made pasta dishes and rich, flavourful sauces. From creamy carbonara to hearty bolognese, every dish is prepared with care and authenticity. The warm and inviting atmosphere makes it a perfect place for family meals or relaxed dining.',
                'location' => 'Galway',
                'cuisine' => 'Italian',
            ],
            [
                'name' => 'Burger Haven',
                'description' => 'Burger Haven is a go-to destination for classic American comfort food. Known for its juicy, handcrafted burgers and generous portions, it offers a satisfying dining experience in a laid-back setting. The menu also includes loaded fries, milkshakes, and a variety of sides that complement the main dishes perfectly.',
                'location' => 'Limerick',
                'cuisine' => 'American',
            ],
            [
                'name' => 'Taco Town',
                'description' => 'Taco Town brings bold Mexican flavours to the heart of Dublin with its vibrant and diverse menu. From freshly made tacos and burritos to zesty salsas and grilled meats, every dish is packed with flavour. The lively atmosphere and colourful presentation make it a fun place to enjoy a casual meal.',
                'location' => 'Dublin',
                'cuisine' => 'Mexican',
            ],
            [
                'name' => 'Vegan Delight',
                'description' => 'Vegan Delight offers a creative take on plant-based dining, serving dishes that are both nutritious and full of flavour. The menu features a variety of options made from fresh, locally sourced ingredients, catering to vegans and non-vegans alike. It\'s a great spot for those looking for healthy and sustainable food choices.',
                'location' => 'Cork',
                'cuisine' => 'Vegan',
            ],
            [
                'name' => 'Cafe Mocha',
                'description' => 'Cafe Mocha is a cosy neighbourhood cafe known for its expertly brewed coffee and freshly baked pastries. It\'s the perfect place to relax, catch up with friends, or get some work done. The menu also includes light breakfast and brunch options, making it a popular daytime destination.',
                'location' => 'Galway',
                'cuisine' => 'Cafe',
            ],
            [
                'name' => 'Seafood Shack',
                'description' => 'Seafood Shack offers a taste of the coast with its selection of freshly prepared seafood dishes. From grilled fish to crispy fried favourites, the menu celebrates the best of local catches. The relaxed setting and generous portions make it a favourite among seafood lovers.',
                'location' => 'Waterford',
                'cuisine' => 'Seafood',
            ],
            [
                'name' => 'Pizza Planet',
                'description' => 'Pizza Planet serves a wide range of pizzas made with freshly prepared dough and high-quality toppings. Whether you prefer classic combinations or something more adventurous, there\'s something for everyone. The fun and casual atmosphere makes it a great choice for groups and families.',
                'location' => 'Dublin',
                'cuisine' => 'Italian',
            ],
            [
                'name' => 'Late Night Bites',
                'description' => 'Late Night Bites is the perfect spot for satisfying late-night cravings. Offering a variety of street food-inspired dishes, it delivers bold flavours and quick service. Popular among night owls, it\'s known for its convenient hours and tasty, no-fuss meals.',
                'location' => 'Dublin',
                'cuisine' => 'Street Food',
            ],
        ];

        foreach ($restaurants as $restaurant) {
            Restaurant::create($restaurant);
        }
    }
}
