@extends('layouts.app')

@section('title', 'Edit Menu Catering')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Menu Catering - {{ $vendor->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.catering-vendors.menus.update', [$vendor->id, $menu->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama Menu</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $menu->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $menu->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="price_per_pax" class="form-label">Harga per Pax</label>
                <input type="number" class="form-control" id="price_per_pax" name="price_per_pax" min="0" value="{{ $menu->price_per_pax }}" required>
            </div>
            <div class="mb-3">
                <label for="minimum_order" class="form-label">Minimal Order</label>
                <input type="number" class="form-control" id="minimum_order" name="minimum_order" min="1" value="{{ $menu->minimum_order }}" required>
            </div>
            <div class="mb-3">
                <label for="delivery_time_estimate" class="form-label">Estimasi Waktu Kirim (menit)</label>
                <input type="number" class="form-control" id="delivery_time_estimate" name="delivery_time_estimate" min="1" value="{{ $menu->delivery_time_estimate }}" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_available" name="is_available" value="1" {{ $menu->is_available ? 'checked' : '' }}>
                <label class="form-check-label" for="is_available">Tersedia</label>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.catering-vendors.menus.index', $vendor->id) }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection