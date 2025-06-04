@extends('layouts.app')

@section('title', 'Daftar Menu Catering')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Menu - {{ $vendor->name }}</h5>
        <a href="{{ route('admin.catering-vendors.menus.create', $vendor->id) }}" class="btn btn-primary">Tambah Menu</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Menu</th>
                        <th>Harga per Pax</th>
                        <th>Minimal Order</th>
                        <th>Estimasi Kirim</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $menu)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $menu->name }}</td>
                        <td>Rp {{ number_format($menu->price_per_pax, 0, ',', '.') }}</td>
                        <td>{{ $menu->minimum_order }} pax</td>
                        <td>{{ $menu->delivery_time_estimate }} menit</td>
                        <td>
                            <span class="badge bg-{{ $menu->is_available ? 'success' : 'danger' }}">
                                {{ $menu->is_available ? 'Tersedia' : 'Habis' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.catering-vendors.menus.show', [$vendor->id, $menu->id]) }}" class="btn btn-sm btn-info">Detail</a>
                                <a href="{{ route('admin.catering-vendors.menus.edit', [$vendor->id, $menu->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.catering-vendors.menus.destroy', [$vendor->id, $menu->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.catering-vendors.index') }}" class="btn btn-secondary">Kembali ke Daftar Penyedia</a>
    </div>
</div>
@endsection