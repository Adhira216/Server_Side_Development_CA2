<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::query()
            ->withCount('foodLists')
            ->latest()
            ->get();

        return view('restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        abort(404);
    }

    public function show(Restaurant $restaurant)
    {
        $restaurant->load('foodLists');

        return view('restaurants.show', compact('restaurant'));
    }

    public function edit(Restaurant $restaurant)
    {
        abort(404);
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        abort(404);
    }

    public function destroy(Restaurant $restaurant)
    {
        abort(404);
    }
}
