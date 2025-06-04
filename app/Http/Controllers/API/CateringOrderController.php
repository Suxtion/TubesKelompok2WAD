<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CateringOrder;
use App\Models\CateringMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CateringOrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->cateringOrders()->with(['vendor', 'menu'])->get();
        return response()->json($orders);
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
            return response()->json([
                'message' => 'Jumlah pax minimal adalah ' . $menu->minimum_order
            ], 422);
        }

        $validated['user_id'] = Auth::id();
        $validated['total_price'] = $menu->price_per_pax * $validated['pax'];

        $order = CateringOrder::create($validated);

        return response()->json($order, 201);
    }

    public function update(Request $request, $id)
    {
        $order = CateringOrder::where('user_id', Auth::id())->findOrFail($id);

        if ($order->status !== 'pending') {
            return response()->json([
                'message' => 'Pesanan sudah diproses dan tidak dapat diubah'
            ], 403);
        }

        $validated = $request->validate([
            'room_booking_id' => 'sometimes|required|exists:room_bookings,id',
            'catering_vendor_id' => 'sometimes|required|exists:catering_vendors,id',
            'catering_menu_id' => 'sometimes|required|exists:catering_menus,id',
            'event_date' => 'sometimes|required|date|after_or_equal:today',
            'pax' => 'sometimes|required|integer|min:1',
            'special_notes' => 'nullable|string',
            'contact_person' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|in:pending,sent_to_vendor,processing,completed,cancelled',
        ]);

        if (isset($validated['catering_menu_id'])) {
            $menu = CateringMenu::findOrFail($validated['catering_menu_id']);
            
            if ($validated['pax'] < $menu->minimum_order) {
                return response()->json([
                    'message' => 'Jumlah pax minimal adalah ' . $menu->minimum_order
                ], 422);
            }

            $validated['total_price'] = $menu->price_per_pax * $validated['pax'];
        }

        $order->update($validated);

        return response()->json($order);
    }

    public function destroy($id)
    {
        $order = CateringOrder::where('user_id', Auth::id())->findOrFail($id);

        if ($order->status !== 'pending') {
            return response()->json([
                'message' => 'Pesanan sudah diproses dan tidak dapat dibatalkan'
            ], 403);
        }

        $order->update(['status' => 'cancelled']);

        return response()->json(null, 204);
    }
}