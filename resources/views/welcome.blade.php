<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulam Sari - Beranda</title>
    <!-- CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts untuk kesan elegan -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#FAF8F5] text-[#2C221E]">

    <!-- NAVBAR -->
    <nav class="bg-[#2D1A12] text-white py-4 px-8 sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-2xl font-serif font-bold tracking-wide">Ulam Sari</span>
            </div>
            <div class="hidden md:flex space-x-8 text-sm font-medium text-[#D1C7BD]">
                <a href="/" class="text-white font-semibold border-b-2 border-[#C86D3B] pb-1">Beranda</a>
                <a href="/menu" class="hover:text-white transition">Menu</a>
                <a href="/reservasi" class="hover:text-white transition">Reservasi</a>
                <a href="/tentang-kami" class="hover:text-white transition">Tentang Kami</a>
            </div>
            <!-- DIPERBAIKI: Mengarah ke route ai.index -->
            <a href="{{ route('ai.index') }}" class="bg-[#1C3A27] hover:bg-[#142B1D] text-white text-xs md:text-sm px-4 py-2 rounded-full flex items-center gap-2 transition">
                <span>💬 Tanya Ulam AI</span>
            </a>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="relative bg-[#2D1A12] text-white py-24 px-6 bg-cover bg-center" style="background-image: linear-gradient(rgba(45, 26, 18, 0.82), rgba(45, 26, 18, 0.82)), url('{{ asset('images/WhatsApp Image 2026-08-11 at 14.54.59 1 (1).png') }}');">
        <div class="max-w-4xl mx-auto text-center space-y-6">
            
            <!-- Badge Atas -->
            <div>
                <span class="inline-block border border-white/30 px-4 py-1.5 rounded-full text-xs uppercase tracking-widest text-[#D1C7BD]">
                    WARUNG JAWA • AJIBARANG • BANYUMAS
                </span>
            </div>

            <!-- Judul & Subjudul -->
            <h1 class="text-4xl md:text-6xl font-serif font-bold text-[#F4EBE1]">Rasa Jawa, Cerita yang Terjaga.</h1>
            <p class="text-stone-300 max-w-xl mx-auto text-sm md:text-base leading-relaxed">
                Nikmati masakan Jawa dengan cita rasa rumahan di Ulam Sari Ajibarang.
            </p>

            <!-- Tombol -->
            <div class="flex justify-center gap-4 pt-4">
                <a href="/menu" class="bg-[#A34E2A] hover:bg-[#8b4122] text-white px-6 py-3 rounded-md font-medium text-sm transition">Lihat Menu</a>
                <!-- DIPERBAIKI: Mengarah ke route ai.index -->
                <a href="{{ route('ai.index') }}" class="border border-white/60 hover:bg-white/10 text-white px-6 py-3 rounded-md font-medium text-sm flex items-center gap-2 transition">
                    <span>🤖 Tanya Ulam AI</span>
                </a>
            </div>

            <!-- Fitur Bawah -->
            <div class="flex justify-center gap-6 pt-8 text-xs text-[#D1C7BD] tracking-wider uppercase font-semibold">
                <span>NASI BOX</span>
                <span>•</span>
                <span>TUMPENG</span>
                <span>•</span>
                <span>RESERVASI & ACARA</span>
            </div>

        </div>
    </section>

    <!-- SECTION 2: Lebih dari Sekadar Makan -->
    <section class="max-w-7xl mx-auto py-20 px-6">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[#2D1A12]">Lebih dari Sekadar Makan</h2>
                <div class="w-12 h-1 bg-[#C86D3B]"></div>
                <p class="text-stone-600 text-sm md:text-base leading-relaxed">
                    Di Ulam Sari, setiap hidangan dibuat dengan resep warisan turun-temurun. Kami merawat tradisi kuliner Jawa dengan menggunakan rempah pilihan dan resep otentik yang menghasilkan kehangatan di setiap suapannya.
                </p>
                <p class="text-stone-600 text-sm md:text-base leading-relaxed">
                    Tidak hanya menyajikan hidangan lezat, kami juga hadir untuk menyempurnakan momen berharga Anda lewat layanan Nasi Boks, Tumpeng, dan ruang acara yang nyaman dan berkesan.
                </p>
                <a href="/tentang-kami" class="inline-block text-[#C86D3B] font-semibold text-sm hover:underline">
                    Kenali Kami Lebih Lanjut &rarr;
                </a>
            </div>
        
            <div>
                <img src="{{ asset('images/mejikom.png') }}" alt="Suasana Ulam Sari" class="rounded-lg shadow-xl w-full h-[380px] object-cover">
            </div>
        </div>
    </section>

    <!-- BANNER SPECIAL: Tumpeng Khas -->
    <section class="max-w-7xl mx-auto px-6 mb-20">
        <div class="relative rounded-2xl overflow-hidden bg-[#1C3A27] text-white p-8 md:p-14 bg-cover bg-center" style="background-image: linear-gradient(to right, rgba(28, 58, 39, 0.95), rgba(28, 58, 39, 0.6)), url('{{ asset('images/tumpang.png') }}');">
            <div class="max-w-xl space-y-4">
                <span class="text-xs uppercase tracking-widest text-emerald-300 font-semibold">SAJIAN SPESIAL ACARA</span>
                <h2 class="text-3xl md:text-4xl font-serif font-bold">Tumpeng Khas Ulam Sari</h2>
                <p class="text-emerald-100 text-sm leading-relaxed">
                    Hadirkan simbol syukuran, kebersamaan, dan keberkahan untuk momen berharga Anda. Tersedia pilihan Nasi Kuning dan Nasi Gurih dengan lauk-pauk otentik yang khas.
                </p>
                <a href="/reservasi" class="inline-block bg-[#C86D3B] hover:bg-[#b05c2e] text-white px-6 py-3 rounded-md font-medium text-sm transition mt-2">
                    Pesan Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- SECTION 4: Nasi Box Ulam Sari -->
    <section class="max-w-7xl mx-auto py-10 px-6 mb-20">
        <div class="text-center space-y-2 mb-12">
            <h2 class="text-3xl font-serif font-bold text-[#2D1A12]">Nasi Box Ulam Sari</h2>
            <p class="text-stone-500 text-sm">Pilihan praktis untuk berbagai acara Anda. Praktis, lezat, dan dikemas dengan rapi.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card Menu 1 -->
            <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition border border-stone-100">
                <img src="{{ asset('images/tumpeng.png') }}" class="w-full h-44 object-cover" alt="Menu 1 Nasi Box">
                <div class="p-4 space-y-2">
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold text-base">Menu 1</h3>
                        <span class="text-[10px] bg-stone-100 px-2 py-1 rounded text-stone-600 font-medium">Ayam Goreng</span>
                    </div>
                    <p class="text-xs text-stone-500">Nasi Putih, Ayam Goreng, Sambal Lalap, Tahu Tempe</p>
                    <p class="text-[#C86D3B] font-bold text-sm pt-2">Rp22.000</p>
                </div>
            </div>

            <!-- Card Menu 2 -->
            <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition border border-stone-100">
                <img src="{{ asset('images/tumpeng.png') }}" class="w-full h-44 object-cover" alt="Menu 2 Nasi Box">
                <div class="p-4 space-y-2">
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold text-base">Menu 2</h3>
                        <span class="text-[10px] bg-stone-100 px-2 py-1 rounded text-stone-600 font-medium">Ayam Kampung</span>
                    </div>
                    <p class="text-xs text-stone-500">Nasi Putih, Ayam Bakar Kampung, Oreg Tempe, Sambal Bajak</p>
                    <p class="text-[#C86D3B] font-bold text-sm pt-2">Rp28.000</p>
                </div>
            </div>

            <!-- Card Menu 3 -->
            <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition border border-stone-100">
                <img src="{{ asset('images/tumpeng.png') }}" class="w-full h-44 object-cover" alt="Menu 3 Nasi Box">
                <div class="p-4 space-y-2">
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold text-base">Menu 3</h3>
                        <span class="text-[10px] bg-stone-100 px-2 py-1 rounded text-stone-600 font-medium">Nila Bakar</span>
                    </div>
                    <p class="text-xs text-stone-500">Nasi Putih, Nila Bakar Madu, Tumis Buncis</p>
                    <p class="text-[#C86D3B] font-bold text-sm pt-2">Rp25.000</p>
                </div>
            </div>

            <!-- Card Menu 4 -->
            <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition border border-stone-100">
                <img src="{{ asset('images/tumpeng.png') }}" class="w-full h-44 object-cover" alt="Menu 4 Nasi Box">
                <div class="p-4 space-y-2">
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold text-base">Menu 4</h3>
                        <span class="text-[10px] bg-stone-100 px-2 py-1 rounded text-stone-600 font-medium">Empal Daging</span>
                    </div>
                    <p class="text-xs text-stone-500">Nasi Putih, Empal Daging, Tumis Terong, Sambal</p>
                    <p class="text-[#C86D3B] font-bold text-sm pt-2">Rp30.000</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-[#1C3A27] text-white pt-16 pb-8 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-emerald-800 text-sm">
            <div class="space-y-4">
                <h3 class="font-serif font-bold text-2xl">Ulam Sari</h3>
                <p class="text-emerald-200 text-xs leading-relaxed">
                    Masakan khas Jawa tradisional. Menyajikan kehangatan masakan keluarga bernuansa keakraban di Ajibarang.
                </p>
            </div>
            <div class="space-y-3">
                <h4 class="font-bold text-emerald-400 text-xs uppercase tracking-wider">Tautan</h4>
                <ul class="space-y-2 text-xs text-emerald-100">
                    <li><a href="/" class="hover:underline">Beranda</a></li>
                    <li><a href="/menu" class="hover:underline">Menu</a></li>
                    <li><a href="/reservasi" class="hover:underline">Reservasi</a></li>
                </ul>
            </div>
            <div class="space-y-3">
                <h4 class="font-bold text-emerald-400 text-xs uppercase tracking-wider">Informasi</h4>
                <ul class="space-y-2 text-xs text-emerald-100">
                    <li><a href="/tentang-kami" class="hover:underline">Lokasi</a></li>
                    <li><a href="/tentang-kami" class="hover:underline">Tentang Kami</a></li>
                    <li><a href="#" class="hover:underline">Kebijakan Privasi</a></li>
                </ul>
            </div>
            <div class="space-y-3">
                <h4 class="font-bold text-emerald-400 text-xs uppercase tracking-wider">Jam Buka</h4>
                <p class="text-xs text-emerald-100">
                    Setiap Hari: 09.00 - 21.00 WIB
                </p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto pt-6 text-center text-xs text-emerald-300">
            &copy; 2026 Resto dan Lesehan Ulam Sari. Hak Cipta Dilindungi Undang-Undang.
        </div>
    </footer>

</body>
</html>