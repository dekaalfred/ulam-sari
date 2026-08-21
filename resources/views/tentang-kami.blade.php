<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Ulam Sari</title>
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
                <a href="/reservasi" class="hover:text-white transition">Reservasi</a>
                <a href="/tentang-kami" class="text-white font-semibold border-b-2 border-[#C86D3B] pb-1">Tentang Kami</a>
            </div>
            <a href="https://wa.me/6281391218819" target="_blank" class="bg-[#1C3A27] hover:bg-[#142B1D] text-white text-xs md:text-sm px-4 py-2 rounded-full flex items-center gap-2 transition">
                <span>💬 Tanya Ulam AI</span>
            </a>
        </div>
    </nav>

    <!-- HERO BANNER TENTANG KAMI -->
    <section class="relative bg-cover bg-center py-40 md:py-52 min-h-[550px] flex items-center justify-center text-white" 
             style="background-image: url('{{ asset('images/oke.png') }}');">
        
        <!-- Overlay Gelap -->
        <div class="absolute inset-0 bg-black/60"></div>

        <!-- Konten Teks -->
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-serif font-bold text-[#E0C097] tracking-wide mb-4">Tentang Ulam Sari</h1>
            <p class="text-base md:text-xl italic font-light text-amber-100/90 leading-relaxed max-w-3xl mx-auto">
                Menjaga warisan kuliner Nusantara dengan sentuhan modern, menyajikan cita rasa autentik Jawa dalam harmoni suasana yang menenangkan hati dan menggugah selera.
            </p>
        </div>
    </section>

    <!-- SECTION KISAH PERJALANAN RASA -->
    <section class="max-w-6xl mx-auto px-4 py-16 md:py-24">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Teks Kiri -->
            <div>
                <span class="h-0.5 w-10 bg-[#B58A5B] block mb-4"></span>
                <h2 class="text-3xl font-serif font-bold text-[#2C2C2C] mb-6">Kisah Perjalanan Rasa</h2>
                <p class="text-sm text-gray-600 leading-relaxed mb-4">
                    Berawal dari sebuah dapur keluarga di Ajibarang, Ulam Sari lahir dari kecintaan yang mendalam terhadap kekayaan kuliner rempah Nusantara. Resep-resep leluhur yang diwariskan turun-temurun menjadi fondasi utama kami.
                </p>
                <p class="text-sm text-gray-600 leading-relaxed">
                    Nama "Ulam Sari" memiliki makna khusus. Berasal dari bahasa Jawa, "Ulam" merujuk pada lauk-pauk santapan hidangan dengan cita rasa dan kelezatan terbaik. Setiap racikan bumbu, racikan rempah pilihan, dan bahan segar yang dikelola secara matang diproses untuk Anda nikmati bersama keluarga.
                </p>
            </div>

            <!-- Gambar Kanan -->
            <div class="relative">
                <img src="{{ asset('images/keluarga.png') }}" 
                     alt="Kisah Ulam Sari" 
                     class="rounded-2xl shadow-xl w-full h-[400px] object-cover">
            </div>
        </div>
    </section>

    <!-- SECTION FILOSOFI KAMI -->
    <section class="bg-[#F5EFEC] py-16 px-4 border-y border-stone-200/60">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-serif font-bold text-[#2C2C2C] mb-2">Filosofi Kami</h2>
            <div class="h-0.5 w-10 bg-[#B58A5B] mx-auto mb-12"></div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Kartu 1: Kualitas Rasa -->
                <div class="bg-[#FAF7F2] p-8 rounded-2xl shadow-sm border border-stone-200/50 flex flex-col items-center text-center">
                    <div class="w-12 h-12 bg-[#F3E2D3] text-[#C86D3B] rounded-xl flex items-center justify-center text-xl mb-5">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <h3 class="text-lg font-serif font-bold text-[#2C2C2C] mb-3">Kualitas Rasa</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Berkomitmen menggunakan bahan-bahan segar pilihan dan rempah autentik tanpa kompromi untuk memastikan setiap suapan adalah penyaji rasa kelezatan sejati.
                    </p>
                </div>

                <!-- Kartu 2: Pelayanan Ramah -->
                <div class="bg-[#FAF7F2] p-8 rounded-2xl shadow-sm border border-stone-200/50 flex flex-col items-center text-center">
                    <div class="w-12 h-12 bg-[#F3E2D3] text-[#C86D3B] rounded-xl flex items-center justify-center text-xl mb-5">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>
                    <h3 class="text-lg font-serif font-bold text-[#2C2C2C] mb-3">Pelayanan Ramah</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Menerapkan keramahan dan kesantunan khas Jawa yang tulus. Kami menyambut setiap tamu tidak sekadar sebagai pelanggan, melainkan sebagai keluarga dekat.
                    </p>
                </div>

                <!-- Kartu 3: Warisan Tradisi -->
                <div class="bg-[#FAF7F2] p-8 rounded-2xl shadow-sm border border-stone-200/50 flex flex-col items-center text-center">
                    <div class="w-12 h-12 bg-[#F3E2D3] text-[#C86D3B] rounded-xl flex items-center justify-center text-xl mb-5">
                        <i class="fa-solid fa-hands-holding-child"></i>
                    </div>
                    <h3 class="text-lg font-serif font-bold text-[#2C2C2C] mb-3">Warisan Tradisi</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Melestarikan nilai-nilai adiluhung budaya Jawa melalui harmoni arsitektur ruang, alunan instrumen musik, hingga tata cara penyajian yang sarat makna.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION CTA CALL TO ACTION -->
    <section class="max-w-5xl mx-auto my-16 px-4">
        <div class="bg-[#3D261C] rounded-2xl p-10 md:p-14 text-center text-white shadow-lg relative overflow-hidden">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-[#E0C097] mb-4">Rasakan Langsung Kehangatannya</h2>
            <p class="text-xs md:text-sm text-stone-300 max-w-xl mx-auto mb-8 leading-relaxed">
                Jelajahi ragam sajian kami atau hubungi tim reservasi untuk merencanakan momen spesial Anda bersama Ulam Sari.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="/menu" class="bg-[#C86D3B] hover:bg-[#b05c2e] text-white text-xs md:text-sm font-medium py-3 px-6 rounded-lg transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-book-open"></i> Lihat Menu
                </a>
                <a href="/reservasi" class="bg-transparent border border-stone-400 hover:bg-white/10 text-white text-xs md:text-sm font-medium py-3 px-6 rounded-lg transition flex items-center justify-center gap-2">
                    <i class="fa-regular fa-calendar-check"></i> Reservasi Acara
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-[#0E1A11] text-gray-300 py-12 px-8">
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
                    <li><a href="/reservasi" class="hover:text-white">Reservasi</a></li>
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