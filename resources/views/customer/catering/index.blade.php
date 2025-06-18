<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Daftar Pemesanan Catering') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black">
                    @if (session('success'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <a href="{{ route('customer.catering.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                            Pesan Catering Baru
                        </a>
                    </div>

                    @if($pemesanan->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-black">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-black uppercase">No</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-black uppercase">Penyedia Catering</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-black uppercase">Jumlah Pesanan</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-black uppercase">Alamat Pengiriman</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-black uppercase">Status</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-black uppercase">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($pemesanan as $item)
                                        <tr>
                                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                            <td class="px-4 py-2">
                                                {{ $item->penyediaCatering->nama_penyedia ?? '-' }}
                                            </td>
                                            <td class="px-4 py-2">{{ $item->jumlah_pesanan }}</td>
                                            <td class="px-4 py-2">{{ $item->alamat_pengiriman }}</td>
                                            <td class="px-4 py-2">
                                                @if($item->status == 'pending')
                                                    <span class="px-2 py-1 text-xs rounded bg-yellow-200 text-yellow-800">Pending</span>
                                                @elseif($item->status == 'disetujui')
                                                    <span class="px-2 py-1 text-xs rounded bg-green-200 text-green-800">Disetujui</span>
                                                @elseif($item->status == 'ditolak')
                                                    <span class="px-2 py-1 text-xs rounded bg-red-200 text-red-800">Ditolak</span>
                                                @else
                                                    <span class="px-2 py-1 text-xs rounded bg-gray-200 text-gray-800">{{ ucfirst($item->status) }}</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center text-gray-700 py-8">
                            Belum ada pemesanan catering.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
