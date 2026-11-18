<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use Illuminate\Http\Request;

class TourPackageController extends Controller
{
    public function index(Request $request)
    {
        $query = TourPackage::query();

        if ($request->filled('type')) {
            $query->where('PackageType', $request->type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('PackageName', 'like', "%{$search}%")
                  ->orWhere('PackageLocation', 'like', "%{$search}%")
                  ->orWhere('PackageType', 'like', "%{$search}%");
            });
        }

        $packages = $query->orderBy('PackageId', 'desc')->paginate(9)->withQueryString();
        $types = TourPackage::select('PackageType')->distinct()->pluck('PackageType');

        return view('packages.index', compact('packages', 'types'));
    }

    public function show($id)
    {
        $package = TourPackage::findOrFail($id);
        $relatedPackages = TourPackage::where('PackageId', '!=', $id)
            ->where('PackageType', $package->PackageType)
            ->take(3)
            ->get();

        return view('packages.show', compact('package', 'relatedPackages'));
    }
}

