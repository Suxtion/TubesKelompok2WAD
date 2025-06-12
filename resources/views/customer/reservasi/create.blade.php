<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulir Reservasi Ruangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('reservasi.store') }}">
                        @csrf

                        <div>
                            <label for="nama_acara" class="block font-medium text-sm text-gray-700">Nama Acara</label>
                            <input id="nama_acara" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="nama_acara" required autofocus />
                        </div>

                        <div class="mt-4">
                            <label for="ruangan" class="block font-medium text-sm text-gray-700">Pilih Ruangan</label>
                            <select id="ruangan" name="ruangan" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option>Aula Utama</option>
                                <option>Ruang Rapat A</option>
                                <option>Laboratorium Komputer</option>
                            </select>
                        </div>
                        
                        <div class="mt-4">
                            <label for="tanggal" class="block font-medium text-sm text-gray-700">Tanggal</label>
                            <input id="tanggal" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="date" name="tanggal" required />
                        </div>

                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="waktu_mulai" class="block font-medium text-sm text-gray-700">Waktu Mulai</label>
                                <input id="waktu_mulai" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="time" name="waktu_mulai" required />
                            </div>
                            <div>
                                <label for="waktu_selesai" class="block font-medium text-sm text-gray-700">Waktu Selesai</label>
                                <input id="waktu_selesai" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="time" name="waktu_selesai" required />
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="jumlah_peserta" class="block font-medium text-sm text-gray-700">Jumlah Peserta</label>
                            <input id="jumlah_peserta" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="number" name="jumlah_peserta" required />
                        </div>

                        <div class="mt-4">
                            <label for="kontak_penanggung_jawab" class="block font-medium text-sm text-gray-700">Kontak Penanggung Jawab (No. HP)</label>
                            <input id="kontak_penanggung_jawab" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="text" name="kontak_penanggung_jawab" required />
                        </div>

                        <div class="mt-4">
                            <label for="deskripsi_kegiatan" class="block font-medium text-sm text-gray-700">Deskripsi Kegiatan</label>
                            <textarea id="deskripsi_kegiatan" name="deskripsi_kegiatan" rows="4" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Ajukan Reservasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>