<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    public function index()
    {
        return view('jobs.index', [
            'jobs' => Job::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    public function show(Job $job)
    {
        return view('jobs.show', [
            'job' => $job
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('jobs', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->user()->id;

        Job::create($formFields);

        return redirect('/')->with('success', 'Job posted successfully!');
    }

    public function manage()
    {
        return view('jobs.manage', [
            'jobs' => Job::where('user_id', auth()->id())->latest()->paginate(6)
        ]);
    }


    public function edit(Job $job)
    {
        $this->authorize('update', $job);

        return view('jobs.edit', [
            'job' => $job
        ]);
    }


    public function update(Request $request, Job $job)
    {
        $this->authorize('update', $job);

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->user()->id;

        $job->update($formFields);

        return back()->with('success', 'Job updated successfully!');
    }

    public function destroy(Job $job)
    {
        $this->authorize('delete', $job);
        
        $job->delete();
        return redirect('/')->with('success', 'Job deleted successfully!');
    }
}
