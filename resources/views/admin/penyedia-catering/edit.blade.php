<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Penyedia Catering: ') . $penyediaCatering->nama_penyedia }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.penyedia-catering.update', $penyediaCatering->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="nama_penyedia" class="block font-medium text-sm text-gray-700">Nama Penyedia</label>
                            <input id="nama_penyedia" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="text" name="nama_penyedia" value="{{ old('nama_penyedia', $penyediaCatering->nama_penyedia) }}" required autofocus />
                        </div>

                        <div class="mt-4">
                            <label for="deskripsi" class="block font-medium text-sm text-gray-700">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" rows="4" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">{{ old('deskripsi', $penyediaCatering->deskripsi) }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="alamat" class="block font-medium text-sm text-gray-700">Alamat</label>
                            <input id="alamat" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="text" name="alamat" value="{{ old('alamat', $penyediaCatering->alamat) }}" required />
                        </div>