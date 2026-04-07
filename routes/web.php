<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodListController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

//register routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

//login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//Restaurant routes
Route::middleware('auth')->group(function () 
{
    Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
    Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');
});

Route::get('/dashboard', function () 
{
    return view('dashboard');
})->middleware('auth');

Route::resource('lists', FoodListController::class)->middleware('auth');
Route::post('/lists/{list}/upvote', [FoodListController::class, 'upvote'])
    ->middleware('auth')
    ->name('lists.upvote');
Route::post('/lists/{list}/downvote', [FoodListController::class, 'downvote'])
    ->middleware('auth')
    ->name('lists.downvote');
