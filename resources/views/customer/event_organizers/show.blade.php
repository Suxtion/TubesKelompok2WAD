<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Event Organizer: ' . $eventOrganizer->nama_eo) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col items-center mb-6">
                        @if($eventOrganizer->logo_eo)
                            <img src="{{ asset('storage/' . $eventOrganizer->logo_eo) }}" alt="Logo EO" class="h-32 w-32 rounded-full object-cover mb-4">
                        @else
                            <div class="h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-sm mb-4">No Logo</div>
                        @endif
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $eventOrganizer->nama_eo }}</h1>
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                            @if($eventOrganizer->status == 'aktif') bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst(str_replace('_', ' ', $eventOrganizer->status)) }}
                        </span>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Deskripsi</h2>
                        <p class="text-gray-700">{{ $eventOrganizer->deskripsi ?: 'Tidak ada deskripsi tersedia.' }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Kontak</h2>
                            <p class="text-gray-700"><strong>Email:</strong> {{ $eventOrganizer->kontak_email }}</p>
                            <p class="text-gray-700"><strong>Telepon:</strong> {{ $eventOrganizer->kontak_telepon ?: '-' }}</p>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Alamat</h2>
                            <p class="text-gray-700">{{ $eventOrganizer->alamat ?: '-' }}</p>
                        </div>
                    </div>

                    <div class="flex justify-center mt-6">
                        <a href="#" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 text-lg">Hubungi / Pilih EO Ini</a>
                        </div>

                    <div class="mt-8 text-center">
                        <a href="{{ route('user.event-organizers.index') }}" class="text-indigo-600 hover:text-indigo-900">Kembali ke Daftar Event Organizer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>