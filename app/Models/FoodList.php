<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FoodList extends Model
{
    protected $table = 'food_lists';

    protected $fillable = [
        'title',
        'description',
        'location',
        'tags',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function foodListVotes(): HasMany
    {
        return $this->hasMany(FoodListVote::class);
    }
}
