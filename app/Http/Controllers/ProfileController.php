<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use \App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, ): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, User $user)
{
// Log the incoming request data (if necessary)

    // If the user ID in the route does not match the authenticated user's ID, abort
    if ($user->id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    // Update basic user fields
    $user->update([
        'username' => $request->input('username'),
        'email' => $request->input('email'),
        'telephone' => $request->input('telephone'),
        'bio' => $request->input('bio', null), // Default to null if no bio
    ]);

    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
        // Delete the old profile picture if it exists
        if ($user->profile_picture && Storage::exists($user->profile_picture)) {
            Storage::delete($user->profile_picture);
        }

        // Store the new profile picture
        $path = $request->file('profile_picture')->store('profile-pictures', 'public');
        $user->profile_picture = $path;
    }

    // Handle profession pictures/documents upload
    if ($request->hasFile('profession_pictures')) {
        $uploadedDocuments = [];

        // Loop through the uploaded profession pictures/documents
        foreach ($request->file('profession_pictures') as $file) {
            $storedPath = $file->store('documents', 'public');
            $uploadedDocuments[] = $storedPath;
        }

        // Merge the new documents with existing ones
        $existingDocuments = json_decode($user->profession_pictures, true) ?? [];
        $user->profession_pictures = json_encode(array_merge($existingDocuments, $uploadedDocuments));
    }

    // Save the updated user details
    $user->save();

    // Return success response (Redirect back with a success message)
    return back()->with('success', 'Profile updated successfully!');
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
