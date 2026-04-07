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
        ]);

        User::create([
            'name' => 'Gia Jordan',
            'email' => 'gj@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 't@t.com',
            'password' => Hash::make('password'),
        ]);
    }
}