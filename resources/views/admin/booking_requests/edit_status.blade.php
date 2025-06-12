<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ubah Status Permintaan Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Permintaan Booking</h3>
                    <p class="mb-2"><strong class="font-semibold">ID Permintaan:</strong> {{ $bookingRequest->id }}</p>
                    <p class="mb-2"><strong class="font-semibold">Nama Event:</strong> {{ $bookingRequest->event_name }}</p>
                    <p class="mb-2"><strong class="font-semibold">Tanggal Event:</strong> {{ \Carbon\Carbon::parse($bookingRequest->event_date)->format('d M Y') }}</p>
                    <p class="mb-2"><strong class="font-semibold">EO Dituju:</strong> {{ $bookingRequest->eventOrganizer->nama_eo ?? 'N/A' }}</p>
                    <p class="mb-2"><strong class="font-semibold">User Pemohon:</strong> {{ $bookingRequest->user->name ?? 'N/A' }}</p>
                    <p class="mb-4"><strong class="font-semibold">Catatan:</strong> {{ $bookingRequest->notes ?: '-' }}</p>

                    <form action="{{ route('admin.booking-requests.update-status', $bookingRequest->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="pending" {{ old('status', $bookingRequest->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="accepted" {{ old('status', $bookingRequest->status) == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="rejected" {{ old('status', $bookingRequest->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="completed" {{ old('status', $bookingRequest->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.booking-requests.index') }}" class="mr-4 px-4 py-2 text-gray-600 rounded-md hover:text-gray-900">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Perbarui Status</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>