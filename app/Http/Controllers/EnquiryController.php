<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index()
    {
        return view('enquiries.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'mobileno' => 'required|digits:10',
            'subject' => 'required|string|max:100',
            'description' => 'required|string|max:2000',
        ]);

        Enquiry::create([
            'FullName' => $validated['fname'],
            'EmailId' => $validated['email'],
            'MobileNumber' => $validated['mobileno'],
            'Subject' => $validated['subject'],
            'Description' => $validated['description'],
            'Status' => 0,
        ]);

        return redirect()->route('enquiry.index')->with('success', 'Your inquiry has been submitted successfully! Our travel specialist will contact you shortly.');
    }
}

