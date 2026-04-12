<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        //User Personas

        User::create([
            'name' => 'Shauna Liu',
            'email' => 'sl@gmail.com',
            'password' => Hash::make('password'),
            'location' => 'Dundalk',
            'bio' => '20 year old college student looking for affordable places to eat.',
        ]);

        User::create([
            'name' => 'Gia Jordan',
            'email' => 'gj@gmail.com',
            'password' => Hash::make('password'),
            'location' => 'Dublin',
            'bio' => '28 year old digital marketing specialist who thrives on discovering and sharing new food experiences.',
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 't@t.com',
            'password' => Hash::make('password'),
        ]);
    }
}