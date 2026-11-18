<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword(Request $request)
    {
        if ($request->has('newpassword') && !$request->has('new_password')) {
            $request->merge([
                'new_password' => $request->newpassword,
                'new_password_confirmation' => $request->confirmpassword,
            ]);
        }

        $request->validate([
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'new_password' => 'required|min:4|confirmed',
        ]);

        $user = User::where('EmailId', $request->email)
            ->where('MobileNumber', $request->mobile)
            ->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No account matched that Email and Mobile number combination.'])->withInput();
        }

        $user->update([
            'Password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('login')->with('success', 'Password reset successfully! Please login with your new password.');
    }
}

