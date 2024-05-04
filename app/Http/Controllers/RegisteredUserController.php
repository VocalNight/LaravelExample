<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create() {
        return view('auth.register');
    }

    public function store() {
        //validation
        //request return all the validated fields
        $validatedAttributes = request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(4), 'confirmed'], //password_confirmation
        ]);

        //create user
        $user = User::create($validatedAttributes);

        // log in
        Auth::login($user);

        // Redirect

        return redirect('/jobs');
    }
}
