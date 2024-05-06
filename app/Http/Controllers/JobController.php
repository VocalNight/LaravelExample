<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(3);

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {

        //return view('jobs.show', ['job' => Job::find($id)]);
        return view('jobs.show', ['job' => $job]);
    }

    public function store()
    {
        //validation
        request()->validate(([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]));

        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        Mail::to($job->employer->user)->send(
            new JobPosted($job)
        );

        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
      //  if (Auth::guest()) {
       //     return redirect('/login');
       // }

       // if ($job->employer->user->isNot(Auth::user())) {
       //     abort(403);
       // }

       Gate::authorize('edit-job', $job);

        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        //validate
        request()->validate(([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]));

        //authorize

        //update the job

        //$job = Job::find($id);
        // $job = Job::findOrFail($id);

        // $job->title = request('title');
        // $job->salary = request('salary');
        // $job->save();

        //---- Both of these do the same thing

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        //persist

        //redirect
        return redirect('/jobs/', $job->id);
    }

    public function destroy(Job $job)
    {
        // authorize

        //delete
        //$job = Job::findOrFail($id);
        $job->delete();

        //redirect
        return redirect('/jobs');
    }
}
