<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Enquiry;
use App\Models\Issue;
use App\Models\TourPackage;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'issues' => Issue::count(),
            'packages' => TourPackage::count(),
            'enquiries' => Enquiry::count(),
            'new_enquiries' => Enquiry::whereNull('Status')->orWhere('Status', '')->count(),
            'read_enquiries' => Enquiry::where('Status', '1')->count(),
            'all_bookings' => Booking::count(),
            'new_bookings' => Booking::whereNull('status')->orWhere('status', 0)->count(),
            'cancelled_bookings' => Booking::where('status', 2)->count(),
            'confirmed_bookings' => Booking::where('status', 1)->count(),
        ];

        $recentBookings = Booking::with('package')->orderBy('BookingId', 'desc')->take(5)->get();
        $recentEnquiries = Enquiry::orderBy('id', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'recentEnquiries'));
    }
}

