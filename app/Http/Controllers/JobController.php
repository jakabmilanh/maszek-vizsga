<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
class JobController extends Controller
{
    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'category' => 'required|string',
            'salary' => 'required|numeric',

        ]);


        $job = new Job();

        $job->title = $validated['title'];
        $job->description = $validated['description'];
        $job->location = $validated['location'];
        $job->category = $validated['category'];
        $job->salary = $validated['salary'];
        $job->employer_id = Auth::id();

        $job->save();

        return redirect()->route('profile.edit')->with('success', 'Job posted successfully!');
    }
    public function destroy(Request $request)
{
    Job::where('job_id', $request->job_id)->delete();
    // Redirect back with a success message
    return redirect()->route('profile.edit')->with('success', 'Job deleted successfully.');

}


}

