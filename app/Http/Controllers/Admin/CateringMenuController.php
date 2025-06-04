<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CateringMenu;
use App\Models\CateringVendor;
use Illuminate\Http\Request;

class CateringMenuController extends Controller
{
    public function index(CateringVendor $vendor)
    {
        $menus = $vendor->menus;
        return view('admin.catering-menus.index', compact('vendor', 'menus'));
    }

    public function create(CateringVendor $vendor)
    {
        return view('admin.catering-menus.create', compact('vendor'));
    }

    public function store(Request $request, CateringVendor $vendor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_pax' => 'required|numeric|min:0',
            'minimum_order' => 'required|integer|min:1',
            'delivery_time_estimate' => 'required|integer|min:1',
            'is_available' => 'boolean',
        ]);

        $vendor->menus()->create($validated);

        return redirect()->route('admin.catering-vendors.menus.index', $vendor->id)
            ->with('success', 'Menu catering berhasil ditambahkan');
    }

    public function show(CateringVendor $vendor, CateringMenu $menu)
    {
        return view('admin.catering-menus.show', compact('vendor', 'menu'));
    }

    public function edit(CateringVendor $vendor, CateringMenu $menu)
    {
        return view('admin.catering-menus.edit', compact('vendor', 'menu'));
    }

    public function update(Request $request, CateringVendor $vendor, CateringMenu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_pax' => 'required|numeric|min:0',
            'minimum_order' => 'required|integer|min:1',
            'delivery_time_estimate' => 'required|integer|min:1',
            'is_available' => 'boolean',
        ]);

        $menu->update($validated);

        return redirect()->route('admin.catering-vendors.menus.index', $vendor->id)
            ->with('success', 'Menu catering berhasil diperbarui');
    }

    public function destroy(CateringVendor $vendor, CateringMenu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.catering-vendors.menus.index', $vendor->id)
            ->with('success', 'Menu catering berhasil dihapus');
    }
}