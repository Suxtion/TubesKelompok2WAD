@extends('layouts.app')

@section('title', 'Pesanan Catering Saya')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Pesanan Catering Saya</h5>
        <a href="{{ route('catering-orders.create') }}" class="btn btn-primary">Pesan Catering Baru</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal Acara</th>
                        <th>Penyedia</th>
                        <th>Menu</th>
                        <th>Jumlah Pax</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->event_date->format('d M Y H:i') }}</td>
                        <td>{{ $order->vendor->name }}</td>
                        <td>{{ $order->menu->name }}</td>
                        <td>{{ $order->pax }}</td>
                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-warning',
                                    'sent_to_vendor' => 'bg-info',
                                    'processing' => 'bg-primary',
                                    'completed' => 'bg-success',
                                    'cancelled' => 'bg-danger'
                                ];
                            @endphp
                            <span class="badge {{ $statusClasses[$order->status] }}">
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('catering-orders.show', $order->id) }}" class="btn btn-sm btn-info">Detail</a>
                                @if($order->status === 'pending')
                                    <a href="{{ route('catering-orders.edit', $order->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('catering-orders.destroy', $order->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan?')">Batal</button>
                                    </form>
                                @endif
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