<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RestaurantController extends Controller
{
    public function index(): View
    {
        $restaurants = Restaurant::query()
            ->withCount('foodLists')
            ->latest()
            ->get();

        return view('restaurants.index', compact('restaurants'));
    }

    public function create(): View
    {
        return view('restaurants.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $restaurant = Restaurant::create($request->validate($this->rules()));

        return redirect()
            ->route('restaurants.show', $restaurant)
            ->with('success', 'Restaurant created successfully.');
    }

    public function show(Restaurant $restaurant): View
    {
        $restaurant->load(['foodLists' => fn ($query) => $query->latest()]);

        return view('restaurants.show', compact('restaurant'));
    }

    public function edit(Restaurant $restaurant): View
    {
        return view('restaurants.edit', compact('restaurant'));
    }

    public function update(Request $request, Restaurant $restaurant): RedirectResponse
    {
        $restaurant->update($request->validate($this->rules()));

        return redirect()
            ->route('restaurants.show', $restaurant)
            ->with('success', 'Restaurant updated successfully.');
    }

    public function destroy(Restaurant $restaurant): RedirectResponse
    {
        $restaurant->delete();

        return redirect()
            ->route('restaurants.index')
            ->with('success', 'Restaurant deleted successfully.');
    }

    private function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'cuisine' => ['required', 'string', 'max:255'],
            'price_range' => ['nullable', 'string', 'max:50'],
            'rating' => ['nullable', 'numeric', 'between:0,5'],
            'opening_hours' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'website' => ['nullable', 'url', 'max:255'],
            'image_url' => ['nullable', 'url', 'max:255'],
            'menu_highlights' => ['nullable', 'string'],
        ];
    }
}
