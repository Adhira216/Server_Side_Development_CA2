<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Restaurant extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'name',
        'location',
        'cuisine_type',
    ];

    // Relationship to FoodList (many-to-many)
    public function foodLists(): BelongsToMany
    {
        return $this->belongsToMany(FoodList::class, 'list_restaurant', 'restaurant_id', 'list_id');
    }
}