<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodListController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ProfileController;

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
    Route::resource('restaurants', RestaurantController::class);
});

//Profile routes
Route::middleware(['auth'])->group(function () 
{
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::resource('lists', FoodListController::class)->middleware('auth');
Route::post('/lists/{list}/upvote', [FoodListController::class, 'upvote'])
    ->middleware('auth')
    ->name('lists.upvote');
Route::post('/lists/{list}/downvote', [FoodListController::class, 'downvote'])
    ->middleware('auth')
    ->name('lists.downvote');
