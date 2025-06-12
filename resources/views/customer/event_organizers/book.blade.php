<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking Event Organizer: ' . $eventOrganizer->nama_eo) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col items-center mb-6">
                        @if($eventOrganizer->logo_eo)
                            <img src="{{ asset('storage/' . $eventOrganizer->logo_eo) }}" alt="Logo EO" class="h-24 w-24 rounded-full object-cover mb-4">
                        @else
                            <div class="h-24 w-24 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-sm mb-4">No Logo</div>
                        @endif
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $eventOrganizer->nama_eo }}</h1>
                        <p class="text-gray-700 text-center">{{ $eventOrganizer->deskripsi }}</p>
                    </div>

                    <h3 class="text-xl font-semibold text-gray-800 mb-4 text-center">Isi Detail Permintaan Booking Anda</h3>

                    <form action="{{ route('user.event-organizers.book.store', $eventOrganizer->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="event_name" class="block text-sm font-medium text-gray-700">Nama Event yang Anda Inginkan</label>
                            <input type="text" name="event_name" id="event_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('event_name') }}" required>
                            @error('event_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="event_date" class="block text-sm font-medium text-gray-700">Tanggal Event</label>
                            <input type="date" name="event_date" id="event_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('event_date') }}" min="{{ date('Y-m-d') }}" required>
                            @error('event_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Catatan Tambahan (misal: jenis event, jumlah tamu, dll.)</label>
                            <textarea name="notes" id="notes" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('user.event-organizers.index') }}" class="mr-4 px-4 py-2 text-gray-600 rounded-md hover:text-gray-900">Batal</a>
                            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700">Kirim Permintaan Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>