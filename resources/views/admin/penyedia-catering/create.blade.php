<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Penyedia Catering</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.penyedia-catering.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-4">
                            <label for="nama_penyedia">Nama Penyedia</label>
                            <input id="nama_penyedia" name="nama_penyedia" type="text" class="block mt-1 w-full" required>
                        </div>
                        <div class="mt-4">
                            <label for="logo_foto">Logo/Foto</label>
                            <input id="logo_foto" name="logo_foto" type="file" class="block mt-1 w-full">
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>