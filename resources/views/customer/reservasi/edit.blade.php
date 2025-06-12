<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Reservasi: ') . $reservasi->nama_acara }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('reservasi.update', $reservasi->id) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="nama_acara" class="block font-medium text-sm text-gray-700">Nama Acara</label>
                            <input id="nama_acara" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="text" name="nama_acara" value="{{ old('nama_acara', $reservasi->nama_acara) }}" required />
                        </div>

                        <div class="mt-4">
                            <label for="ruangan" class="block font-medium text-sm text-gray-700">Pilih Ruangan</label>
                            <select id="ruangan" name="ruangan" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                                <option @if($reservasi->ruangan == 'Aula Utama') selected @endif>Aula Utama</option>
                                <option @if($reservasi->ruangan == 'Ruang Rapat A') selected @endif>Ruang Rapat A</option>
                                <option @if($reservasi->ruangan == 'Laboratorium Komputer') selected @endif>Laboratorium Komputer</option>
                            </select>
                        </div>
                        
                        <div class="mt-4">
                            <label for="tanggal" class="block font-medium text-sm text-gray-700">Tanggal</label>
                            <input id="tanggal" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="date" name="tanggal" value="{{ old('tanggal', $reservasi->tanggal) }}" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                Perbarui Reservasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>