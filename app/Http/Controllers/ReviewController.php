<?php

namespace App\Http\Controllers;
use App\Models\Review;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(\App\Models\Job $job, \App\Models\User $user)
    {
        return view('reviews.create', compact('job', 'user'));
    }
    public function store(Request $request, $jobId, $userId)
    {
            $job = Job::findOrFail($jobId);
            $user = User::findOrFail($userId);
            // Validate the incoming request
            $validated = $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'review_text' => 'nullable|string',
            ]);

            // Check if the authenticated user has already reviewed this job
            $existingReview = Review::where('job_id', $job->job_id)
                                    ->where('reviewer_id', Auth::id())
                                    ->first();

            if ($existingReview) {
                return redirect()->route('jobs.show', $job)->with('error', 'You have already reviewed this job.');
            }

            // Create a new review
            $review = new Review();
            $review->job_id = $job->job_id;
            $review->reviewer_id = Auth::id();
            $review->reviewee_id = $user->id;
            $review->rating = $validated['rating'];
            $review->review_text = $validated['review_text'];
            $review->save();

            return redirect()->route('jobs.show', $job)->with('success', 'Review submitted successfully.');
        }
}
