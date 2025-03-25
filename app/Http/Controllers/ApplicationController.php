<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{

            public function update(Request $request, Application $application)
            {
                // Verify the job belongs to the employer
                if ($application->job->employer_id !== Auth::id()) {
                    abort(403);
                }

                $validated = $request->validate([
                    'status' => 'required|in:accepted,rejected'
                ]);

                DB::transaction(function () use ($application, $validated) {
                    if ($validated['status'] === 'accepted') {
                        // Reject all other applications for this job
                        Application::where('job_id', $application->job_id)
                            ->where('application_id', '!=', $application->id)
                            ->update(['status' => 'rejected']);

                        // Close the job listing
                        $application->job->update(['status' => 'in progress']);
                    }

                    // Update the current application
                    $application->update($validated);
                });

                return back()->with('success', 'Státusz frissítve!');
            }



            public function create(Job $job)
            {
                // Check if user is authenticated
                if (!Auth::check()) {
                    return redirect()->route('login');
                }

                // Check if user is trying to apply to their own job
                if ($job->employer_id === Auth::id()) {
                    return redirect()->route('home')->with('error', 'Saját hirdetésedre nem jelentkezhetsz!');
                }

                // Check for existing application using Auth::id()
                $hasApplied = Application::where('employee_id', Auth::id())
                ->where('job_id', $job->job_id)
                ->exists();

                if ($hasApplied) {
                        return redirect()->route('home')->with('error', 'Már jelentkeztél erre az állásra!');
                }

                return view('application.create', [
                    'job' => $job, // Make sure to pass the job to the view
                    'user' => Auth::user()
                ]);
            }



            public function store(Job $job, Request $request)
            {
                // Check authentication
                if (!Auth::check()) {
                    return redirect()->route('login');
                }

                // Prevent self-application
                if ($job->employer_id === Auth::id()) {
                    return redirect()->route('home')->with('error', 'Saját hirdetésedre nem jelentkezhetsz!');
                }

                // Check if job is open for applications
                if ($job->status !== 'open') {
                    return redirect()->route('home')->with('error', 'Erre a hírdetésre már nem lehet jelentkezni');
                }

                // Validate request
                $request->validate([
                    'cover_letter' => 'required|string|max:2000'
                ]);

                // Check for existing application
                $existingApplication = Application::where([
                    'employee_id' => Auth::id(),
                    'job_id' => $job->job_id
                ])->exists();

                if ($existingApplication) {
                    return redirect()->back()->with('error', 'Már jelentkeztél erre az állásra!');
                }

                // Create application
                Application::create([
                    'job_id' => $job->job_id,
                    'employee_id' => Auth::id(),
                    'cover_letter' => $request->cover_letter,
                    'status' => 'pending'
                ]);

                return redirect()->route('applications.thankyou');
            }


            public function cancel(Application $application)
                {
                    // Ensure the authenticated user owns the application before canceling
                    if (Auth::id() !== $application->employee_id) {
                        return redirect()->back()->with('error', 'Nem jogosult a jelentkezés törlésére.');
                    }

                    // Check if the application can still be canceled (not already accepted)
                    if ($application->status !== 'pending') {
                        return redirect()->back()->with('error', 'Csak a függőben lévő jelentkezéseket lehet visszavonni.');
                    }

                    // Delete the application
                    $application->delete();

                    return redirect()->back()->with('success', 'A jelentkezés sikeresen visszavonva.');
                }

            public function thankYou()
            {
                if (!Auth::check()) {
                    return redirect()->route('login');
                }

                return view('application.thankyou');
            }
}
