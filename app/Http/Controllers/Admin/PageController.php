<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $selectedType = $request->get('type', 'terms');
        $page = Page::where('type', $selectedType)->first();

        return view('admin.pages.index', compact('page', 'selectedType'));
    }

    public function update(Request $request)
    {
        if ($request->has('pgedetails') && !$request->has('detail')) {
            $request->merge(['detail' => $request->pgedetails]);
        }

        $request->validate([
            'type' => 'required|string',
            'detail' => 'required|string',
        ]);

        $page = Page::where('type', $request->type)->first();

        if ($page) {
            $page->update(['detail' => $request->detail]);
        } else {
            Page::create([
                'type' => $request->type,
                'detail' => $request->detail,
            ]);
        }

        return back()->with('success', 'Page content for ' . strtoupper($request->type) . ' updated successfully!');
    }
}

