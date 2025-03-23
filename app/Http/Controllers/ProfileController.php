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


    public function show(User $user)
    {
        return view('profile.show', [
            'user' => $user
        ]);
    }
    public function edit(Request $request): View
    {
        $user = $request->user();
        $jobs = $user->jobs; // Assuming the User model has a jobs() relationship

        return view('profile.edit', compact('user', 'jobs'));
    }

    public function update(ProfileUpdateRequest $request, User $user)
    {



        if ($user->id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }


        $user->update([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'telephone' => $request->input('telephone'),
            'bio' => $request->input('bio', null),
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture && Storage::exists($user->profile_picture)) {
                Storage::delete($user->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $user->profile_picture = $path;
        }

        if ($request->hasFile('profession_pictures')) {
            $uploadedDocuments = [];

            foreach ($request->file('profession_pictures') as $file) {
                $storedPath = $file->store('documents', 'public');
                $uploadedDocuments[] = $storedPath;
            }

            $existingDocuments = json_decode($user->profession_pictures, true) ?? [];
            $user->profession_pictures = json_encode(array_merge($existingDocuments, $uploadedDocuments));
        }

        $user->save();

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
