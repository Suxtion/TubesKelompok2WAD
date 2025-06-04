@extends('layouts.app')

@section('title', 'Detail Penyedia Catering')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Detail Penyedia Catering</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                @if($cateringVendor->logo)
                    <img src="{{ asset('storage/' . $cateringVendor->logo) }}" alt="{{ $cateringVendor->name }}" class="img-fluid mb-3">
                @endif
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Status:</strong>
                        <span class="badge bg-{{ $cateringVendor->is_active ? 'success' : 'danger' }}">
                            {{ $cateringVendor->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </li>
                    <li class="list-group-item">
                        <strong>Kontak:</strong> {{ $cateringVendor->contact }}
                    </li>
                    <li class="list-group-item">
                        <strong>Alamat:</strong> {{ $cateringVendor->address }}
                    </li>
                </ul>
            </div>
            <div class="col-md-8">
                <h4>{{ $cateringVendor->name }}</h4>
                <p>{{ $cateringVendor->description }}</p>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.catering-vendors.edit', $cateringVendor->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('admin.catering-vendors.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection