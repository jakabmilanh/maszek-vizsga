<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch jobs from the database where deleted_at is NULL (not deleted)
        $jobs = Job::with('employer')->whereNull('deleted_at')->get();

        // Pass the jobs variable to the home view
        return view('home', compact('jobs'));
    }
    public function indexkapcsolat()
    {
        // Fetch jobs from the database where deleted_at is NULL (not deleted)
        $jobs = Job::whereNull('deleted_at')->get();

        // Pass the jobs variable to the home view
        return view('home', compact('jobs'));
    }
}
