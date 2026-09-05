<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu - Ulam Sari</title>
    <!-- Tailwind CSS (via CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap');
        
        .font-serif-custom {
            font-family: 'Playfair Display', serif;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[#FAF8F5] text-amber-950">

    <!-- NAVBAR -->
    <nav class="bg-[#2D1A12] text-white py-4 px-8 sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-2xl font-serif font-bold tracking-wide">Ulam Sari</span>
            </div>
            <div class="hidden md:flex space-x-8 text-sm font-medium text-[#D1C7BD]">
                <a href="/" class="hover:text-white transition">Beranda</a>
                <a href="/menu" class="text-white font-semibold border-b-2 border-[#C86D3B] pb-1">Menu</a>
                <a href="/reservasi" class="hover:text-white transition">Reservasi</a>
                <a href="/tentang-kami" class="hover:text-white transition">Tentang Kami</a>
            </div>

            <!-- Tombol Tanya Ulam AI (Konsisten menggunakan route Blade) -->
            <a href="{{ route('ai.index') }}" class="bg-[#1C3A27] hover:bg-[#142B1D] text-white text-xs md:text-sm px-4 py-2 rounded-full flex items-center gap-2 transition">
                <span>💬 Tanya Ulam AI</span>
            </a>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="relative bg-cover bg-center py-36 min-h-[450px] flex items-center justify-center text-white" 
             style="background-image: url('{{ asset('images/menu.png') }}');">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative z-10 text-center px-4 max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-[#E0C097] tracking-wide">Daftar Menu</h1>
            <p class="mt-3 text-sm md:text-base italic font-light text-amber-100/90 leading-relaxed">
                Nikmati keaslian cita rasa warisan Nusantara yang disajikan dengan kehangatan dan tradisi Jawa yang mendalam di Ajibarang.
            </p>
        </div>
    </section>

    <!-- FILTER / CATEGORY TABS -->
    <div class="py-4 border-b border-amber-900/10 mb-8 bg-[#FAF8F5] sticky top-[73px] z-40 shadow-sm">
        <div class="max-w-6xl mx-auto px-4 flex flex-wrap justify-center gap-6 text-xs md:text-sm font-medium text-amber-900">
            <a href="#aneka-ikan" class="hover:text-amber-600 transition pb-1">Aneka Ikan</a>
            <a href="#aneka-ayam" class="hover:text-amber-600 transition pb-1">Aneka Ayam</a>
            <a href="#sayuran-tumisan" class="hover:text-amber-600 transition pb-1">Sayuran & Tumisan</a>
            <a href="#menu-lainnya" class="hover:text-amber-600 transition pb-1">Menu Lainnya</a>
        </div>
    </div>

    <!-- MAIN CONTENT CONTAINER -->
    <main class="max-w-6xl mx-auto px-4 pb-16 space-y-16">

        <!-- 1. ANEKA IKAN -->
        <section id="aneka-ikan" class="pt-4">
            <div class="flex items-center justify-between border-b border-amber-900/20 pb-2 mb-6">
                <h2 class="text-xl md:text-2xl font-serif-custom font-bold text-amber-900">Aneka Ikan</h2>
                <span class="text-amber-700 text-lg">›</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($menusByCategory->get('Aneka Ikan', []) as $menu)
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="w-full h-44 object-cover">
                    <div class="p-4">
                    <h3 class="font-bold text-base text-amber-950 mb-1">{{ $menu->name }}</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">{{ $menu->desc }}</p>
                    </div>
                </div>
                @endforeach                
            </div>
        </section>

        <!-- 2. ANEKA AYAM -->
        <section id="aneka-ayam" class="pt-4">
            <div class="flex items-center justify-between border-b border-amber-900/20 pb-2 mb-8">
                <h2 class="text-xl md:text-2xl font-serif-custom font-bold text-amber-900">Aneka Ayam</h2>
                <span class="text-amber-700 text-lg">›</span>
            </div>

            <div class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($menusByCategory->get('Aneka Ayam', []) as $menu)
            <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="w-full h-44 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-base text-amber-950 mb-1">{{ $menu->name }}</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">{{ $menu->desc }}</p>
                </div>
            </div>
        @endforeach
                </div>
</div>
        </section>

        <!-- 3. SAYURAN & TUMISAN -->
        <section id="sayuran-tumisan" class="pt-4">
            <div class="flex items-center justify-between border-b border-amber-900/20 pb-2 mb-6">
                <h2 class="text-xl md:text-2xl font-serif-custom font-bold text-amber-900">Sayuran & Tumisan</h2>
                <span class="text-amber-700 text-lg">›</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($menusByCategory->get('Sayuran & Tumisan', []) as $menu) 
            <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="w-full h-44 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-base text-amber-950 mb-1">{{ $menu->name }}</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">{{ $menu->desc }}</p>
                </div>
            </div>
        @endforeach
            </div>
        </section>
<!-- sinanggar tulo a tulo im so fed up w these horrendous codes #saveme -->
        <!-- 4. MENU LAINNYA -->
        <section id="menu-lainnya" class="pt-4">
            <div class="flex items-center justify-between border-b border-amber-900/20 pb-2 mb-8">
                <h2 class="text-xl md:text-2xl font-serif-custom font-bold text-amber-900">Menu Lainnya</h2>
                <span class="text-amber-700 text-lg">›</span>
            </div>

            <div class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($menusByCategory->get('Menu Lainnya', []) as $menu)
            <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="w-full h-44 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-base text-amber-950 mb-1">{{ $menu->name }}</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">{{ $menu->desc }}</p>
                </div>
            </div>
        @endforeach
            </div>
        </section>
</main>

  <footer class="relative left-1/2 -translate-x-1/2 w-screen m-0 bg-[#0F2218] text-amber-100/80 pt-16 pb-8 px-6">

    <div class="w-full max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-emerald-800/60 text-sm">


        <!-- ABOUT -->

        <div class="space-y-4">

            <h3 class="font-serif font-bold text-2xl text-[#E0C097]">
                Ulam Sari
            </h3>

            <p class="text-emerald-200/80 text-xs leading-relaxed">

                Masakan khas Jawa tradisional.
                Menyajikan kehangatan masakan keluarga
                bernuansa keakraban di Ajibarang, Banyumas.

            </p>

        </div>



        <!-- LINKS -->

        <div class="space-y-3">

            <h4 class="font-bold text-[#E0C097] text-xs uppercase tracking-wider">
                Tautan
            </h4>


            <ul class="space-y-2 text-xs text-emerald-100/90">

                <li>
                    <a href="/" class="hover:underline">
                        Beranda
                    </a>
                </li>

                <li>
                    <a href="/menu" class="hover:underline">
                        Menu
                    </a>
                </li>

                <li>
                    <a href="/reservasi" class="hover:underline">
                        Reservasi
                    </a>
                </li>

                <li>
                    <a href="/tentang-kami" class="hover:underline">
                        Tentang Kami
                    </a>
                </li>

            </ul>

        </div>



        <!-- INFORMASI & LOKASI -->
<div class="space-y-3">
    <h4 class="font-bold text-[#E0C097] text-xs uppercase tracking-wider">
        Informasi & Lokasi
    </h4>

    <p class="text-xs text-emerald-100/90 flex items-start gap-2">
        <a href="https://maps.app.goo.gl/i7ge5vpXZHDj5fn48"
           target="_blank"
           class="hover:underline flex items-start gap-1.5">
            <i class="fa-solid fa-location-dot mt-0.5 text-[#E0C097]"></i>
            <span>Ajibarang, Banyumas, Jawa Tengah</span>
        </a>
    </p>

    <p class="text-xs">
        <a href="/tentang-kami" class="text-emerald-200/80 hover:underline">
            Tentang Kami
        </a>
    </p>
</div>
    </div>



    <div class="w-full max-w-7xl mx-auto pt-6 text-center text-xs text-emerald-300/70">

        &copy; 2026 Resto dan Lesehan Ulam Sari.
        Hak Cipta Dilindungi Undang-Undang.

    </div>

</footer>