<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use App\Mail\JobPosted;
use App\Models\Job;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('test', function() {

    $job = Job::first();
    TranslateJob::dispatch($job);

    return 'Done';
});


Route::view('/', 'home');

Route::resource('jobs', JobController::class);
// Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');


Route::view('/contact', 'contact');

// Auth

Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
