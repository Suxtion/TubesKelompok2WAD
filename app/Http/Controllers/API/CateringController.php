<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CateringVendor;
use Illuminate\Http\Request;

class CateringController extends Controller
{
    public function index()
    {
        $vendors = CateringVendor::where('is_active', true)->get();
        return response()->json($vendors);
    }

    public function show($id)
    {
        $vendor = CateringVendor::with('menus')->findOrFail($id);
        return response()->json($vendor);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'contact' => 'required|string|max:255',
            'address' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('catering-vendors', 'public');
        }

        $vendor = CateringVendor::create($validated);

        return response()->json($vendor, 201);
    }

    public function update(Request $request, $id)
    {
        $vendor = CateringVendor::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'contact' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string',
            'logo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($vendor->logo) {
                Storage::disk('public')->delete($vendor->logo);
            }
            $validated['logo'] = $request->file('logo')->store('catering-vendors', 'public');
        }

        $vendor->update($validated);

        return response()->json($vendor);
    }

    public function destroy($id)
    {
        $vendor = CateringVendor::findOrFail($id);

        if ($vendor->logo) {
            Storage::disk('public')->delete($vendor->logo);
        }

        $vendor->delete();

        return response()->json(null, 204);
    }
}