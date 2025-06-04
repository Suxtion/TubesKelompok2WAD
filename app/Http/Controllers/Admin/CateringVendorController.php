<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CateringVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CateringVendorController extends Controller
{
    public function index()
    {
        $vendors = CateringVendor::all();
        return view('admin.catering-vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('admin.catering-vendors.create');
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

        CateringVendor::create($validated);

        return redirect()->route('admin.catering-vendors.index')
            ->with('success', 'Penyedia catering berhasil ditambahkan');
    }

    public function show(CateringVendor $cateringVendor)
    {
        return view('admin.catering-vendors.show', compact('cateringVendor'));
    }

    public function edit(CateringVendor $cateringVendor)
    {
        return view('admin.catering-vendors.edit', compact('cateringVendor'));
    }

    public function update(Request $request, CateringVendor $cateringVendor)
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
            // Hapus logo lama jika ada
            if ($cateringVendor->logo) {
                Storage::disk('public')->delete($cateringVendor->logo);
            }
            $validated['logo'] = $request->file('logo')->store('catering-vendors', 'public');
        }

        $cateringVendor->update($validated);

        return redirect()->route('admin.catering-vendors.index')
            ->with('success', 'Penyedia catering berhasil diperbarui');
    }

    public function destroy(CateringVendor $cateringVendor)
    {
        if ($cateringVendor->logo) {
            Storage::disk('public')->delete($cateringVendor->logo);
        }

        $cateringVendor->delete();

        return redirect()->route('admin.catering-vendors.index')
            ->with('success', 'Penyedia catering berhasil dihapus');
    }
}