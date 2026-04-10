<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'sl@gmail.com',
        ], [
            'name' => 'Aloka D',
            'password' => Hash::make('password'),
        ]);

        User::updateOrCreate([
            'email' => 'gj@gmail.com',
        ], [
            'name' => 'Gia Jordan',
            'password' => Hash::make('password'),
        ]);

        User::updateOrCreate([
            'email' => 't@t.com',
        ], [
            'name' => 'Test User',
            'password' => Hash::make('password'),
        ]);
    }
}
