<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['package', 'user'])->orderBy('BookingId', 'desc')->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function confirm($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update([
            'status' => 1,
        ]);

        return back()->with('success', 'Booking #' . $id . ' has been confirmed.');
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update([
            'status' => 2,
            'CancelledBy' => 'a',
        ]);

        return back()->with('success', 'Booking #' . $id . ' has been cancelled.');
    }
}

