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

    public function show($id)
    {
        $job = Job::with(['applications.employee'])
                 ->findOrFail($id);

        return view('jobs.show', compact('job'));
    }

    public function edit($id)
        {
            $job = Job::where('job_id', $id)->firstOrFail();

            // Verify job belongs to the authenticated employer
            if ($job->employer_id != Auth::id()) {
                return redirect()->route('home');
            }

            return view('jobs.edit', compact('job'));
        }

        public function update(Request $request, $id)
        {
            $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'required|string',
                'location' => 'required|string',
                'salary' => 'required|numeric|min:0',
                'description' => 'required|string',
            ]);

            // Find the job by ID
            $job = Job::where('job_id', $id)->firstOrFail();

            // Check if the job is open before updating
            if ($job->status !== 'open') {
                return redirect()->route('profile.edit')->with('error', 'You cannot update a closed or completed job.');
            }

            // Update the job fields
            $job->update([
                'title' => $request->title,
                'category' => $request->category,
                'location' => $request->location,
                'salary' => $request->salary,
                'description' => $request->description,
            ]);

            return redirect()->route('profile.edit')->with('success', 'Job updated successfully!');
        }
    public function close(Job $job)
    {
        if ($job->employer_id !== Auth::id()) {
            abort(403);
        }

        if ($job->status !== 'in progress') {
            return back()->with('error', 'Csak folyamatban lévő munkát lehet lezárni!');
        }

        $job->update(['status' => 'closed']);

        return back()->with('success', 'Munka sikeresen befejezve!');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'category' => 'required|string',
            'salary' => 'required|numeric|min:0',

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
    public function destroy(Job $job)
    {
        // Check if the job is open before deleting
        if ($job->status !== 'open') {
            return redirect()->route('profile.edit')->with('error', 'You cannot delete a closed or completed job.');
        }

        // Delete the job
        $job->delete();

        // Redirect back with a success message
        return redirect()->route('profile.edit')->with('success', 'Job deleted successfully.');
    }

        public function search(Request $request)
        {
            // Get all the jobs
            $jobs = Job::query();

            // Apply filters based on GET parameters
            if ($request->has('keyword') && $request->input('keyword') != '') {
                $jobs = $jobs->where('title', 'like', '%' . $request->input('keyword') . '%');
            }

            if ($request->has('category') && $request->input('category') != '') {
                $jobs = $jobs->where('category', $request->input('category'));
            }

            if ($request->has('location') && $request->input('location') != '') {
                $jobs = $jobs->where('location', 'like', '%' . $request->input('location') . '%');
            }

            if ($request->has('salary_min') && $request->input('salary_min') != '') {
                $jobs = $jobs->where('salary', '>=', $request->input('salary_min'));
            }

            if ($request->has('salary_max') && $request->input('salary_max') != '') {
                $jobs = $jobs->where('salary', '<=', $request->input('salary_max'));
            }

            // Paginate the results
            $jobs = $jobs->orderBy('created_at', 'desc')->paginate(10);

            return view('jobs.search', compact('jobs'));
        }


}

