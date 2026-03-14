<?php

Route::resource('lists', \App\Http\Controllers\FoodListController::class)->middleware('auth');

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
