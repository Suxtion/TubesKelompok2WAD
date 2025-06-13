<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Penyedia Catering') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.penyedia-catering.update', $penyediaCatering->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mt-4">
                            <label for="nama_penyedia" class="block text-sm font-medium text-gray-700">Nama Penyedia</label>
                            <input type="text" name="nama_penyedia" id="nama_penyedia" value="{{ old('nama_penyedia', $penyediaCatering->nama_penyedia) }}" class="mt-1 w-full p-2 border rounded" required>
                        </div>

                        <div class="mt-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="mt-1 w-full p-2 border rounded" required>{{ old('deskripsi', $penyediaCatering->deskripsi) }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $penyediaCatering->alamat) }}" class="mt-1 w-full p-2 border rounded" required>
                        </div>

                        <div class="mt-4">
                            <label for="kontak" class="block text-sm font-medium text-gray-700">Kontak</label>
                            <input type="text" name="kontak" id="kontak" value="{{ old('kontak', $penyediaCatering->kontak) }}" class="mt-1 w-full p-2 border rounded" required>
                        </div>

                        <div class="mt-4">
                            <label for="logo_foto" class="block text-sm font-medium text-gray-700">Logo Foto</label>
                            <input type="file" name="logo_foto" id="logo_foto" class="mt-1 w-full p-2 border rounded">
                            @if ($penyediaCatering->logo_foto)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $penyediaCatering->logo_foto) }}" alt="Logo Foto" class="w-24 h-24 object-cover">
                                </div>
                            @endif
                        </div>

                        <div class="mt-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 w-full p-2 border rounded" required>
                                <option value="aktif" {{ old('status', $penyediaCatering->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status', $penyediaCatering->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">Perbarui Penyedia Catering</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
