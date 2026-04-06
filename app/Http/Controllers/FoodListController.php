<?php

namespace App\Http\Controllers;

use App\Models\FoodList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FoodListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foodLists = FoodList::latest()->get();

        return view('lists.index', compact('foodLists'));
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
        $foodList = $list;

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
}
