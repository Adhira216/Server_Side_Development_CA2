<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of all restaurants.
     */
    public function index()
    {
        $restaurants = Restaurant::all(); // fetch all restaurants
        return view('restaurants.index', compact('restaurants'));
    }

    /**
     * Display a single restaurant.
     */
    public function show(Restaurant $restaurant)
    {
        $restaurant->load('foodLists');

        return view('restaurants.show', compact('restaurant'));
    }
}