<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Riwayat Peminjaman Anda') }}
            </h2>
            <a href="{{ route('peminjaman.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">
                + Buat Peminjaman Baru
            </a>
        </div>
    </x-slot>

    <script src="//unpkg.com/alpinejs" defer></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($peminjamans as $peminjaman)
                                <tr>
                                    <td class="px-6 py-4 text-gray-800 whitespace-nowrap">{{ $peminjaman->nama_barang }}</td>
                                    <td class="px-6 py-4 text-gray-800 whitespace-nowrap">{{ $peminjaman->tanggal_pinjam }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($peminjaman->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                            @if($peminjaman->status == 'disetujui') bg-green-100 text-green-800 @endif
                                            @if($peminjaman->status == 'dibatalkan') bg-gray-100 text-gray-800 @endif
                                            @if($peminjaman->status == 'dikembalikan') bg-blue-100 text-blue-800 @endif
                                            @if($peminjaman->status == 'ditolak') bg-red-100 text-red-800 @endif
                                            @if($peminjaman->status == 'dibatalkan') bg-gray-100 text-gray-800 @endif">
                                            {{ $peminjaman->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if($peminjaman->status == 'pending')
                                            <a href="{{ route('peminjaman.edit', $peminjaman->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <form action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST" class="inline ml-4">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Anda yakin?')">Batal</button>
                                            </form>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                        Anda belum memiliki pengajuan peminjaman.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div x-data="weatherWidget()" x-init="getWeather()" class="mt-8">
                <div x-show="isLoading" class="bg-white/50 backdrop-blur-sm p-6 text-center rounded-lg shadow-sm">
                    <p class="text-gray-500">Memuat prakiraan cuaca...</p>
                </div>

                <div x-show="error" class="bg-red-50 border border-red-200 p-6 text-center rounded-lg shadow-sm">
                    <p class="text-red-700" x-text="error"></p>
                </div>

                <div x-show="weather.main" class="bg-white bg-gradient-to-br from-blue-50 to-indigo-100 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800" x-text="weather.name"></h3>
                            <p class="text-sm text-gray-600 capitalize" x-text="weather.weather[0].description"></p>
                        </div>
                        <div class="text-right flex items-center">
                            <img x-show="weather.weather[0].icon" 
                                 :src="`https://openweathermap.org/img/wn/${weather.weather[0].icon}@2x.png`" 
                                 alt="weather icon" 
                                 class="w-16 h-16 -my-2">
                            <p class="text-5xl font-light text-gray-800">
                                <span x-text="Math.round(weather.main.temp)"></span>&deg;C
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <script>
        function weatherWidget() {
            return {
                weather: {},
                isLoading: true,
                error: '',
                getWeather() {
                    this.isLoading = true;
                    this.error = '';
                    fetch('{{ route("api.weatherForecast") }}')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Gagal mengambil data cuaca dari server.');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if(data.cod != 200) { // Cek kode status dari OpenWeatherMap
                                throw new Error(data.message || 'Respons API tidak valid.');
                            }
                            this.weather = data;
                        })
                        .catch(error => {
                            console.error('Error fetching weather:', error);
                            this.error = 'Tidak dapat memuat prakiraan cuaca saat ini.';
                        })
                        .finally(() => {
                            this.isLoading = false;
                        });
                }
            }
        }
    </script>
</x-app-layout>