<?php

namespace App\Http\Controllers;

use App\Models\FoodList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class FoodListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viewMode = request('view', 'latest');
        $hasVotesColumn = Schema::hasColumn('food_lists', 'votes');

        $foodLists = FoodList::query()
            ->when(
                $viewMode === 'popular' && $hasVotesColumn,
                fn ($query) => $query->orderByDesc('votes')->latest(),
                fn ($query) => $query->latest()
            )
            ->get();

        return view('lists.index', compact('foodLists', 'viewMode', 'hasVotesColumn'));
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
        ]);

        FoodList::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('lists.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodList $foodList)
    {
        return view('lists.show', compact('foodList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodList $foodList)
    {
        return view('lists.edit', compact('foodList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoodList $foodList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodList $foodList)
    {
        //
    }
}
