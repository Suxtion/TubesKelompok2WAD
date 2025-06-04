@extends('layouts.app')

@section('title', 'Detail Menu Catering')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Detail Menu - {{ $menu->name }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>{{ $menu->name }}</h4>
                <p>{{ $menu->description }}</p>
            </div>
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Harga per Pax:</strong> Rp {{ number_format($menu->price_per_pax, 0, ',', '.') }}
                    </li>
                    <li class="list-group-item">
                        <strong>Minimal Order:</strong> {{ $menu->minimum_order }} pax
                    </li>
                    <li class="list-group-item">
                        <strong>Estimasi Waktu Kirim:</strong> {{ $menu->delivery_time_estimate }} menit
                    </li>
                    <li class="list-group-item">
                        <strong>Status:</strong>
                        <span class="badge bg-{{ $menu->is_available ? 'success' : 'danger' }}">
                            {{ $menu->is_available ? 'Tersedia' : 'Habis' }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.catering-vendors.menus.edit', [$vendor->id, $menu->id]) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('admin.catering-vendors.menus.index', $vendor->id) }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection