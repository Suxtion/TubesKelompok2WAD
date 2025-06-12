resources/views/customer/peminjaman/create:
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Formulir Peminjaman Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('peminjaman.store') }}">
                        @csrf

                        <div>
                            <label for="nama_barang" class="block font-medium text-sm text-gray-700">Nama Barang</label>
                            <input id="nama_barang" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="text" name="nama_barang" required autofocus />
                        </div>

                        <div class="mt-4">
                            <label for="jumlah" class="block font-medium text-sm text-gray-700">Jumlah</label>
                            <input id="jumlah" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="number" name="jumlah" required />
                        </div>

                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="tanggal_pinjam" class="block font-medium text-sm text-gray-700">Tanggal Pinjam</label>
                                <input id="tanggal_pinjam" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="date" name="tanggal_pinjam" required />
                            </div>
                            <div>
                                <label for="tanggal_kembali" class="block font-medium text-sm text-gray-700">Tanggal Kembali</label>
                                <input id="tanggal_kembali" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="date" name="tanggal_kembali" required />
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="kontak_penanggung_jawab" class="block font-medium text-sm text-gray-700">Kontak Penanggung Jawab (No. HP)</label>
                            <input id="kontak_penanggung_jawab" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="text" name="kontak_penanggung_jawab" required />
                        </div>

                        <div class="mt-4">
                            <label for="keperluan" class="block font-medium text-sm text-gray-700">Keperluan</label>
                            <textarea id="keperluan" name="keperluan" rows="4" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"></textarea>
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Ajukan Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>