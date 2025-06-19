<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Daftar Penyedia Catering') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <a href="{{ route('admin.penyedia-catering.create') }}" class="inline-block px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">Tambah Penyedia Catering</a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200 mb-8">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Penyedia</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($penyediaCaterings as $penyedia)
                                <tr>
                                    <td class="px-6 py-4 text-gray-800 whitespace-nowrap">{{ $penyedia->nama_penyedia }}</td>
                                    <td class="px-6 py-4 text-gray-800 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($penyedia->status == 'aktif') bg-green-100 text-green-800 @endif
                                            @if($penyedia->status == 'nonaktif') bg-red-100 text-red-800 @endif">
                                            {{ $penyedia->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.penyedia-catering.edit', $penyedia->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                        <form action="{{ route('admin.penyedia-catering.destroy', $penyedia->id) }}" method="POST" class="inline-block ml-4">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- TABEL PESANAN CATERING --}}
                    <h3 class="text-lg font-bold mb-4 text-black">Daftar Pesanan Catering Masuk</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Customer</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Penyedia Catering</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-black">
                            @foreach($daftarPesanan as $pesanan)
                                <tr>
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $pesanan->user->name ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $pesanan->penyediaCatering->nama_penyedia ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $pesanan->jumlah_pesanan }}</td>
                                    <td class="px-4 py-2">{{ $pesanan->keterangan }}</td>
                                    <td class="px-4 py-2">{{ $pesanan->alamat_pengiriman }}</td>
                                    <td class="px-4 py-2">
                                        @if($pesanan->status == 'pending')
                                            <span class="px-2 py-1 text-xs rounded bg-yellow-200 text-yellow-800">Pending</span>
                                        @elseif($pesanan->status == 'disetujui')
                                            <span class="px-2 py-1 text-xs rounded bg-green-200 text-green-800">Disetujui</span>
                                        @elseif($pesanan->status == 'ditolak')
                                            <span class="px-2 py-1 text-xs rounded bg-red-200 text-red-800">Ditolak</span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded bg-gray-200 text-gray-800">{{ ucfirst($pesanan->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        @if($pesanan->status == 'pending')
                                        <form action="{{ route('admin.penyedia-catering.approve-order', ['catering' => $pesanan->penyedia_catering_id, 'pemesanan' => $pesanan->id]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs"
                                                onclick="return confirm('Setujui pesanan ini?')">Setujui</button>
                                        </form>
                                        <form action="{{ route('admin.penyedia-catering.reject-order', ['catering' => $pesanan->penyedia_catering_id, 'pemesanan' => $pesanan->id]) }}" method="POST" class="inline ml-2">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs"
                                                onclick="return confirm('Tolak pesanan ini?')">Tolak</button>
                                        </form>
                                        @elseif($pesanan->status == 'disetujui')
                                            <span class="text-green-600 text-xs font-bold">Sudah Disetujui</span>
                                        @elseif($pesanan->status == 'ditolak')
                                            <span class="text-red-600 text-xs font-bold">Ditolak</span>
                                        @else
                                            <span class="text-gray-600 text-xs font-bold">{{ ucfirst($pesanan->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
