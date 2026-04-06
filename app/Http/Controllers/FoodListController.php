<?php

namespace App\Http\Controllers;

use App\Models\FoodList;
use App\Models\FoodListVote;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FoodListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $location = trim((string) $request->query('location', ''));
        $sort = (string) $request->query('sort', 'latest');
        $allowedSorts = ['latest', 'oldest', 'title_asc', 'title_desc'];
        $userId = $request->user()->id;

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'latest';
        }

        $foodListsQuery = FoodList::query()
            ->withSum('foodListVotes as vote_total', 'value')
            ->with([
                'foodListVotes' => fn ($query) => $query
                    ->where('user_id', $userId)
                    ->select('id', 'food_list_id', 'user_id', 'value'),
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
            });

        match ($sort) {
            'oldest' => $foodListsQuery->oldest(),
            'title_asc' => $foodListsQuery->orderBy('title'),
            'title_desc' => $foodListsQuery->orderByDesc('title'),
            default => $foodListsQuery->latest(),
        };

        $foodLists = $foodListsQuery->get();
        $foodLists->each(function (FoodList $foodList) {
            $foodList->setAttribute('vote_total', (int) ($foodList->vote_total ?? 0));
            $foodList->setAttribute('current_user_vote', (int) ($foodList->foodListVotes->first()->value ?? 0));
        });

        $availableLocations = FoodList::query()
            ->whereNotNull('location')
            ->where('location', '!=', '')
            ->orderBy('location')
            ->distinct()
            ->pluck('location');
        $hasActiveFilters = $search !== '' || $location !== '' || $sort !== 'latest';

        return view('lists.index', compact(
            'foodLists',
            'search',
            'location',
            'sort',
            'availableLocations',
            'hasActiveFilters',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'tags' => 'nullable|string|max:255',
        ]);

        FoodList::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'tags' => $validated['tags'],
            'user_id' => $request->user()->id,
        ]);

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

        $foodList = $list;

        return view('lists.edit', compact('foodList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoodList $list)
    {
        abort_unless($request->user()->id === $list->user_id, 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'tags' => 'nullable|string|max:255',
        ]);

        $list->update($validated);

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
}
