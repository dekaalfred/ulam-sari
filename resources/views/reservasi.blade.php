<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi - Ulam Sari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#FAF7F2] text-[#2C2C2C] font-sans antialiased">

    <!-- NAVBAR -->
    <nav class="bg-[#2D1A12] text-white py-4 px-8 sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-2xl font-serif font-bold tracking-wide">Ulam Sari</span>
            </div>
            <div class="hidden md:flex space-x-8 text-sm font-medium text-[#D1C7BD]">
                <a href="/" class="hover:text-white transition">Beranda</a>
                <a href="/menu" class="hover:text-white transition">Menu</a>
                <a href="/reservasi" class="text-white font-semibold border-b-2 border-[#C86D3B] pb-1">Reservasi</a>
                <a href="/tentang-kami" class="hover:text-white transition">Tentang Kami</a>
            </div>
            <a href="https://wa.me/6281391218819" target="_blank" class="bg-[#1C3A27] hover:bg-[#142B1D] text-white text-xs md:text-sm px-4 py-2 rounded-full flex items-center gap-2 transition">
                <span>💬 Tanya Ulam AI</span>
            </a>
        </div>
    </nav>

    <!-- HERO BANNER RESERVASI -->
    <section class="relative bg-cover bg-center py-28 min-h-[380px] flex items-center justify-center text-white" 
             style="background-image: url('{{ asset('images/reservasi-bg.png') }}');">
        
        <!-- Overlay Gelap -->
        <div class="absolute inset-0 bg-black/60"></div>

        <!-- Konten Teks -->
        <div class="relative z-10 text-center px-4 max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-[#E0C097] tracking-wide">Reservasi Tempat</h1>
            <p class="mt-3 text-sm md:text-base italic font-light text-amber-100/90 leading-relaxed">
                Amankan lokasi dan momen berharga Anda di Ulam Sari dengan layanan tempat dan sajian terbaik kami.
            </p>
        </div>
    </section>

    <!-- MAIN KONTEN FORM RESERVASI -->
    <main class="max-w-6xl mx-auto px-4 py-12">
        <!-- Alert Success -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-8">
                {{ session('success') }}
            </div>
        @endif

        <!-- Section Detail Fasilitas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center mb-16">
            <img src="{{ asset('images/tradisional foods.jpg') }}" 
                 alt="Fasilitas Meeting Pack Ulam Sari" 
                 class="rounded-2xl h-80 w-full object-cover shadow-sm">
            <div>
                <span class="text-xs font-bold tracking-widest text-[#B58A5B] uppercase">Fasilitas Ulam Sari</span>
                <h2 class="text-3xl font-serif font-bold text-[#2C2C2C] mt-2 mb-4">Meeting Pack</h2>
                <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                    Wujudkan pertemuan reuni atau acara spesial Anda di lantai 2 Ulam Sari.
                </p>
                
                <div class="grid grid-cols-2 gap-y-4 gap-x-6 text-sm text-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-building text-[#B58A5B]"></i> Ruangan Lantai 2
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-volume-high text-[#B58A5B]"></i> Sound System
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-chair text-[#B58A5B]"></i> Meja & Kursi
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-utensils text-[#B58A5B]"></i> Paket Makanan Prasmanan
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="flex items-center justify-center my-12">
            <div class="h-px bg-gray-300 w-1/3"></div>
            <span class="px-4 text-gray-400 font-serif">✤</span>
            <div class="h-px bg-gray-300 w-1/3"></div>
        </div>

        <!-- Section Form Reservasi -->
        <div class="bg-[#F5EFEC] rounded-2xl p-8 md:p-12 shadow-sm border border-gray-100">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Info Kiri -->
                <div class="lg:col-span-4">
                    <h2 class="text-2xl font-serif font-bold mb-3">Detail Reservasi</h2>
                    <p class="text-xs text-gray-600 leading-relaxed mb-6">
                        Lengkapi data di bawah ini untuk memastikan jadwal ketersediaan ruangan. Tim kami akan segera mengkonfirmasi via WhatsApp.
                    </p>

                    <div class="bg-[#EFE9E2] p-4 rounded-xl border border-gray-200/60 text-xs text-gray-700 space-y-3">
                        <p class="font-semibold text-gray-900 flex items-center gap-2">
                            <i class="fa-regular fa-lightbulb text-[#B58A5B]"></i> Mengapa Reservasi Sekarang?
                        </p>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start gap-2"><i class="fa-solid fa-check text-green-700 mt-0.5"></i> Mengamankan tanggal prioritas</li>
                            <li class="flex items-start gap-2"><i class="fa-solid fa-check text-green-700 mt-0.5"></i> Konsultasi menu gratis</li>
                            <li class="flex items-start gap-2"><i class="fa-solid fa-check text-green-700 mt-0.5"></i> Set-up ruangan sesuai kebutuhan</li>
                        </ul>
                    </div>
                </div>

                <!-- Form Kanan -->
                <div class="lg:col-span-8 bg-white p-6 md:p-8 rounded-xl shadow-xs">
                    <form action="{{ route('reservasi.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" placeholder="Masukkan nama Anda" required
                                    class="w-full text-sm border-b border-gray-300 py-2 focus:outline-none focus:border-black bg-transparent">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-2">Nomor WhatsApp</label>
                                <input type="text" name="nomor_whatsapp" placeholder="08xx xxxx xxxx" required
                                    class="w-full text-sm border-b border-gray-300 py-2 focus:outline-none focus:border-black bg-transparent">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-2">Tanggal Acara</label>
                                <input type="date" name="tanggal_acara" required
                                    class="w-full text-sm border-b border-gray-300 py-2 focus:outline-none focus:border-black bg-transparent text-gray-500">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-2">Jumlah Peserta</label>
                                <input type="number" name="jumlah_peserta" placeholder="Min. 10 orang" min="10" required
                                    class="w-full text-sm border-b border-gray-300 py-2 focus:outline-none focus:border-black bg-transparent">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-2">Catatan Tambahan (Opsional)</label>
                            <input type="text" name="catatan" placeholder="Contoh: Ada alergi seafood, butuh proyektor, dll."
                                class="w-full text-sm border-b border-gray-300 py-2 focus:outline-none focus:border-black bg-transparent">
                        </div>

                        <div class="pt-4 flex flex-col sm:flex-row gap-4">
                            <button type="submit" class="flex-1 bg-[#231512] text-white text-xs py-3 px-6 rounded-lg font-medium hover:bg-black transition">
                                <i class="fa-solid fa-paper-plane mr-2"></i> Kirim Reservasi
                            </button>
                            <a href="https://wa.me/6281391218819" target="_blank" class="flex-1 text-center border border-gray-400 text-xs py-3 px-6 rounded-lg font-medium text-gray-800 hover:bg-gray-50 transition">
                                <i class="fa-brands fa-whatsapp mr-2 text-green-600"></i> Tanya via WhatsApp
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-[#0E1A11] text-gray-300 mt-20 py-12 px-8">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 text-xs">
            <div>
                <h3 class="font-serif text-lg font-bold text-white mb-3">Ulam Sari</h3>
                <p class="text-gray-400 leading-relaxed">
                    Essence of Javanese Tradition. Menyajikan kehangatan masakan rumahan dengan kualitas terbaik di Ajibarang.
                </p>
            </div>
            <div>
                <h4 class="font-bold text-white uppercase tracking-wider mb-3">Tautan</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="/" class="hover:text-white">Beranda</a></li>
                    <li><a href="/menu" class="hover:text-white">Menu</a></li>
                    <li><a href="/reservasi" class="text-white border-b border-white pb-0.5">Reservasi</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-white uppercase tracking-wider mb-3">Informasi</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white">Lokasi</a></li>
                    <li><a href="#" class="hover:text-white">Hubungi Kami</a></li>
                    <li><a href="#" class="hover:text-white">Kebijakan Privasi</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-white uppercase tracking-wider mb-3">Jam Buka</h4>
                <p class="text-gray-400">Setiap Hari: 09.00 - 21.00 WIB</p>
            </div>
        </div>
        <div class="max-w-6xl mx-auto border-t border-gray-800 mt-12 pt-6 text-xs text-gray-500">
            © 2026 Warung Jawa Ulam Sari Su RM Ajibarang. Essence of Javanese Tradition.
        </div>
    </footer>

</body>
</html>