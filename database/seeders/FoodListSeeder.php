<?php

namespace Database\Seeders;

use App\Models\FoodList;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Seeder;

class FoodListSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()
            ->where('id', 1)
            ->orWhere('email', 'sl@gmail.com')
            ->orderBy('id')
            ->firstOrFail();

        $foodLists = [
            [
                'title' => 'Comforting Ramen Bowls Worth the Trip',
                'description' => 'A shortlist of ramen spots with deeply flavoured broths, good toppings, and the kind of bowls you plan an evening around.',
                'location' => 'Dublin',
                'tags' => 'ramen,japanese,noodles,comfort food',
                'restaurants' => ['Broth & Barrel', 'Shoyu Lane', 'Market Noodle Bar'],
            ],
            [
                'title' => 'Weekend Brunch Spots for Slow Mornings',
                'description' => 'Reliable brunch rooms with strong coffee, sweet options, and savoury plates that feel worth lingering over.',
                'location' => 'Drogheda',
                'tags' => 'brunch,coffee,weekend,breakfast',
                'restaurants' => ['Morning Folk', 'The Buttered Bench', 'Lantern Coffee House', 'Quiet Roast'],
            ],
            [
                'title' => 'Budget Bites for Students and Late Paydays',
                'description' => 'Places that stay satisfying without stretching the budget, from burgers and tacos to noodle bowls and all-day cafes.',
                'location' => 'Dublin',
                'tags' => 'budget,cheap eats,student friendly,casual',
                'restaurants' => ['Patty District', 'Morning Folk', 'Dockyard Tacos', 'Market Noodle Bar', 'Midnight Munch'],
            ],
            [
                'title' => 'Spicy Plates with Real Heat',
                'description' => 'A curated mix of restaurants where the spicy options actually deliver, whether you want curry, noodles, or tacos.',
                'location' => 'Cork',
                'tags' => 'spicy,hot food,curry,flavour packed',
                'restaurants' => ['Spice Circuit', 'Fireleaf Kitchen', 'Dockyard Tacos', 'Harissa Lane'],
            ],
            [
                'title' => 'Dessert Stops for Cake and Pastry People',
                'description' => 'The places to go when the plan is coffee and something sweet, with standout slices, tarts, and pastries.',
                'location' => 'Belfast',
                'tags' => 'dessert,cakes,pastries,sweet',
                'restaurants' => ['Sugar Loom', 'Whisk & Berry', 'Morning Folk'],
            ],
            [
                'title' => 'Quiet Cafés for Study Sessions',
                'description' => 'Good light, solid coffee, comfortable seating, and an atmosphere that makes it easy to stay for a few hours.',
                'location' => 'Drogheda',
                'tags' => 'cafe,study,coffee,remote work',
                'restaurants' => ['Quiet Roast', 'Lantern Coffee House', 'Morning Folk', 'Root & Bloom'],
            ],
            [
                'title' => 'Sushi Restaurants for Treat Nights',
                'description' => 'A polished group of sushi spots worth booking when you want clean flavours, good rice, and a more special dinner.',
                'location' => 'Galway',
                'tags' => 'sushi,japanese,date night,seafood',
                'restaurants' => ['Riverside Sushi Club', 'Sakura Table', 'Broth & Barrel'],
            ],
            [
                'title' => 'Burger Runs That Always Deliver',
                'description' => 'For when only a proper burger will do, these spots consistently hit the mark on patties, fries, and sides.',
                'location' => 'Belfast',
                'tags' => 'burgers,casual,comfort food,fries',
                'restaurants' => ['Patty District', 'Char House Social', 'Midnight Munch'],
            ],
            [
                'title' => 'Pizza Places for Group Dinners',
                'description' => 'Dependable pizza spots that work well for sharing, catchups, and easy nights out with varied tastes in the group.',
                'location' => 'Galway',
                'tags' => 'pizza,italian,sharing,groups',
                'restaurants' => ['Crust Society', 'Stonedough', 'Oak Room Bistro'],
            ],
            [
                'title' => 'Date Night Restaurants with Atmosphere',
                'description' => 'Places that feel polished without trying too hard, with thoughtful menus, strong service, and good lighting.',
                'location' => 'Dublin',
                'tags' => 'date night,romantic,premium,dinner',
                'restaurants' => ['Olive & Ember', 'Harbour Table', 'Oak Room Bistro', 'Sakura Table'],
            ],
            [
                'title' => 'Vegan Picks That Never Feel Like a Compromise',
                'description' => 'Plant-forward places with properly satisfying menus, useful variety, and dishes you would recommend to anyone.',
                'location' => 'Galway',
                'tags' => 'vegan,plant based,healthy,vegetarian friendly',
                'restaurants' => ['Green Hearth', 'Root & Bloom', 'Spice Circuit', 'Harissa Lane'],
            ],
            [
                'title' => 'Coffee and Pastry Places to Recommend First',
                'description' => 'If someone asks where to meet for coffee, these are the places that come to mind immediately.',
                'location' => 'Dublin',
                'tags' => 'coffee,pastries,meetups,cafe',
                'restaurants' => ['Lantern Coffee House', 'Quiet Roast', 'Sugar Loom', 'The Buttered Bench'],
            ],
            [
                'title' => 'Seafood Dinners by the Coast and Beyond',
                'description' => 'A focused set of seafood restaurants with strong sourcing, well-executed mains, and a sense of occasion.',
                'location' => 'Galway',
                'tags' => 'seafood,coastal,dinner,fresh fish',
                'restaurants' => ['Sea Salt Kitchen', 'Harbour Table', 'Oak Room Bistro', 'Riverside Sushi Club'],
            ],
            [
                'title' => 'Late Night Food for Post-Gig Hunger',
                'description' => 'When most kitchens are closing, these spots are still serving food that is actually worth getting.',
                'location' => 'Dublin',
                'tags' => 'late night,street food,comfort food,casual',
                'restaurants' => ['Midnight Munch', 'Patty District', 'Dockyard Tacos', 'Broth & Barrel'],
            ],
            [
                'title' => 'Cork Restaurants for Out-of-Town Visitors',
                'description' => 'A useful mix of crowd-pleasers in Cork that show variety without sending visitors somewhere risky.',
                'location' => 'Cork',
                'tags' => 'cork,recommendations,visitors,must try',
                'restaurants' => ['Spice Circuit', 'Sakura Table', 'Crust Society', 'Oak Room Bistro'],
            ],
            [
                'title' => 'Belfast Food Crawl for One Busy Day',
                'description' => 'A realistic one-day circuit through Belfast with coffee, tacos, dessert, and a proper dinner option.',
                'location' => 'Belfast',
                'tags' => 'belfast,food crawl,day out,variety',
                'restaurants' => ['Shoyu Lane', 'Dockyard Tacos', 'Sugar Loom', 'Char House Social', 'Root & Bloom'],
            ],
            [
                'title' => 'Drogheda Favourites for Casual Meetups',
                'description' => 'Easy recommendations for friends catching up, with relaxed service, solid menus, and low-stress choices.',
                'location' => 'Drogheda',
                'tags' => 'drogheda,casual,meetups,local favourites',
                'restaurants' => ['Morning Folk', 'Quiet Roast', 'Whisk & Berry'],
            ],
            [
                'title' => 'Galway Spots with Great Vegetarian-Friendly Menus',
                'description' => 'Restaurants where vegetarians can order confidently without being boxed into a token option or two.',
                'location' => 'Galway',
                'tags' => 'vegetarian,galway,flexitarian,balanced menus',
                'restaurants' => ['Green Hearth', 'The Buttered Bench', 'Sea Salt Kitchen', 'Stonedough'],
            ],
            [
                'title' => 'Places I Would Bring a Food-Loving Friend',
                'description' => 'A balanced shortlist for visiting friends who want a few memorable meals without wasting time on average picks.',
                'location' => 'Dublin',
                'tags' => 'recommendations,visiting friends,curated,best of',
                'restaurants' => ['Olive & Ember', 'Harissa Lane', 'Lantern Coffee House', 'Broth & Barrel', 'Patty District'],
            ],
            [
                'title' => 'Treat-Yourself Dinners When the Budget is Fine',
                'description' => 'Restaurants for the nights when you want polished cooking, stronger service, and a little more ceremony.',
                'location' => 'Howth',
                'tags' => 'premium,treat yourself,fine dining,special occasion',
                'restaurants' => ['Harbour Table', 'Olive & Ember', 'Sakura Table', 'Sea Salt Kitchen'],
            ],
        ];

        foreach ($foodLists as $foodListData) {
            $restaurantNames = $foodListData['restaurants'];
            unset($foodListData['restaurants']);

            $foodList = FoodList::updateOrCreate(
                [
                    'title' => $foodListData['title'],
                    'user_id' => $user->id,
                ],
                [
                    ...$foodListData,
                    'user_id' => $user->id,
                ]
            );

            $restaurantIds = Restaurant::query()
                ->whereIn('name', $restaurantNames)
                ->pluck('id')
                ->all();

            $foodList->restaurants()->sync($restaurantIds);
        }
    }
}
