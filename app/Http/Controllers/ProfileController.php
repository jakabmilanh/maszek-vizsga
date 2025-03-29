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
use \App\Models\Application;
use \App\Models\Job;
use \App\Models\Review;

class ProfileController extends Controller
{

    public function show(User $user)
    {
    $currentUser = Auth::user();

    // Check for accepted applications relationship
    $hasRelation = Application::where('status', 'accepted')
        ->where(function($query) use ($currentUser, $user) {
            $query->whereHas('job', function($q) use ($currentUser, $user) {
                $q->where('employer_id', $currentUser->id)
                  ->where('employee_id', $user->id);
            })->orWhereHas('job', function($q) use ($currentUser, $user) {
                $q->where('employer_id', $user->id)
                  ->where('employee_id', $currentUser->id);
            });
        })->exists();

    $showContactInfo = $hasRelation;

    $sharedJobs = Job::whereHas('applications', function($q) use ($currentUser, $user) {
        $q->where('status', 'accepted')
          ->where(function($query) use ($currentUser, $user) {
              $query->where('employee_id', $user->id)
                    ->orWhere('employee_id', $currentUser->id);
          });
    })->get();

    $applications = Application::with(['job.employer'])
        ->where('employee_id', $user->id)
        ->orderByDesc('created_at')
        ->get();

    $jobs = $user->role === 'Munkáltató'
        ? Job::where('employer_id', $user->id)
            ->orderByDesc('created_at')
            ->get()
        : collect();

    $reviews = Review::with(['job', 'reviewer'])
        ->where('reviewee_id', $user->id)
        ->orderByDesc('created_at')
        ->get();

    $averageRating = $reviews->avg('rating') ?? 0;

    return view('profile.show', [
        'user' => $user,
        'showContactInfo' => $showContactInfo,
        'sharedJobs' => $sharedJobs,
        'applications' => $applications,
        'jobs' => $jobs,
        'reviews' => $reviews,
        'averageRating' => $averageRating
    ]);
    }

    public function edit(Request $request): View
    {
        $user = $request->user();
        $reviews = $user->reviewsReceived()->with('reviewer')->get();
        $jobs = $user->jobs; // Assuming the User model has a jobs() relationship

        return view('profile.edit', compact('user', 'jobs', 'reviews'));
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
