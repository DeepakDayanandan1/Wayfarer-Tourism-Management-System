<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $issues = Issue::where('UserEmail', Auth::user()->EmailId)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('issues.index', compact('issues'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'issue' => 'required|string|max:100',
            'description' => 'required|string|max:2000',
        ]);

        Issue::create([
            'UserEmail' => Auth::user()->EmailId,
            'Issue' => $validated['issue'],
            'Description' => $validated['description'],
        ]);

        return back()->with('success', 'Support ticket submitted successfully. Our team will look into it.');
    }
}

