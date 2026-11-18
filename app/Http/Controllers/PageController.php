<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function show($type)
    {
        $validTypes = ['terms', 'privacy', 'aboutus', 'contact'];
        if (!in_array($type, $validTypes)) {
            abort(404);
        }

        $page = Page::where('type', $type)->first();
        if (!$page) {
            abort(404);
        }

        $titles = [
            'terms' => 'Terms & Conditions',
            'privacy' => 'Privacy Policy',
            'aboutus' => 'About Wayfarer',
            'contact' => 'Contact Us',
        ];

        $title = $titles[$type] ?? ucfirst($type);

        return view('pages.show', compact('page', 'title', 'type'));
    }
}

