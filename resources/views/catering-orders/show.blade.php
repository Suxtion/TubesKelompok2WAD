@extends('layouts.app')

@section('title', 'Detail Pesanan Catering')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Detail Pesanan Catering</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>Informasi Pesanan</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Tanggal Acara:</strong> {{ $cateringOrder->event_date->format('d M Y H:i') }}
                    </li>
                    <li class="list-group-item">
                        <strong>Ruangan:</strong> {{ $cateringOrder->roomBooking->room->name }}
                    </li>
                    <li class="list-group-item">
                        <strong>Waktu:</strong> 
                        {{ $cateringOrder->roomBooking->start_time->format('H:i') }} - 
                        {{ $cateringOrder->roomBooking->end_time->format('H:i') }}
                    </li>
                    <li class="list-group-item">
                        <strong>Kontak Person:</strong> {{ $cateringOrder->contact_person }}
                    </li>
                    <li class="list-group-item">
                        <strong>Catatan Khusus:</strong> 
                        {{ $cateringOrder->special_notes ?? 'Tidak ada catatan' }}
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <h4>Detail Catering</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Penyedia:</strong> {{ $cateringOrder->vendor->name }}
                    </li>
                    <li class="list-group-item">
                        <strong>Menu:</strong> {{ $cateringOrder->menu->name }}
                    </li>
                    <li class="list-group-item">
                        <strong>Deskripsi Menu:</strong> {{ $cateringOrder->menu->description }}
                    </li>
                    <li class="list-group-item">
                        <strong>Jumlah Pax:</strong> {{ $cateringOrder->pax }}
                    </li>
                    <li class="list-group-item">
                        <strong>Total Harga:</strong> Rp {{ number_format($cateringOrder->total_price, 0, ',', '.') }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-footer">
        @if($cateringOrder->status === 'pending')
            <a href="{{ route('catering-orders.edit', $cateringOrder->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('catering-orders.destroy', $cateringOrder->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan?')">Batalkan</button>
            </form>
        @endif
        <a href="{{ route('catering-orders.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection