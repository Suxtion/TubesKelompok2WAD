resources/views/customer/reservasi/index:
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Riwayat Reservasi Anda') }}
            </h2>
            <a href="{{ route('reservasi.create') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl hover:from-blue-600 hover:to-purple-700 transition-all">
                + Buat Reservasi Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Acara</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($reservasis as $reservasi)
                                <tr>
                                    <td class="px-6 py-4 text-gray-800 whitespace-nowrap">{{ $reservasi->nama_acara }}</td>
                                    <td class="px-6 py-4 text-gray-800 whitespace-nowrap">{{ $reservasi->tanggal }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($reservasi->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                            @if($reservasi->status == 'disetujui') bg-green-100 text-green-800 @endif
                                            @if($reservasi->status == 'ditolak') bg-red-100 text-red-800 @endif
                                            @if($reservasi->status == 'selesai') bg-blue-100 text-blue-800 @endif
                                            @if($reservasi->status == 'dibatalkan') bg-gray-100 text-gray-800 @endif">
                                            {{ $reservasi->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        {{-- Logika @if ditambahkan di sini --}}
                                        @if($reservasi->status == 'pending')
                                            <a href="{{ route('reservasi.edit', $reservasi->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            
                                            <form action="{{ route('reservasi.destroy', $reservasi->id) }}" method="POST" class="inline ml-4">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Anda yakin ingin membatalkan reservasi ini?')">
                                                    Batal
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-500">Tindakan tidak tersedia</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                        Anda belum memiliki reservasi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>