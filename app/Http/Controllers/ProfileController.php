<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user()->load([
            'foodListVotes',
            'foodLists.restaurants',
            'foodLists.foodListVotes',
        ]);

        return view('profile.show', [
            'user' => $user,
            'pageTitle' => 'Your Profile',
            'pageSummary' => 'Manage your account details, personal profile, and the food lists you have curated.',
        ]);
    }

    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', [
            'user' => $user,
            'pageTitle' => 'Edit Profile',
            'pageSummary' => 'Keep your TasteTrail profile current with a photo, location, and a short introduction.',
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'password' => ['nullable', Password::min(8)->mixedCase()->numbers()],
            'password_confirmation' => 'nullable|same:password',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->location = $validated['location'] ?? null;
        $user->bio = $validated['bio'] ?? null;

        if ($request->hasFile('profile_image')) {
            if (!empty($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $user->profile_image = $request->file('profile_image')->store('profile-images', 'public');
        }

        if ($request->filled('password')) 
        {
            $user->password = $request->password;
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}
