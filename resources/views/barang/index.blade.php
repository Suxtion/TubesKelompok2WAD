@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Manajemen Barang</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('barang.create') }}"> Tambah Barang Baru</a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Jumlah Tersedia</th>
                <th>Status</th>
                <th width="280px">Aksi</th>
            </tr>
            @foreach ($barangs as $item)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>{{ $item->jumlah_tersedia }}</td>
                <td><span class="badge bg-{{ $item->status == 'tersedia' ? 'success' : ($item->status == 'dipinjam' ? 'warning' : 'danger') }}">{{ ucfirst($item->status) }}</span></td>
                <td>
                    <form action="{{ route('barang.destroy',$item->id) }}" method="POST">
                        <a class="btn btn-info btn-sm" href="{{ route('barang.show',$item->id) }}">Detail</a>
                        <a class="btn btn-primary btn-sm" href="{{ route('barang.edit',$item->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {!! $barangs->links() !!}
    </div>
@endsection