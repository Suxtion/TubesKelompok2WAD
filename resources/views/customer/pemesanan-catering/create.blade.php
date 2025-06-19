<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Pemesanan Catering') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- DAFTAR PENYEDIA CATERING --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-black">
                    <h3 class="text-lg font-bold mb-4">Daftar Penyedia Catering Tersedia</h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        @forelse ($penyediaCaterings as $penyedia)
                            <div class="border rounded-lg p-4 shadow bg-gray-50 flex flex-col gap-2">
                                <div class="flex items-center gap-3 mb-2">
                                    @if($penyedia->logo_foto)
                                        <img src="{{ asset('storage/' . $penyedia->logo_foto) }}" alt="{{ $penyedia->nama_penyedia }}" class="h-12 w-12 object-cover rounded">
                                    @else
                                        <div class="h-12 w-12 rounded bg-gray-300 flex items-center justify-center text-gray-500">
                                            <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10V6a2 2 0 00-4 0v4M8 16v2a2 2 0 002 2h2a2 2 0 002-2v-2" /></svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-base font-semibold">{{ $penyedia->nama_penyedia }}</div>
                                        <span class="px-2 py-1 text-xs rounded {{ $penyedia->status == 'aktif' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                            {{ ucfirst($penyedia->status) }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <span class="font-medium">Deskripsi:</span>
                                    <span class="text-sm text-gray-700">{{ $penyedia->deskripsi }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Alamat:</span>
                                    <span class="text-sm text-gray-700">{{ $penyedia->alamat }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Kontak:</span>
                                    <span class="text-sm text-gray-700">{{ $penyedia->kontak }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 text-center text-gray-500 py-6">Belum ada penyedia catering yang tersedia.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- FORM PEMESANAN --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('catering.store') }}">
                        @csrf

                        <div class="mt-4">
                            <label for="penyedia_catering_id" class="block text-sm font-medium text-gray-700">Pilih Penyedia Catering</label>
                            <select name="penyedia_catering_id" id="penyedia_catering_id" class="mt-1 w-full p-2 border rounded" required>
                                <option value="">-- Pilih Catering --</option>
                                @foreach ($penyediaCaterings as $penyedia)
                                    <option value="{{ $penyedia->id }}">{{ $penyedia->nama_penyedia }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="jumlah_pesanan" class="block text-sm font-medium text-gray-700">Jumlah Pesanan</label>
                            <input type="number" name="jumlah_pesanan" id="jumlah_pesanan" class="mt-1 w-full p-2 border rounded" required min="1">
                        </div>

                        <div class="mt-4">
                            <label for="alamat_pengiriman" class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
                            <input type="text" name="alamat_pengiriman" id="alamat_pengiriman" class="mt-1 w-full p-2 border rounded" required>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Pesan Catering</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
