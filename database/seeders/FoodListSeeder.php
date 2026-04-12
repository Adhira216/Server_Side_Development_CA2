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
        $user1 = User::where('email', 'sl@gmail.com')->first();
        $user2 = User::where('email', 'gj@gmail.com')->first();

        // USER 1 LISTS (Shauna Liu)

        $lateNight = Restaurant::whereIn('name', [
            'Late Night Bites',
            'Taco Town',
            'Burger Haven',
        ])->pluck('id');

        $list1 = FoodList::create([
            'title' => 'Student Favourites',
            'description' => 'Best late night spots I have tried.',
            'location' => 'Dublin',
            'tags' => 'Budget,Late Night,Street Food',
            'user_id' => $user1->id,
        ]);
        $list1->restaurants()->attach($lateNight);

        $pizzaList = Restaurant::whereIn('name', [
            'Pizza Planet',
            'Pasta Palace',
        ])->pluck('id');

        $list2 = FoodList::create([
            'title' => 'Italian Comfort Food',
            'description' => 'Pizza and pasta cravings sorted.',
            'location' => 'Dublin',
            'tags' => 'Italian,Comfort Food',
            'user_id' => $user1->id,
        ]);
        $list2->restaurants()->attach($pizzaList);

        $cafeList = Restaurant::whereIn('name', [
            'Cafe Mocha',
        ])->pluck('id');

        $list3 = FoodList::create([
            'title' => 'Study Spots',
            'description' => 'Best cafés for studying and coffee.',
            'location' => 'Galway',
            'tags' => 'Cafe,Coffee,Chill',
            'user_id' => $user1->id,
        ]);
        $list3->restaurants()->attach($cafeList);

        $veganList = Restaurant::whereIn('name', [
            'Vegan Delight',
        ])->pluck('id');

        $list4 = FoodList::create([
            'title' => 'Healthy Choices',
            'description' => 'Plant-based and clean eating options.',
            'location' => 'Cork',
            'tags' => 'Vegan,Healthy',
            'user_id' => $user1->id,
        ]);
        $list4->restaurants()->attach($veganList);

        // USER 2 LISTS (Gia Jordon)

        $fastFood = Restaurant::whereIn('name', [
            "McDonald's",
            'Burger Haven',
            'Pizza Planet',
        ])->pluck('id');

        $list5 = FoodList::create([
            'title' => 'Fast Food Picks',
            'description' => 'Quick and cheap eats.',
            'location' => 'Navan',
            'tags' => 'Fast Food,Budget',
            'user_id' => $user2->id,
        ]);
        $list5->restaurants()->attach($fastFood);

        $fineDining = Restaurant::whereIn('name', [
            'The Gourmet Kitchen',
            'Parisian Bistro',
            'Seafood Shack',
        ])->pluck('id');

        $list6 = FoodList::create([
            'title' => 'Fine Dining Experiences',
            'description' => 'High-end restaurants for special occasions.',
            'location' => 'Cork',
            'tags' => 'Luxury,Fine Dining',
            'user_id' => $user2->id,
        ]);
        $list6->restaurants()->attach($fineDining);

        $asianFood = Restaurant::whereIn('name', [
            'Sushi World',
            'Seoul Kitchen',
            'Dragon House',
            'Bangkok Basil',
        ])->pluck('id');

        $list7 = FoodList::create([
            'title' => 'Asian Food Tour',
            'description' => 'Best Asian cuisines across Ireland.',
            'location' => 'Dublin',
            'tags' => 'Asian,Japanese,Korean,Thai,Chinese',
            'user_id' => $user2->id,
        ]);
        $list7->restaurants()->attach($asianFood);

        $streetFood = Restaurant::whereIn('name', [
            'Late Night Bites',
            'Taco Town',
            'Havana Street',
        ])->pluck('id');

        $list8 = FoodList::create([
            'title' => 'Street Food Adventures',
            'description' => 'Casual eats full of flavour.',
            'location' => 'Galway',
            'tags' => 'Street Food,Casual,Budget',
            'user_id' => $user2->id,
        ]);
        $list8->restaurants()->attach($streetFood);

        $internationalMix = Restaurant::whereIn('name', [
            'Athens Taverna',
            'Istanbul Grill',
            'Beirut Mezze',
            'Barcelona Tapas',
            'Addis Ababa Flavours',
        ])->pluck('id');

        $list9 = FoodList::create([
            'title' => 'World Cuisine Picks',
            'description' => 'A mix of global flavours.',
            'location' => 'Limerick',
            'tags' => 'International,Cultural',
            'user_id' => $user2->id,
        ]);
        $list9->restaurants()->attach($internationalMix);
    }
}