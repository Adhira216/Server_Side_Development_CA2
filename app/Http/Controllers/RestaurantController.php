<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RestaurantController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $location = trim((string) $request->query('location', ''));
        $cuisine = trim((string) $request->query('cuisine', ''));
        $sort = (string) $request->query('sort', 'latest');
        $allowedSorts = ['latest', 'name_asc', 'rating_desc'];

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'latest';
        }

        $restaurants = Restaurant::query()
            ->withCount('foodLists')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($searchQuery) use ($search) {
                    $searchQuery
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('cuisine', 'like', "%{$search}%");
                });
            })
            ->when($location !== '', fn ($query) => $query->where('location', $location))
            ->when($cuisine !== '', fn ($query) => $query->where('cuisine', $cuisine))
            ->when($sort === 'name_asc', fn ($query) => $query->orderBy('name'))
            ->when($sort === 'rating_desc', fn ($query) => $query->orderByDesc('rating')->orderBy('name'))
            ->when($sort === 'latest', fn ($query) => $query->latest())
            ->get();

        $availableLocations = Restaurant::query()
            ->whereNotNull('location')
            ->where('location', '!=', '')
            ->orderBy('location')
            ->distinct()
            ->pluck('location');

        $availableCuisines = Restaurant::query()
            ->whereNotNull('cuisine')
            ->where('cuisine', '!=', '')
            ->orderBy('cuisine')
            ->distinct()
            ->pluck('cuisine');

        $hasActiveFilters = $search !== '' || $location !== '' || $cuisine !== '' || $sort !== 'latest';

        return view('restaurants.index', compact(
            'restaurants',
            'search',
            'location',
            'cuisine',
            'sort',
            'availableLocations',
            'availableCuisines',
            'hasActiveFilters',
        ));
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
