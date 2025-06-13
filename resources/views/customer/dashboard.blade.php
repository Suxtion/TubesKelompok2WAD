resources/views/customer/dashboard:
<x-app-layout>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-effect bg-white/5 overflow-hidden rounded-2xl p-8 mb-8">
                <h1 class="font-bold text-4xl bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent mb-4">
                    {{ __("Selamat Datang, ") . Auth::user()->name . "!" }}
                </h1>
                <p class="text-gray-300 text-lg">Ini adalah pusat layanan Anda. Silakan pilih salah satu menu di bawah untuk melanjutkan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="glass-effect bg-white/5 p-8 rounded-2xl card-hover">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Reservasi Ruangan</h3>
                    <p class="text-gray-300 leading-relaxed mb-6">Ajukan pemesanan ruangan untuk kegiatan Anda. Anda memiliki hak akses untuk melakukan reservasi ruangan.</p>
                    <div class="flex space-x-4">
                        <a href="{{ route('reservasi.create') }}" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl hover:from-blue-600 hover:to-purple-700 transition-all transform hover:scale-105">
                            Buat Reservasi
                        </a>
                        <a href="{{ route('reservasi.index') }}" class="px-6 py-3 border border-white/30 text-white rounded-xl hover:bg-white/10 transition-all">
                            Lihat Riwayat
                        </a>
                    </div>
                </div>

                <div class="glass-effect bg-white/5 p-8 rounded-2xl card-hover">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Peminjaman Barang</h3>
                    <p class="text-gray-300 leading-relaxed mb-6">Pinjam barang dan inventaris kampus dengan mudah. Anda memiliki hak akses untuk melakukan peminjaman barang.</p>
                    <div class="flex space-x-4">
                        <a href="{{ route('peminjaman.create') }}" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl hover:from-blue-600 hover:to-purple-700 transition-all transform hover:scale-105">
                            Ajukan Pinjaman
                        </a>
                        <a href="{{ route('peminjaman.index') }}" class="px-6 py-3 border border-white/30 text-white rounded-xl hover:bg-white/10 transition-all">
                            Lihat Riwayat
                        </a>
                    </div>
                </div>

                <div class="glass-effect bg-white/5 p-8 rounded-2xl card-hover">
                    <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Pemesanan Catering</h3>
                    <p class="text-gray-300 leading-relaxed mb-6">Pesan catering untuk acara Anda dari penyedia terverifikasi. Dengan kualitas makanan yang sudah kami uji</p>
                    <div class="flex space-x-4">
                        <a href="{{ route('catering.create') }}" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl hover:from-blue-600 hover:to-purple-700 transition-all transform hover:scale-105">
                            Ajukan Catering
                        </a>
                        <a href="#" class="px-6 py-3 border border-white/30 text-white rounded-xl hover:bg-white/10 transition-all">
                            Lihat Riwayat
                        </a>
                    </div>
                </div>

                <div class="glass-effect bg-white/5 p-8 rounded-2xl card-hover">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-teal-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Event Organizer</h3>
                    <p class="text-gray-300 leading-relaxed mb-6">Jalankan event di dalam kampus dengan para profesional yang berpengalaman. Anda memiliki hak akses untuk melakukan Book Event Organizer.</p>
                    <div class="flex space-x-4">
                        <a href="{{ route('user.event-organizers.index') }}" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl hover:from-blue-600 hover:to-purple-700 transition-all transform hover:scale-105">
                            Ajukan Booking
                        </a>
                        <a href="{{ route('user.event-organizers.index') }}" class="px-6 py-3 border border-white/30 text-white rounded-xl hover:bg-white/10 transition-all">
                            Lihat Riwayat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>