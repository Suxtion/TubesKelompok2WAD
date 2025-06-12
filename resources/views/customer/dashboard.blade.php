<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white leading-tight">
            {{ __('Beranda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="font-semibold text-4xl text-gray-800" >{{ __("Selamat Datang, ") . Auth::user()->name . "!" }}</h1>
                    <p class="text-gray-600 mt-2">Ini adalah pusat layanan Anda. Silakan pilih salah satu menu di bawah untuk melanjutkan.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-semibold text-lg text-gray-800">Reservasi Ruangan</h3>
                    <p class="text-gray-600 mt-2 text-sm">Ajukan pemesanan ruangan untuk kegiatan Anda. Anda memiliki hak akses untuk melakukan reservasi ruangan.</p>
                    <div class="mt-4">
                        <a href="{{ route('reservasi.create') }}" class="text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md">Buat Reservasi</a>
                        <a href="{{ route('reservasi.index') }}" class="text-sm font-semibold text-gray-700 hover:text-gray-900 ml-4">Lihat Riwayat</a>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-semibold text-lg text-gray-800">Peminjaman Barang</h3>
                    <p class="text-gray-600 mt-2 text-sm">Pinjam barang dan inventaris kampus dengan mudah. Anda memiliki hak akses untuk melakukan peminjaman barang.</p>
                    <div class="mt-4">
                        <a href="{{ route('peminjaman.create') }}" class="text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md">Ajukan Pinjaman</a>
                        <a href="{{ route('peminjaman.index') }}" class="text-sm font-semibold text-gray-700 hover:text-gray-900 ml-4">Lihat Riwayat</a>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-semibold text-lg text-gray-800">Pemesanan Catering</h3>
                    <p class="text-gray-600 mt-2 text-sm">Pesan catering untuk acara Anda dari penyedia terverifikasi.</p>
                    <div class="mt-4">
                        <a href="#" class="text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md">Pesan Sekarang</a>
                    </div>
                </div>                

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-semibold text-lg text-gray-800">Event Organizer</h3>
                    <p class="text-gray-600 mt-2 text-sm">Jalankan event di dalam kampus dengan para profesional yang berpengalaman. Anda memiliki hak akses untuk melakukan Book Event Organizer.</p>
                    <div class="mt-4">
                        <a href="" class="text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md">Ajukan Booking (Beta)</a>
                        <a href="" class="text-sm font-semibold text-gray-700 hover:text-gray-900 ml-4">Lihat Riwayat (Beta)</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>