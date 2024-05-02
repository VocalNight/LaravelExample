<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;


Route::get('/', function () {
    return view('home');
});

// Index
Route::get('/jobs', function ()  {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});


// Store
Route::post('/jobs', function() {
    //validation
    request()->validate(([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]));

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});


//Create
Route::get('/jobs/create', function() {
    return view('jobs.create');
});


// Show
Route::get('/jobs/{id}', function ($id) {

    return view('jobs.show', ['job' => Job::find($id)]);
});

// Edit
Route::get('/jobs/{id}/edit', function ($id) {

    return view('jobs.edit', ['job' => Job::find($id)]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {
    //validate
    request()->validate(([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]));

    //authorize

    //update the job

    //$job = Job::find($id);
    $job = Job::findOrFail($id);

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
    return redirect('/jobs/' , $job->id);
  
});

// Destroy
Route::delete('/jobs/{id}', function ($id) {
    // authorize

    //delete
    $job = Job::findOrFail($id);
    $job->delete();

    //redirect
    return redirect('/jobs');

});

Route::get('/contact', function () {
    return view('contact');
});
