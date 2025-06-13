<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Pemesanan Catering') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
