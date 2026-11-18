<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:100',
            'mobilenumber' => 'required|digits:10',
            'email' => 'required|email|max:70|unique:tblusers,EmailId',
            'password' => 'required|min:4',
        ]);

        $user = User::create([
            'FullName' => $validated['fname'],
            'MobileNumber' => $validated['mobilenumber'],
            'EmailId' => $validated['email'],
            'Password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Account created successfully! Welcome to Wayfarer.');
    }
}

