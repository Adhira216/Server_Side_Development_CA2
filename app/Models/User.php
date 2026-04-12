<?php

namespace App\Models;

use App\Models\FoodListVote;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\FoodList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'location',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function foodLists(): HasMany
    {
        return $this->hasMany(FoodList::class);
    }

    public function foodListVotes(): HasMany
    {
        return $this->hasMany(FoodListVote::class);
    }

    public function getProfileImageUrlAttribute(): string
    {
        if (!empty($this->profile_image)) {
            return Storage::url($this->profile_image);
        }

        return asset('images/default-avatar.svg');
    }
}
