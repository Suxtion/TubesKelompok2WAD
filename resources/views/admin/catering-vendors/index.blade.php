@extends('layouts.app')

@section('title', 'Daftar Penyedia Catering')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Penyedia Catering</h5>
        <a href="{{ route('admin.catering-vendors.create') }}" class="btn btn-primary">Tambah Penyedia</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Logo</th>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vendors as $vendor)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($vendor->logo)
                                <img src="{{ asset('storage/' . $vendor->logo) }}" alt="{{ $vendor->name }}" width="50">
                            @else
                                <span class="text-muted">Tidak ada logo</span>
                            @endif
                        </td>
                        <td>{{ $vendor->name }}</td>
                        <td>{{ $vendor->contact }}</td>
                        <td>
                            <span class="badge bg-{{ $vendor->is_active ? 'success' : 'danger' }}">
                                {{ $vendor->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.catering-vendors.show', $vendor->id) }}" class="btn btn-sm btn-info">Detail</a>
                                <a href="{{ route('admin.catering-vendors.edit', $vendor->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.catering-vendors.destroy', $vendor->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                                </form>
                                <a href="{{ route('admin.catering-vendors.menus.index', $vendor->id) }}" class="btn btn-sm btn-secondary">Menu</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection