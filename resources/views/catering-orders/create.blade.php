@extends('layouts.app')

@section('title', 'Pesan Catering Baru')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Pesan Catering Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('catering-orders.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="room_booking_id" class="form-label">Pemesanan Ruangan</label>
                <select class="form-select" id="room_booking_id" name="room_booking_id" required>
                    <option value="">Pilih Pemesanan Ruangan</option>
                    @foreach($bookings as $booking)
                        <option value="{{ $booking->id }}">{{ $booking->room->name }} - {{ $booking->start_time->format('d M Y H:i') }} s/d {{ $booking->end_time->format('H:i') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="catering_vendor_id" class="form-label">Penyedia Catering</label>
                <select class="form-select" id="catering_vendor_id" name="catering_vendor_id" required>
                    <option value="">Pilih Penyedia Catering</option>
                    @foreach($vendors as $vendor)
                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="catering_menu_id" class="form-label">Menu Catering</label>
                <select class="form-select" id="catering_menu_id" name="catering_menu_id" required disabled>
                    <option value="">Pilih Menu Catering</option>
                </select>
                <div id="menu-details" class="mt-2 p-3 bg-light rounded d-none">
                    <h6>Detail Menu</h6>
                    <p id="menu-description"></p>
                    <p><strong>Harga per Pax:</strong> <span id="menu-price"></span></p>
                    <p><strong>Minimal Order:</strong> <span id="menu-min-order"></span> pax</p>
                    <p><strong>Estimasi Waktu Kirim:</strong> <span id="menu-delivery-time"></span> menit</p>
                </div>
            </div>
            <div class="mb-3">
                <label for="event_date" class="form-label">Tanggal dan Jam Acara</label>
                <input type="datetime-local" class="form-control" id="event_date" name="event_date" required>
            </div>
            <div class="mb-3">
                <label for="pax" class="form-label">Jumlah Pax</label>
                <input type="number" class="form-control" id="pax" name="pax" min="1" required>
                <small id="pax-help" class="form-text text-muted">Minimal order: <span id="min-order-display">1</span> pax</small>
            </div>
            <div class="mb-3">
                <label for="special_notes" class="form-label">Catatan Khusus</label>
                <textarea class="form-control" id="special_notes" name="special_notes" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="contact_person" class="form-label">Kontak Person Acara</label>
                <input type="text" class="form-control" id="contact_person" name="contact_person" required>
            </div>
            <div class="mb-3">
                <strong>Total Harga:</strong> <span id="total-price">Rp 0</span>
            </div>
            <button type="submit" class="btn btn-primary">Pesan</button>
            <a href="{{ route('catering-orders.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const vendorSelect = document.getElementById('catering_vendor_id');
        const menuSelect = document.getElementById('catering_menu_id');
        const menuDetails = document.getElementById('menu-details');
        const menuDescription = document.getElementById('menu-description');
        const menuPrice = document.getElementById('menu-price');
        const menuMinOrder = document.getElementById('menu-min-order');
        const menuDeliveryTime = document.getElementById('menu-delivery-time');
        const minOrderDisplay = document.getElementById('min-order-display');
        const paxInput = document.getElementById('pax');
        const totalPriceDisplay = document.getElementById('total-price');
        
        // Load menus when vendor is selected
        vendorSelect.addEventListener('change', function() {
            const vendorId = this.value;
            menuSelect.disabled = !vendorId;
            
            if (vendorId) {
                fetch(`/api/catering/${vendorId}/menu`)
                    .then(response => response.json())
                    .then(data => {
                        menuSelect.innerHTML = '<option value="">Pilih Menu Catering</option>';
                        data.forEach(menu => {
                            const option = document.createElement('option');
                            option.value = menu.id;
                            option.textContent = menu.name;
                            option.dataset.description = menu.description;
                            option.dataset.price = menu.price_per_pax;
                            option.dataset.minOrder = menu.minimum_order;
                            option.dataset.deliveryTime = menu.delivery_time_estimate;
                            menuSelect.appendChild(option);
                        });
                    });
            } else {
                menuSelect.innerHTML = '<option value="">Pilih Menu Catering</option>';
                menuDetails.classList.add('d-none');
            }
        });
        
        // Show menu details when menu is selected
        menuSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            
            if (selectedOption.value) {
                menuDescription.textContent = selectedOption.dataset.description;
                menuPrice.textContent = 'Rp ' + parseInt(selectedOption.dataset.price).toLocaleString('id-ID');
                menuMinOrder.textContent = selectedOption.dataset.minOrder;
                menuDeliveryTime.textContent = selectedOption.dataset.deliveryTime;
                minOrderDisplay.textContent = selectedOption.dataset.minOrder;
                paxInput.min = selectedOption.dataset.minOrder;
                menuDetails.classList.remove('d-none');
                
                // Calculate total price
                calculateTotalPrice();
            } else {
                menuDetails.classList.add('d-none');
                totalPriceDisplay.textContent = 'Rp 0';
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