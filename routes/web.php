<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodListController;

Route::get('/', function () {
    return view('lists.index');
});

use App\Http\Controllers\AuthController;

//register routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

//login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/dashboard', function () 
{
    return view('dashboard');
})->middleware('auth');