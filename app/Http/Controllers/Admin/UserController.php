<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function userBookings($email)
    {
        $user = User::where('EmailId', $email)->first();
        $bookings = Booking::with('package')->where('UserEmail', $email)->orderBy('BookingId', 'desc')->get();

        return view('admin.users.bookings', compact('user', 'bookings', 'email'));
    }
}

