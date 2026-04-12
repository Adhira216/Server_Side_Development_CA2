<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Restaurant extends Model
{
    protected $fillable = [
        'name',
        'description',
        'location',
        'cuisine',
        'price_range',
        'rating',
        'opening_hours',
        'phone',
        'website',
        'image_url',
        'menu_highlights',
    ];

    public function getDisplayImageUrlAttribute(): ?string
    {
        $imageMap = [
            'Harbour Grill Social' => 'images/restaurants/american.jpg',
            'The Gourmet Kitchen' => 'images/restaurants/fine-dining.jpg',
            'Sushi World' => 'images/restaurants/japanese.jpg',
            'Pasta Palace' => 'images/restaurants/italian-bistro.jpg',
            'Burger Haven' => 'images/restaurants/fast-food.jpg',
            'Taco Town' => 'images/restaurants/mexican.jpg',
            'Vegan Delight' => 'images/restaurants/vegan.jpg',
            'Cafe Mocha' => 'images/restaurants/cafe.jpg',
            'Seafood Shack' => 'images/restaurants/seafood.jpg',
            'Pizza Planet' => 'images/restaurants/italian.jpg',
            'Late Night Bites' => 'images/restaurants/street-food.jpg',
            'Dragon House' => 'images/restaurants/chinese.jpg',
            'Spice Route' => 'images/restaurants/indian.jpg',
            'Bangkok Basil' => 'images/restaurants/thai.jpg',
            'Seoul Kitchen' => 'images/restaurants/korean.jpg',
            'Parisian Bistro' => 'images/restaurants/french.jpg',
            'Athens Taverna' => 'images/restaurants/greek.jpg',
            'Istanbul Grill' => 'images/restaurants/turkish.jpg',
            'Beirut Mezze' => 'images/restaurants/lebanese.jpg',
            'Barcelona Tapas' => 'images/restaurants/spanish.jpg',
            'Addis Ababa Flavours' => 'images/restaurants/ethiopian.jpg',
            'Havana Street' => 'images/restaurants/caribbean.jpg',
        ];

        if (isset($imageMap[$this->name])) {
            return asset($imageMap[$this->name]);
        }

        return $this->image_url;
    }

    public function foodLists(): BelongsToMany
    {
        return $this->belongsToMany(FoodList::class);
    }
}
