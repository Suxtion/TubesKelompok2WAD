<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pengajuan Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('peminjaman.update', $peminjaman->id) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="nama_barang">Nama Barang</label>
                            <input id="nama_barang" class="block mt-1 w-full" type="text" name="nama_barang" value="{{ old('nama_barang', $peminjaman->nama_barang) }}" required />
                        </div>

                        <div class="mt-4">
                            <label for="jumlah">Jumlah</label>
                            <input id="jumlah" class="block mt-1 w-full" type="number" name="jumlah" value="{{ old('jumlah', $peminjaman->jumlah) }}" required />
                        </div>

                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="tanggal_pinjam">Tanggal Pinjam</label>
                                <input id="tanggal_pinjam" class="block mt-1 w-full" type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}" required />
                            </div>
                            <div>
                                <label for="tanggal_kembali">Tanggal Kembali</label>
                                <input id="tanggal_kembali" class="block mt-1 w-full" type="date" name="tanggal_kembali" value="{{ old('tanggal_kembali', $peminjaman->tanggal_kembali) }}" required />
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                Perbarui Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>