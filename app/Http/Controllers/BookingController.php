<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request, $packageId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to book this package.');
        }

        if ($request->has('fromdate') && !$request->has('from_date')) {
            $request->merge(['from_date' => $request->fromdate]);
        }
        if ($request->has('todate') && !$request->has('to_date')) {
            $request->merge(['to_date' => $request->todate]);
        }

        $request->validate([
            'from_date' => 'required|date|after_or_equal:today',
            'to_date' => 'required|date|after_or_equal:from_date',
            'comment' => 'nullable|string|max:1000',
        ]);

        $package = TourPackage::findOrFail($packageId);

        $booking = Booking::create([
            'PackageId' => $package->PackageId,
            'UserEmail' => Auth::user()->EmailId,
            'FromDate' => $request->from_date,
            'ToDate' => $request->to_date,
            'Comment' => $request->comment ?: 'NA',
            'status' => 0,
        ]);

        return redirect()->route('bookings.thankyou')->with([
            'success' => 'Your booking has been placed successfully!',
            'bookingId' => $booking->BookingId,
            'package' => $package,
        ]);
    }

    public function thankyou()
    {
        return view('bookings.thankyou');
    }

    public function history()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $bookings = Booking::with('package')
            ->where('UserEmail', Auth::user()->EmailId)
            ->orderBy('BookingId', 'desc')
            ->paginate(10);

        return view('bookings.history', compact('bookings'));
    }

    public function cancel(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $booking = Booking::where('BookingId', $id)
            ->where('UserEmail', Auth::user()->EmailId)
            ->firstOrFail();

        $booking->update([
            'status' => 2,
            'CancelledBy' => 'u',
        ]);

        return back()->with('success', 'Booking cancelled successfully.');
    }
}

