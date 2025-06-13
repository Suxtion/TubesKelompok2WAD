<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Tambah Penyedia Catering') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.penyedia-catering.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama Penyedia -->
                        <div class="mt-4">
                            <label for="nama_penyedia" class="block text-sm font-medium text-gray-500 uppercase tracking-wider">Nama Penyedia</label>
                            <input type="text" name="nama_penyedia" id="nama_penyedia" class="mt-1 w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mt-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-500 uppercase tracking-wider">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="mt-1 w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
                        </div>

                        <!-- Alamat -->
                        <div class="mt-4">
                            <label for="alamat" class="block text-sm font-medium text-gray-500 uppercase tracking-wider">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="mt-1 w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>

                        <!-- Kontak -->
                        <div class="mt-4">
                            <label for="kontak" class="block text-sm font-medium text-gray-500 uppercase tracking-wider">Kontak</label>
                            <input type="text" name="kontak" id="kontak" class="mt-1 w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>

                        <!-- Logo Foto -->
                        <div class="mt-4">
                            <label for="logo_foto" class="block text-sm font-medium text-gray-500 uppercase tracking-wider">Logo Foto</label>
                            <input type="file" name="logo_foto" id="logo_foto" class="mt-1 w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Status -->
                        <div class="mt-4">
                            <label for="status" class="block text-sm font-medium text-gray-500 uppercase tracking-wider">Status</label>
                            <select name="status" id="status" class="mt-1 w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="mt-6">
                            <button type="submit" class="w-full px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Tambah Penyedia</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
