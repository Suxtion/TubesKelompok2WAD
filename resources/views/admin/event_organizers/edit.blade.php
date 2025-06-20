<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Edit Event Organizer') }}
            </h2>
            <a href="{{ route('admin.event-organizers.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Pastikan variabel $eventOrganizer dikirim dari controller --}}
                    <form action="{{ route('admin.event-organizers.update', $eventOrganizer->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Penting untuk operasi update --}}

                        <div class="mb-4">
                            <label for="nama_eo" class="block text-sm font-medium text-gray-700">Nama Event Organizer</label>
                            <input type="text" name="nama_eo" id="nama_eo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('nama_eo', $eventOrganizer->nama_eo) }}" required>
                            @error('nama_eo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('deskripsi', $eventOrganizer->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="kontak_email" class="block text-sm font-medium text-gray-700">Email Kontak</label>
                            <input type="email" name="kontak_email" id="kontak_email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('kontak_email', $eventOrganizer->kontak_email) }}" required>
                            @error('kontak_email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="kontak_telepon" class="block text-sm font-medium text-gray-700">Telepon Kontak (Opsional)</label>
                            <input type="text" name="kontak_telepon" id="kontak_telepon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('kontak_telepon', $eventOrganizer->kontak_telepon) }}">
                            @error('kontak_telepon')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat (Opsional)</label>
                            <input type="text" name="alamat" id="alamat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('alamat', $eventOrganizer->alamat) }}">
                            @error('alamat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="logo_eo" class="block text-sm font-medium text-gray-700">Logo Event Organizer (Opsional)</label>
                            
                            @if ($eventOrganizer->logo_eo)
                                <div class="mt-2 mb-2">
                                    <img src="{{ Storage::url($eventOrganizer->logo_eo) }}" alt="Logo saat ini" class="h-20 w-auto rounded-md">
                                    <p class="text-xs text-gray-500 mt-1">Logo saat ini. Unggah file baru untuk menggantinya.</p>
                                </div>
                            @endif

                            <input type="file" name="logo_eo" id="logo_eo" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @error('logo_eo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="aktif" {{ old('status', $eventOrganizer->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak_aktif" {{ old('status', $eventOrganizer->status) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>