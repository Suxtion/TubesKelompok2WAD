resources/views/user/eo/index:
<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight">
        {{ __('Pilih Event Organizer Terbaik untuk Event Anda') }}
    </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.697l-2.651 3.152a1.2 1.2 0 1 1-1.697-1.697l3.152-2.651-3.152-2.651a1.2 1.2 0 0 1 1.697-1.697L10 8.303l2.651-3.152a1.2 1.2 0 1 1 1.697 1.697L11.697 10l3.152 2.651a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.697l-2.651 3.152a1.2 1.2 0 1 1-1.697-1.697l3.152-2.651-3.152-2.651a1.2 1.2 0 0 1 1.697-1.697L10 8.303l2.651-3.152a1.2 1.2 0 1 1 1.697 1.697L11.697 10l3.152 2.651a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($eventOrganizers as $eo)
                            <div class="border rounded-lg p-4 shadow-md flex flex-col items-center text-center">
                                @if($eo->logo_eo)
                                    <img src="{{ asset('storage/' . $eo->logo_eo) }}" alt="Logo EO" class="h-24 w-24 rounded-full object-cover mb-4">
                                @else
                                    <div class="h-24 w-24 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs mb-4">No Logo</div>
                                @endif
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $eo->nama_eo }}</h3>
                                <p class="text-sm text-gray-600 mb-4 line-clamp-3">{{ $eo->deskripsi }}</p>
                                <a href="{{ route('user.event-organizers.book.form', $eo->id) }}" class="mt-auto px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Booking EO Ini</a>
                            </div>
                        @empty
                            <div class="col-span-full text-center text-gray-500 py-8">
                                Maaf, belum ada Event Organizer yang tersedia saat ini.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>