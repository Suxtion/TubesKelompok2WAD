<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Gedung TEL-U - Sistem Pemesanan Ruangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#0EA5E9',
                        secondary: '#F59E0B',
                        accent: '#8B5CF6',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .hero-pattern {
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(255,255,255,0.1) 0%, transparent 50%);
        }
        
        .glass-effect {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .animate-fade-in {
            animation: fadeIn 1s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 text-white overflow-x-hidden">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 glass-effect bg-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">RESERVA TEL-U</h1>
                        <p class="text-xs text-gray-300">Sistem Pemesanan Ruangan</p>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-white hover:text-blue-300 transition-colors">Beranda</a>
                    <a href="#layanan" class="text-white hover:text-blue-300 transition-colors">Layanan</a>
                    <a href="#tentang" class="text-white hover:text-blue-300 transition-colors">Tentang</a>
                    <a href="#kontak" class="text-white hover:text-blue-300 transition-colors">Kontak</a>
                    <a href="/reservasi" class="text-white hover:text-blue-300 transition-colors">Reservasi</a>
                    <a href="/peminjaman" class="text-white hover:text-blue-300 transition-colors">Peminjaman</a>
                    <a href="/event-organizers" class="text-white hover:text-blue-300 transition-colors">Booking EO</a>




                </div>
                
                @if (Route::has('login'))
                    <div class="flex items-center space-x-3">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                               class="px-4 py-2 text-white border border-white/30 rounded-lg hover:bg-white/10 transition-all">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="px-4 py-2 text-white border border-white/30 rounded-lg hover:bg-white/10 transition-all">
                                Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:from-blue-600 hover:to-purple-700 transition-all">
                                    Daftar
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="min-h-screen flex items-center justify-center relative overflow-hidden pt-16">
        <div class="hero-pattern absolute inset-0"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="animate-fade-in">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                    RESERVA TEL-U
                </h1>
                <p class="text-xl md:text-2xl text-gray-300 mb-8 max-w-3xl mx-auto">
                    Sistem pemesanan ruangan modern untuk kebutuhan akademik dan non-akademik di Telkom University
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/reservasi" class="px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl hover:from-blue-600 hover:to-purple-700 transition-all transform hover:scale-105 shadow-lg">
                        Mulai Reservasi
                    </a>
                    <a href="/reservasi" class="px-8 py-4 border border-white/30 text-white rounded-xl hover:bg-white/10 transition-all">
                        Lihat Jadwal
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-blue-500/20 rounded-full animate-float"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 bg-purple-500/20 rounded-full animate-float" style="animation-delay: -2s;"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-pink-500/20 rounded-full animate-float" style="animation-delay: -4s;"></div>
    </section>

    <!-- Features Section -->
    <section id="layanan" class="py-20 bg-black/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                    Layanan Kami
                </h2>
                <p class="text-gray-300 text-lg max-w-2xl mx-auto">
                    Nikmati kemudahan dalam memesan ruangan dengan fitur-fitur canggih yang kami sediakan
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass-effect bg-white/5 p-8 rounded-2xl card-hover">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">Pemesanan Real-time</h3>
                    <p class="text-gray-300 leading-relaxed">Pesan ruangan secara langsung dengan sistem yang terintegrasi dan update status secara real-time</p>
                </div>
                
                <div class="glass-effect bg-white/5 p-8 rounded-2xl card-hover">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">Konfirmasi Otomatis</h3>
                    <p class="text-gray-300 leading-relaxed">Dapatkan konfirmasi pemesanan secara otomatis melalui email dan notifikasi aplikasi</p>
                </div>
                
                <div class="glass-effect bg-white/5 p-8 rounded-2xl card-hover">
                    <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">Manajemen Mudah</h3>
                    <p class="text-gray-300 leading-relaxed">Kelola reservasi Anda dengan dashboard yang intuitif dan fitur pencarian yang canggih</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl font-bold mb-6 bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                        Tentang Sistem Reservasi
                    </h2>
                    <p class="text-gray-300 text-lg mb-6 leading-relaxed">
                        Sistem Reserva TEL-U adalah platform digital yang dirancang khusus untuk memudahkan civitas akademika Telkom University dalam memesan dan mengelola penggunaan ruangan.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <p class="text-gray-300">Interface yang user-friendly dan mudah digunakan</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <p class="text-gray-300">Sistem keamanan dan autentikasi yang terpercaya</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <p class="text-gray-300">Dukungan 24/7 untuk semua pengguna</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="glass-effect bg-white/5 p-8 rounded-2xl">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-blue-400 mb-2">500+</div>
                                <p class="text-gray-300">Ruangan Tersedia</p>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-purple-400 mb-2">10K+</div>
                                <p class="text-gray-300">Reservasi Berhasil</p>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-pink-400 mb-2">24/7</div>
                                <p class="text-gray-300">Layanan Aktif</p>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-yellow-400 mb-2">99%</div>
                                <p class="text-gray-300">Kepuasan User</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="py-20 bg-black/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                    Hubungi Kami
                </h2>
                <p class="text-gray-300 text-lg max-w-2xl mx-auto">
                    Butuh bantuan atau ada pertanyaan? Tim support kami siap membantu Anda
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass-effect bg-white/5 p-8 rounded-2xl text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Email</h3>
                    <p class="text-gray-300">reservasi@telkomuniversity.ac.id</p>
                </div>
                
                <div class="glass-effect bg-white/5 p-8 rounded-2xl text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Telepon</h3>
                    <p class="text-gray-300">+62 22 7564108</p>
                </div>
                
                <div class="glass-effect bg-white/5 p-8 rounded-2xl text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Alamat</h3>
                    <p class="text-gray-300">Jl. Telekomunikasi No. 1, Bandung</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black/40 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">Reserva TEL-U</h3>
                            <p class="text-sm text-gray-400">Sistem Pemesanan Ruangan</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm">Solusi digital untuk kebutuhan reservasi ruangan di lingkungan Telkom University.</p>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">Reservasi Ruangan</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Cek Ketersediaan</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Riwayat Booking</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Laporan</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4">Dukungan</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">Bantuan</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Panduan</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; 2025 Telkom University. All rights reserved.</p>
            </div>
        </div>
    </footer>