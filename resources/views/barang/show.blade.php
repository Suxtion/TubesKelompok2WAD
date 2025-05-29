@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2> Detail Barang</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('barang.index') }}"> Kembali</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Barang:</strong>
                    {{ $barang->nama_barang }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Deskripsi:</strong>
                    {{ $barang->deskripsi }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jumlah Tersedia:</strong>
                    {{ $barang->jumlah_tersedia }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <span class="badge bg-{{ $barang->status == 'tersedia' ? 'success' : ($barang->status == 'dipinjam' ? 'warning' : 'danger') }}">{{ ucfirst($barang->status) }}</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Dibuat Pada:</strong>
                    {{ $barang->created_at->format('d M Y H:i:s') }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Diperbarui Pada:</strong>
                    {{ $barang->updated_at->format('d M Y H:i:s') }}
                </div>
            </div>
        </div>
    </div>
@endsection