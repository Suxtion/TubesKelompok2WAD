<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CateringOrder;
use App\Models\CateringVendor;
use App\Models\RoomBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CateringOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Auth::user()->cateringOrders()->with(['vendor', 'menu'])->get();
        return view('catering-orders.index', compact('orders'));
    }

    public function create()
    {
        $bookings = RoomBooking::where('user_id', Auth::id())
            ->where('end_time', '>', now())
            ->get();
            
        $vendors = CateringVendor::where('is_active', true)->get();
        
        return view('catering-orders.create', compact('bookings', 'vendors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_booking_id' => 'required|exists:room_bookings,id',
            'catering_vendor_id' => 'required|exists:catering_vendors,id',
            'catering_menu_id' => 'required|exists:catering_menus,id',
            'event_date' => 'required|date|after_or_equal:today',
            'pax' => 'required|integer|min:1',
            'special_notes' => 'nullable|string',
            'contact_person' => 'required|string|max:255',
        ]);

        $menu = CateringMenu::findOrFail($validated['catering_menu_id']);
        
        if ($validated['pax'] < $menu->minimum_order) {
            return back()->withErrors(['pax' => 'Jumlah pax minimal adalah ' . $menu->minimum_order]);
        }

        $validated['user_id'] = Auth::id();
        $validated['total_price'] = $menu->price_per_pax * $validated['pax'];

        CateringOrder::create($validated);

        return redirect()->route('catering-orders.index')
            ->with('success', 'Pesanan catering berhasil dibuat');
    }

    public function show(CateringOrder $cateringOrder)
    {
        $this->authorize('view', $cateringOrder);
        return view('catering-orders.show', compact('cateringOrder'));
    }

    public function edit(CateringOrder $cateringOrder)
    {
        $this->authorize('update', $cateringOrder);
        
        if ($cateringOrder->status !== 'pending') {
            return redirect()->route('catering-orders.index')
                ->with('error', 'Pesanan sudah diproses dan tidak dapat diubah');
        }

        $bookings = RoomBooking::where('user_id', Auth::id())
            ->where('end_time', '>', now())
            ->get();
            
        $vendors = CateringVendor::where('is_active', true)->get();
        
        return view('catering-orders.edit', compact('cateringOrder', 'bookings', 'vendors'));
    }

    public function update(Request $request, CateringOrder $cateringOrder)
    {
        $this->authorize('update', $cateringOrder);

        if ($cateringOrder->status !== 'pending') {
            return redirect()->route('catering-orders.index')
                ->with('error', 'Pesanan sudah diproses dan tidak dapat diubah');
        }

        $validated = $request->validate([
            'room_booking_id' => 'required|exists:room_bookings,id',
            'catering_vendor_id' => 'required|exists:catering_vendors,id',
            'catering_menu_id' => 'required|exists:catering_menus,id',
            'event_date' => 'required|date|after_or_equal:today',
            'pax' => 'required|integer|min:1',
            'special_notes' => 'nullable|string',
            'contact_person' => 'required|string|max:255',
        ]);

        $menu = CateringMenu::findOrFail($validated['catering_menu_id']);
        
        if ($validated['pax'] < $menu->minimum_order) {
            return back()->withErrors(['pax' => 'Jumlah pax minimal adalah ' . $menu->minimum_order]);
        }

        $validated['total_price'] = $menu->price_per_pax * $validated['pax'];

        $cateringOrder->update($validated);

        return redirect()->route('catering-orders.index')
            ->with('success', 'Pesanan catering berhasil diperbarui');
    }

    public function destroy(CateringOrder $cateringOrder)
    {
        $this->authorize('delete', $cateringOrder);

        if ($cateringOrder->status !== 'pending') {
            return redirect()->route('catering-orders.index')
                ->with('error', 'Pesanan sudah diproses dan tidak dapat dibatalkan');
        }

        $cateringOrder->update(['status' => 'cancelled']);

        return redirect()->route('catering-orders.index')
            ->with('success', 'Pesanan catering berhasil dibatalkan');
    }
}