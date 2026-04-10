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

    public function foodLists(): BelongsToMany
    {
        return $this->belongsToMany(FoodList::class);
    }
}
