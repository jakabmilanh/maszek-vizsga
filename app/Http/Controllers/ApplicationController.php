<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
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

        public function thankYou()
        {
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            return view('application.thankyou');
        }
}
