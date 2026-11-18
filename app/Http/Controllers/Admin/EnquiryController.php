<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::orderBy('id', 'desc')->paginate(15);
        return view('admin.enquiries.index', compact('enquiries'));
    }

    public function markAsRead($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->update(['Status' => 1]);

        return back()->with('success', 'Inquiry #' . $id . ' marked as read.');
    }

    public function destroy($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->delete();

        return back()->with('success', 'Inquiry #' . $id . ' deleted successfully.');
    }
}

