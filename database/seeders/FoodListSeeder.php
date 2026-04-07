<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FoodList;
use App\Models\User;
use App\Models\Restaurant;

class FoodListSeeder extends Seeder
{
    public function run(): void
    {
        //Foodlists for User Personas

        $user1 = User::where('email', 'sl@gmail.com')->first();
        $user2 = User::where('email', 'gj@gmail.com')->first();

        // USER 1 LISTS
        $streetfood = Restaurant::whereIn('name', 
        [
            'Late Night Bites',
        ])->pluck('id');

        $list1 = FoodList::create([
            'title' => 'Student Favourites',
            'description' => 'Best late night spots I have tried.',
            'location' => 'Dublin',
            'tags' => 'Sweet,Budget-friendly',
            'user_id' => $user1->id,
        ]);

        $list1->restaurants()->attach($streetfood);


        // USER 2 LISTS
        $fastFood = Restaurant::whereIn('name', 
        [
            'McDonald\'s',
        ])->pluck('id');

        $list2 = FoodList::create([
            'title' => 'Fast Food Picks',
            'description' => 'Quick and cheap eats.',
            'location' => 'Navan',
            'tags' => 'Fast Food,Cheap',
            'user_id' => $user2->id,
        ]);

        $list2->restaurants()->attach($fastFood);
    }
}