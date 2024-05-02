<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'home');

Route::controller(JobController::class)->group(function() {
    
// Index
Route::get('/jobs', 'index');

// Store
Route::post('/jobs', 'store');

//Create
Route::get('/jobs/create', 'create');

// Show
Route::get('/jobs/{job}', 'show');

// Edit
Route::get('/jobs/{job}/edit', 'edit');

// Update
Route::patch('/jobs/{job}', 'update');

// Destroy
Route::delete('/jobs/{job}', 'destroy');
});



Route::view('/contact', 'contact');
