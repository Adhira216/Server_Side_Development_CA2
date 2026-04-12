<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodListVote extends Model
{
    public const UPVOTE = 1;
    public const DOWNVOTE = -1;

    protected $fillable = [
        'user_id',
        'food_list_id',
        'value',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function foodList(): BelongsTo
    {
        return $this->belongsTo(FoodList::class);
    }
}
