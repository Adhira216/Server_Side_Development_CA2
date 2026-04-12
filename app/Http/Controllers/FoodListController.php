<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\FoodList;
use App\Models\FoodListVote;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FoodListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $view = (string) $request->query('view', 'latest');
        $search = trim((string) $request->query('search', ''));
        $location = trim((string) $request->query('location', ''));
        $restaurantId = (int) $request->query('restaurant', 0);
        $sort = (string) $request->query('sort', 'latest');
        $allowedViews = ['latest', 'popular'];
        $allowedSorts = ['latest', 'oldest', 'title_asc', 'title_desc'];
        $userId = $request->user()->id;

        if (!in_array($view, $allowedViews, true)) {
            $view = 'latest';
        }

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'latest';
        }

        $foodListsQuery = FoodList::query()
        ->withSum('foodListVotes as vote_total', 'value')
        ->with([
            'foodListVotes' => fn ($query) => $query
                ->where('user_id', $userId)
                ->select('id', 'food_list_id', 'user_id', 'value'),
            'restaurants', 
        ])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($searchQuery) use ($search) {
                    $searchQuery
                        ->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('tags', 'like', "%{$search}%");
                });
            })
            ->when($location !== '', function ($query) use ($location) {
                $query->where('location', 'like', "%{$location}%");
            })
            ->when($restaurantId > 0, function ($query) use ($restaurantId) { // <-- new
            $query->whereHas('restaurants', fn($q) => $q->where('restaurants.id', $restaurantId));
            });

        if ($view === 'popular' && $sort === 'latest') {
            $foodListsQuery->orderByDesc('vote_total')
                ->orderByDesc('created_at');
        } else {
            match ($sort) {
                'oldest' => $foodListsQuery->oldest(),
                'title_asc' => $foodListsQuery->orderBy('title'),
                'title_desc' => $foodListsQuery->orderByDesc('title'),
                default => $foodListsQuery->latest(),
            };
        }

        $foodLists = $foodListsQuery->get();
        $foodLists->each(function (FoodList $foodList) {
            $foodList->setAttribute('vote_total', (int) ($foodList->vote_total ?? 0));
            $foodList->setAttribute('current_user_vote', (int) ($foodList->foodListVotes->first()->value ?? 0));
        });

        // pass restaurants for filter dropdown
        $restaurants = Restaurant::orderBy('name')->get();

        $availableLocations = FoodList::query()
            ->whereNotNull('location')
            ->where('location', '!=', '')
            ->orderBy('location')
            ->distinct()
            ->pluck('location');
        $hasActiveFilters = $search !== '' || $location !== '' || $sort !== 'latest';
        $pageTitle = $view === 'popular' ? 'Popular Food Lists' : 'Latest Food Lists';
        $pageSummary = $view === 'popular'
            ? 'Browse the food lists earning the strongest vote support from the community, with upvotes and downvotes shaping the ranking.'
            : 'Explore the newest food lists first and discover fresh collections built for planning, sharing, and revisiting great meals.';

        return view('lists.index', compact(
            'foodLists',
            'view',
            'search',
            'location',
            'restaurantId',
            'sort',
            'availableLocations',
            'restaurants',
            'hasActiveFilters',
            'pageTitle',
            'pageSummary',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurants = Restaurant::query()
            ->orderBy('name')
            ->get();

        return view('lists.create', compact('restaurants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $foodList = FoodList::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'tags' => $validated['tags'] ?? null,
            'user_id' => $request->user()->id,
        ]);

        $foodList->restaurants()->sync($validated['restaurants'] ?? []);

        return redirect()->route('lists.index')->with('success', 'Food list created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodList $list)
    {
        $foodList = $list->loadSum('foodListVotes as vote_total', 'value')
            ->load([
                'foodListVotes' => fn ($query) => $query
                    ->where('user_id', auth()->id())
                    ->select('id', 'food_list_id', 'user_id', 'value'),
                'restaurants' => fn ($query) => $query->orderBy('name'),
            ]);

        $foodList->setAttribute('vote_total', (int) ($foodList->vote_total ?? 0));
        $foodList->setAttribute('current_user_vote', (int) ($foodList->foodListVotes->first()->value ?? 0));

        return view('lists.show', compact('foodList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodList $list)
    {
        abort_unless(auth()->id() === $list->user_id, 403);

        $foodList = $list->load('restaurants');
        $restaurants = Restaurant::query()
            ->orderBy('name')
            ->get();

        return view('lists.edit', compact('foodList', 'restaurants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoodList $list)
    {
        abort_unless($request->user()->id === $list->user_id, 403);

        $validated = $request->validate($this->rules());

        $list->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'tags' => $validated['tags'] ?? null,
        ]);

        $list->restaurants()->sync($validated['restaurants'] ?? []);

        return redirect()->to('/lists/' . $list->getKey())
            ->with('success', 'Food list updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodList $list)
    {
        abort_unless(auth()->id() === $list->user_id, 403);

        $list->delete();

        return redirect()->route('lists.index')
            ->with('success', 'Food list deleted successfully.');
    }

    public function upvote(Request $request, FoodList $list): RedirectResponse
    {
        return $this->toggleVote($request, $list, FoodListVote::UPVOTE);
    }

    public function downvote(Request $request, FoodList $list): RedirectResponse
    {
        return $this->toggleVote($request, $list, FoodListVote::DOWNVOTE);
    }

    private function toggleVote(Request $request, FoodList $list, int $value): RedirectResponse
    {
        $existingVote = FoodListVote::query()
            ->where('user_id', $request->user()->id)
            ->where('food_list_id', $list->id)
            ->first();

        if ($existingVote && $existingVote->value === $value) {
            $existingVote->delete();

            return back();
        }

        if ($existingVote) {
            $existingVote->update(['value' => $value]);

            return back();
        }

        FoodListVote::create([
            'user_id' => $request->user()->id,
            'food_list_id' => $list->id,
            'value' => $value,
        ]);

        return back();
    }

    private function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'tags' => 'nullable|string|max:255',
            'restaurants' => 'nullable|array',
            'restaurants.*' => 'exists:restaurants,id',
        ];
    }

    public function surprise(Request $request): JsonResponse
    {
        $allowedMoods = ['spicy', 'sweet', 'budget', 'fancy'];
        $mood = strtolower(trim((string) $request->query('mood', '')));

        if ($mood !== '' && !in_array($mood, $allowedMoods, true)) {
            $mood = '';
        }

        $foodList = null;
        $matchedByMood = false;

        if ($mood !== '') {
            $foodList = FoodList::query()
                ->where('tags', 'like', "%{$mood}%")
                ->inRandomOrder()
                ->first();

            $matchedByMood = $foodList !== null;
        }

        if (!$foodList) {
            $foodList = FoodList::query()
                ->inRandomOrder()
                ->first();
        }

        if (!$foodList) {
            return response()->json([
                'message' => 'No food lists are available yet.',
                'mood' => $mood !== '' ? $mood : null,
                'matched_by_mood' => false,
                'food_list' => null,
            ], 404);
        }

        return response()->json([
            'message' => 'Surprise food list selected.',
            'mood' => $mood !== '' ? $mood : null,
            'matched_by_mood' => $matchedByMood,
            'food_list' => [
                'id' => $foodList->id,
                'title' => $foodList->title,
                'description' => $foodList->description,
                'location' => $foodList->location,
                'tags' => $foodList->tags,
                'url' => route('lists.show', $foodList),
            ],
        ]);
    }
}
