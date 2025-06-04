@extends('layouts.app')

@section('title', 'Edit Pesanan Catering')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Pesanan Catering</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('catering-orders.update', $cateringOrder->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="room_booking_id" class="form-label">Pemesanan Ruangan</label>
                <select class="form-select" id="room_booking_id" name="room_booking_id" required>
                    <option value="">Pilih Pemesanan Ruangan</option>
                    @foreach($bookings as $booking)
                        <option value="{{ $booking->id }}" {{ $cateringOrder->room_booking_id == $booking->id ? 'selected' : '' }}>
                            {{ $booking->room->name }} - {{ $booking->start_time->format('d M Y H:i') }} s/d {{ $booking->end_time->format('H:i') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="catering_vendor_id" class="form-label">Penyedia Catering</label>
                <select class="form-select" id="catering_vendor_id" name="catering_vendor_id" required>
                    <option value="">Pilih Penyedia Catering</option>
                    @foreach($vendors as $vendor)
                        <option value="{{ $vendor->id }}" {{ $cateringOrder->catering_vendor_id == $vendor->id ? 'selected' : '' }}>
                            {{ $vendor->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="catering_menu_id" class="form-label">Menu Catering</label>
                <select class="form-select" id="catering_menu_id" name="catering_menu_id" required>
                    <option value="">Pilih Menu Catering</option>
                    @foreach($cateringOrder->vendor->menus as $menu)
                        <option value="{{ $menu->id }}" 
                            {{ $cateringOrder->catering_menu_id == $menu->id ? 'selected' : '' }}
                            data-price="{{ $menu->price_per_pax }}"
                            data-min-order="{{ $menu->minimum_order }}">
                            {{ $menu->name }} (Rp {{ number_format($menu->price_per_pax, 0, ',', '.') }} per pax)
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="event_date" class="form-label">Tanggal dan Jam Acara</label>
                <input type="datetime-local" class="form-control" id="event_date" name="event_date" 
                    value="{{ $cateringOrder->event_date->format('Y-m-d\TH:i') }}" required>
            </div>
            <div class="mb-3">
                <label for="pax" class="form-label">Jumlah Pax</label>
                <input type="number" class="form-control" id="pax" name="pax" min="1" 
                    value="{{ $cateringOrder->pax }}" required>
                <small class="form-text text-muted">Minimal order: <span id="min-order-display">{{ $cateringOrder->menu->minimum_order }}</span> pax</small>
            </div>
            <div class="mb-3">
                <label for="special_notes" class="form-label">Catatan Khusus</label>
                <textarea class="form-control" id="special_notes" name="special_notes" rows="3">{{ $cateringOrder->special_notes }}</textarea>
            </div>
            <div class="mb-3">
                <label for="contact_person" class="form-label">Kontak Person Acara</label>
                <input type="text" class="form-control" id="contact_person" name="contact_person" 
                    value="{{ $cateringOrder->contact_person }}" required>
            </div>
            <div class="mb-3">
                <strong>Total Harga:</strong> <span id="total-price">Rp {{ number_format($cateringOrder->total_price, 0, ',', '.') }}</span>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('catering-orders.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuSelect = document.getElementById('catering_menu_id');
        const minOrderDisplay = document.getElementById('min-order-display');
        const paxInput = document.getElementById('pax');
        const totalPriceDisplay = document.getElementById('total-price');
        
        // Update min order and calculate price when menu changes
        menuSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                minOrderDisplay.textContent = selectedOption.dataset.minOrder;
                paxInput.min = selectedOption.dataset.minOrder;
                calculateTotalPrice();
            }
        });
        
        // Calculate total price when pax changes
        paxInput.addEventListener('input', calculateTotalPrice);
        
        function calculateTotalPrice() {
            const selectedOption = menuSelect.options[menuSelect.selectedIndex];
            if (selectedOption.value && paxInput.value) {
                const price = parseFloat(selectedOption.dataset.price);
                const pax = parseInt(paxInput.value);
                const total = price * pax;
                totalPriceDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
            }
        }
    });
</script>
@endpush
@endsection