<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = TourPackage::orderBy('PackageId', 'desc')->paginate(10);
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'packagename' => 'required|string|max:200',
            'packagetype' => 'required|string|max:150',
            'packagelocation' => 'required|string|max:100',
            'packageprice' => 'required|numeric|min:0',
            'packagefeatures' => 'required|string|max:255',
            'packagedetails' => 'required|string',
            'packageimage' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $imageName = null;
        if ($request->hasFile('packageimage')) {
            $image = $request->file('packageimage');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('packageimages'), $imageName);
            // Also copy to admin pacakgeimages for compatibility
            @copy(public_path('packageimages/' . $imageName), public_path('admin/pacakgeimages/' . $imageName));
        }

        TourPackage::create([
            'PackageName' => $validated['packagename'],
            'PackageType' => $validated['packagetype'],
            'PackageLocation' => $validated['packagelocation'],
            'PackagePrice' => $validated['packageprice'],
            'PackageFetures' => $validated['packagefeatures'],
            'PackageDetails' => $validated['packagedetails'],
            'PackageImage' => $imageName,
        ]);

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully!');
    }

    public function edit($id)
    {
        $package = TourPackage::findOrFail($id);
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $package = TourPackage::findOrFail($id);

        $validated = $request->validate([
            'packagename' => 'required|string|max:200',
            'packagetype' => 'required|string|max:150',
            'packagelocation' => 'required|string|max:100',
            'packageprice' => 'required|numeric|min:0',
            'packagefeatures' => 'required|string|max:255',
            'packagedetails' => 'required|string',
        ]);

        $package->update([
            'PackageName' => $validated['packagename'],
            'PackageType' => $validated['packagetype'],
            'PackageLocation' => $validated['packagelocation'],
            'PackagePrice' => $validated['packageprice'],
            'PackageFetures' => $validated['packagefeatures'],
            'PackageDetails' => $validated['packagedetails'],
        ]);

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully!');
    }

    public function changeImageForm($id)
    {
        $package = TourPackage::findOrFail($id);
        return view('admin.packages.change-image', compact('package'));
    }

    public function updateImage(Request $request, $id)
    {
        $package = TourPackage::findOrFail($id);

        $request->validate([
            'packageimage' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('packageimage')) {
            $image = $request->file('packageimage');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('packageimages'), $imageName);
            @copy(public_path('packageimages/' . $imageName), public_path('admin/pacakgeimages/' . $imageName));

            $package->update(['PackageImage' => $imageName]);
        }

        return redirect()->route('admin.packages.index')->with('success', 'Package image updated successfully!');
    }

    public function destroy($id)
    {
        $package = TourPackage::findOrFail($id);
        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully.');
    }
}

