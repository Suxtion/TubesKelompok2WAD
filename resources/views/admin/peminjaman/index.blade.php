<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Manajemen Peminjaman Barang') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($peminjamans as $peminjaman)
                                <tr>
                                    <td class="px-6 py-4 text-gray-800 whitespace-nowrap">{{ $peminjaman->nama_barang }}</td>
                                    <td class="px-6 py-4 text-gray-800 whitespace-nowrap">{{ $peminjaman->tanggal_pinjam }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($peminjaman->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                            @if($peminjaman->status == 'disetujui') bg-green-100 text-green-800 @endif
                                            @if($peminjaman->status == 'dipinjam') bg-orange-100 text-orange-800 @endif
                                            @if($peminjaman->status == 'dikembalikan') bg-blue-100 text-blue-800 @endif
                                            @if($peminjaman->status == 'ditolak') bg-red-100 text-red-800 @endif
                                            @if($peminjaman->status == 'dibatalkan') bg-gray-100 text-gray-800 @endif">
                                            {{ $peminjaman->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-righ    t text-sm font-medium">
                                    @if($peminjaman->status == 'pending')
                                        <form action="{{ route('admin.peminjaman.updateStatus', $peminjaman->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="disetujui">
                                            <button type="submit" class="text-green-600 hover:text-green-900">Setujui</button>
                                        </form>
                                        <form action="{{ route('admin.peminjaman.updateStatus', $peminjaman->id) }}" method="POST" class="inline ml-4">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit" class="text-red-600 hover:text-red-900">Tolak</button>
                                        </form>
                                        @elseif($peminjaman->status == 'disetujui')
                                            <form action="{{ route('admin.peminjaman.updateStatus', $peminjaman->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="dipinjam">
                                                <button type="submit" class="text-blue-600 hover:text-blue-900">Tandai Dipinjam</button>
                                            </form>
                                        @elseif($peminjaman->status == 'dipinjam')
                                            <form action="{{ route('admin.peminjaman.updateStatus', $peminjaman->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="dikembalikan">
                                                <button type="submit" class="text-purple-600 hover:text-purple-900">Tandai Kembali</button>
                                            </form>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                        Anda belum memiliki pengajuan peminjaman.
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
