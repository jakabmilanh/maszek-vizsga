<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to update your profile.');
        }

    // Validate input
    $validatedData = $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'telephone' => 'required|string|max:15',
        'bio' => 'nullable|string',
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'profession_pictures.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
    ]);

    // Update basic fields
    $user->username = $validatedData['username'];
    $user->email = $validatedData['email'];
    $user->telephone = $validatedData['telephone'];
    $user->bio = $validatedData['bio'];

    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
        // Delete old picture if exists
        if ($user->profile_picture && Storage::exists($user->profile_picture)) {
            Storage::delete($user->profile_picture);
        }

        // Save new picture
        $path = $request->file('profile_picture')->store('profile-pictures', 'public');
        $user->profile_picture = $path;
    }

    // Handle profession documents upload
    if ($request->hasFile('profession_pictures')) {
        $uploadedDocuments = [];
        foreach ($request->file('profession_pictures') as $file) {
            $uploadedDocuments[] = $file->store('documents', 'public');
        }

        $existingDocuments = json_decode($user->profession_pictures, true) ?? [];
        $user->profession_pictures = json_encode(array_merge($existingDocuments, $uploadedDocuments));
    }

    // Save user
    $user->save();

    // Redirect back with success message
    return back()->with('success', 'Profil frissítve!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
