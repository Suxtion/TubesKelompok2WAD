<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CateringMenu;
use App\Models\CateringVendor;
use Illuminate\Http\Request;

class CateringMenuController extends Controller
{
    public function index($vendorId)
    {
        $vendor = CateringVendor::findOrFail($vendorId);
        $menus = $vendor->menus()->where('is_available', true)->get();
        return response()->json($menus);
    }

    public function store(Request $request, $vendorId)
    {
        $vendor = CateringVendor::findOrFail($vendorId);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_pax' => 'required|numeric|min:0',
            'minimum_order' => 'required|integer|min:1',
            'delivery_time_estimate' => 'required|integer|min:1',
            'is_available' => 'boolean',
        ]);

        $menu = $vendor->menus()->create($validated);

        return response()->json($menu, 201);
    }
}