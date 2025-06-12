<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Reservasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Acara</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruangan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($reservasis as $reservasi)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $reservasi->nama_acara }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $reservasi->ruangan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $reservasi->tanggal }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($reservasi->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                        @if($reservasi->status == 'disetujui') bg-green-100 text-green-800 @endif
                                        @if($reservasi->status == 'ditolak') bg-red-100 text-red-800 @endif">
                                        {{ $reservasi->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    @if ($reservasi->status == 'pending')
                                        <form action="{{ route('admin.reservasi.updateStatus', $reservasi->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="disetujui">
                                            <button type="submit" class="text-green-600 hover:text-green-900">Setujui</button>
                                        </form>
                                        <form action="{{ route('admin.reservasi.updateStatus', $reservasi->id) }}" method="POST" class="inline ml-4">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit" class="text-red-600 hover:text-red-900">Tolak</button>
                                        </form>
                                    @else
                                        <span class="text-gray-500">Tindakan Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                    Belum ada data reservasi.
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