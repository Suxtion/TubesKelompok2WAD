@extends('layouts.app')

@section('title', 'Edit Penyedia Catering')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Penyedia Catering</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.catering-vendors.update', $cateringVendor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama Penyedia</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $cateringVendor->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $cateringVendor->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Kontak</label>
                <input type="text" class="form-control" id="contact" name="contact" value="{{ $cateringVendor->contact }}" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea class="form-control" id="address" name="address" rows="2" required>{{ $cateringVendor->address }}</textarea>
            </div>
            <div class="mb-3">
                <label for="logo" class="form-label">Logo</label>
                <input type="file" class="form-control" id="logo" name="logo">
                @if($cateringVendor->logo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $cateringVendor->logo) }}" alt="{{ $cateringVendor->name }}" width="100">
                    </div>
                @endif
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ $cateringVendor->is_active ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Aktif</label>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.catering-vendors.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection