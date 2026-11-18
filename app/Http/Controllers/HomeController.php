<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use App\Models\User;
use App\Models\Enquiry;
use App\Models\Booking;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPackages = TourPackage::inRandomOrder()->take(4)->get();

        $stats = [
            'enquiries' => Enquiry::count(),
            'users' => User::count(),
            'bookings' => Booking::count(),
            'miles' => 24500,
        ];

        return view('home.index', compact('featuredPackages', 'stats'));
    }
}

