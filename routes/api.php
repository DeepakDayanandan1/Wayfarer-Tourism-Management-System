<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\TourPackage;

Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'framework' => 'Laravel',
        'app' => config('app.name'),
        'timestamp' => now()->toIso8601String(),
    ]);
});

Route::get('/packages', function () {
    return response()->json(TourPackage::orderBy('PackageId', 'desc')->get());
});

Route::get('/packages/{id}', function ($id) {
    $package = TourPackage::find($id);
    if (!$package) {
        return response()->json(['message' => 'Tour package not found'], 404);
    }
    return response()->json($package);
});

