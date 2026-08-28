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
                <!-- Gurame Goreng -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/gurame.png') }}" alt="Gurame Goreng" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Gurame Goreng</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Gurame segar pilihan digoreng garing dengan bumbu rempah khas Sunda.</p>
                    </div>
                </div>

                <!-- Gurame Kuah Acar -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/gurame acar.png') }}" alt="Gurame Kuah Acar" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Gurame Kuah Acar</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Gurame segar pilihan dimasak dalam kuah acar yang asam dan pedas.</p>
                    </div>
                </div>

                <!-- Nila Goreng -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/nila grng.png') }}" alt="Nila Goreng" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Nila Goreng</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Ikan nila bumbu kuning digoreng garing di luar, lembut di dalam.</p>
                    </div>
                </div>

                <!-- Nila Acar -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/nila acar.png') }}" alt="Nila Acar" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Nila Acar</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Ikan nila segar disiram bumbu acar kuning gurih dengan rasa asam dan segar.</p>
                    </div>
                </div>

                <!-- Lele Goreng -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/lele.png') }}" alt="Lele Goreng" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Lele Goreng</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Ikan lele segar digoreng garing dengan bumbu kuning rempah pilihan.</p>
                    </div>
                </div>

                <!-- Lele Kuah Acar -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/lele kuah.png') }}" alt="Lele Kuah Acar" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Lele Kuah Acar</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Ikan lele disajikan dengan kuah acar kuning segar dan bumbu rempah.</p>
                    </div>
                </div>

                <!-- Patin Kuah Acar -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/patin kuah.png') }}" alt="Patin Kuah Acar" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Patin Kuah Acar</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Ikan patin segar disajikan dengan kuah acar kuning yang gurih segar.</p>
                    </div>
                </div>

                <!-- Lembutan Goreng -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/lembutan.png') }}" alt="Lembutan Goreng" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Lembutan Goreng</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Ikan lembutan segar digoreng garing dengan bumbu rempah tradisional.</p>
                    </div>
                </div>

                <!-- Pepes Ikan Nila -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/pepes.png') }}" alt="Pepes Ikan Nila" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Pepes Ikan Nila</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Ikan nila dibungkus daun pisang dengan bumbu rempah kukus khas.</p>
                    </div>
                </div>
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
                    <!-- Ayam Negri Goreng Laos -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                <img src="{{ asset('images/ayam laos.png') }}" alt="Lembutan Goreng" class="w-full h-44 object-cover">
                        <div class="p-5">
                            <h3 class="font-serif-custom font-bold text-lg text-amber-950 mb-1">Ayam Negri Goreng Laos</h3>
                            <p class="text-xs text-gray-500 leading-relaxed">Ayam negri digoreng dengan bumbu laos yang gurih dan harum rempah</p>
                        </div>
                    </div>

                    <!-- Ayam Negri Goreng Balado -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                      <img src="{{ asset('images/ayam balado.png') }}" alt="Lembutan Goreng" class="w-full h-44 object-cover">
                        <div class="p-5">
                            <h3 class="font-serif-custom font-bold text-lg text-amber-950 mb-1">Ayam Negri Goreng Balado</h3>
                            <p class="text-xs text-gray-500 leading-relaxed">Ayam negri goreng dengan sambal balado merah pedas yang menggugah</p>
                        </div>
                    </div>

                    <!-- Ayam Kampung Goreng -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                         <img src="{{ asset('images/ayam kampung (2).png') }}" alt="Lembutan Goreng" class="w-full h-44 object-cover">  
                        <div class="p-5">
                            <h3 class="font-serif-custom font-bold text-lg text-amber-950 mb-1">Ayam Kampung Goreng</h3>
                            <p class="text-xs text-gray-500 leading-relaxed">Ayam kampung pilihan digoreng garing dengan bumbu rempah tradisional</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-center gap-6">
    <!-- Ayam Negri/Kampung Bakar -->
    <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition w-full sm:w-[calc(50%-12px)] md:w-[calc(33.333%-16px)]">
        <img src="{{ asset('images/bakar kp.png') }}" alt="Ayam Negri/Kampung Bakar" class="w-full h-48 object-cover">
        <div class="p-5">
            <h3 class="font-serif-custom font-bold text-lg text-amber-950 mb-1">Ayam Negri/Kampung Bakar</h3>
            <p class="text-xs text-gray-500 leading-relaxed">Ayam negri dibakar dengan bumbu kecap manis dan rempah pilihan</p>
        </div>
    </div>

    <!-- Pepes Ayam Kampung -->
    <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition w-full sm:w-[calc(50%-12px)] md:w-[calc(33.333%-16px)]">
    <img src="{{ asset('images/pepes ikan.png') }}"  alt="Pepes Ayam Kampung" class="w-full h-48 object-cover">
        <div class="p-5">
            <h3 class="font-serif-custom font-bold text-lg text-amber-950 mb-1">Pepes Ayam Kampung</h3>
            <p class="text-xs text-gray-500 leading-relaxed">Ayam kampung dibungkus daun pisang dengan bumbu rempah kukus harum</p>
        </div>
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
                <!-- Kangkung -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/kangkung.png') }}" alt="Kangkung" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Kangkung</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Kangkung segar ditumis dengan bumbu bawang putih dan cabai pilihan</p>
                    </div>
                </div>

                <!-- Urab -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/urab.png') }}" alt="Urab" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Urab</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Sayuran segar dicampur dengan kelapa parut berbumbu khas jawa</p>
                    </div>
                </div>

                <!-- Buncis -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/buncis.png') }}" alt="Buncis" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Buncis</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Buncis segar ditumis dengan bumbu bawang merah dan cabai pilihan</p>
                    </div>
                </div>

                <!-- Putren -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/putren.png') }}" alt="Putren" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Putren</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Putren segar ditumis dengan bumbu rempah tradisional yang gurih</p>
                    </div>
                </div>

                <!-- Kulit Melinjo -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/kulit melinjo.png') }}" alt="Kulit Melinjo" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Kulit Melinjo</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Kulit melinjo digoreng garing dengan bumbu bawang putih dan garam</p>
                    </div>
                </div>

                <!-- Tahu -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/tahu.png') }}" alt="Tahu" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Tahu</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Tahu pilihan digoreng garing atau disemur dengan bumbu khas rumahan</p>
                    </div>
                </div>

                <!-- Tempe Nyesel -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/tempe nyemek.png') }}" alt="Tempe Nyemek" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Tempe Nyemek</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Tempe dimasak nyemek dengan bumbu kecap manis dan cabai yang gurih</p>
                    </div>
                </div>

                <!-- Kering Tempe -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/kering tempe.png') }}" alt="Kering Tempe" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Kering Tempe</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Tempe diiris tipis digoreng kering dengan kacang tanah dan cabai</p>
                    </div>
                </div>

                <!-- Terong Balado -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/terong balado.png') }}" alt="Terong Balado" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Terong Balado</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Terong ungu digoreng dan dilumuri sambal balado merah yang pedas</p>
                    </div>
                </div>

                <!-- Terong Cabai Hijau -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/terong hijau.png') }}" alt="Terong Cabai Hijau" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Terong Cabai Hijau</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Terong ungu ditumis dengan cabai hijau segar dan bumbu rempah</p>
                    </div>
                </div>

                <!-- Rawa Kentang -> Kare Kentang -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/rawa kentang.png') }}" alt="Kare Kentang" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Kare Kentang</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Kentang dimasak kuah dengan santan dan rempah kuning yang gurih</p>
                    </div>
                </div>

                <!-- Kentang Cabai Hijau -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/kentang hijau.png') }}" alt="Kentang Cabai Hijau" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Kentang Cabai Hijau</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Kentang ditumis dengan cabai hijau segar dan bumbu rempah pilihan</p>
                    </div>
                </div>

                <!-- Deda -> Pakis -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/pakis.png') }}" alt="Pakis" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Pakis</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Sayur pakis segar ditumis dengan bumbu bawang dan terasi pilihan</p>
                    </div>
                </div>

                <!-- Pare -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/pare.png') }}" alt="Pare" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Pare</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Pare segar ditumis dengan bumbu rempah yang mengurangi rasa pahit</p>
                    </div>
                </div>

                <!-- Buntil Daun Singkong -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/buntil.png') }}" alt="Buntil Daun Singkong" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Buntil Daun Singkong</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Daun singkong muda dibungkus isi kelapa parut berbumbu rempah</p>
                    </div>
                </div>

                <!-- Mie Kopyok -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/mie kanyel.png') }}" alt="Mie Kanyel" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Mie Kanyel</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Mie kanyel dimasak dengan bumbu rempah tradisional yang gurih</p>
                    </div>
                </div>

                <!-- Mie Goreng -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/mie goreng.png') }}" alt="Mie Goreng" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Mie Goreng</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Mie digoreng dengan bumbu kecap dan sayuran segar pilihan</p>
                    </div>
                </div>

                <!-- Bihun Goreng -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/bihun goreng.png') }}" alt="Bihun Goreng" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Bihun Goreng</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Bihun digoreng dengan bumbu kecap dan sayuran segar pilihan</p>
                    </div>
                </div>

                <!-- Jamur Tiram -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/jamur tiram.png') }}" alt="Jamur Tiram" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Jamur Tiram</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Jamur tiram segar ditumis dengan bumbu bawang dan rempah pilihan</p>
                    </div>
                </div>

                <!-- Genjer -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/genjer.png') }}" alt="Genjer" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Genjer</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Genjer segar ditumis dengan bumbu terasi dan bawang putih pilihan</p>
                    </div>
                </div>

                <!-- Sup / Sayur Bening -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/sayur bening.png') }}" alt="Sup / Sayur Bening" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Sup / Sayur Bening</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Sayur ini segar dimasak bening dengan kuah kaldu yang gurih dan segar</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. MENU LAINNYA -->
        <section id="menu-lainnya" class="pt-4">
            <div class="flex items-center justify-between border-b border-amber-900/20 pb-2 mb-8">
                <h2 class="text-xl md:text-2xl font-serif-custom font-bold text-amber-900">Menu Lainnya</h2>
                <span class="text-amber-700 text-lg">›</span>
            </div>

            <div class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <!-- Kikil -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                        <img src="{{ asset('images/kikil.png') }}" alt="Kikil" class="w-full h-44 object-cover">
                        <div class="p-4">
                            <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Kikil</h3>
                            <p class="text-xs text-gray-500 leading-relaxed">Kikil sapi empuk dimasak dengan bumbu kecap manis gurih</p>
                        </div>
                    </div>

                    <!-- Telur Dadar -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                        <img src="{{ asset('images/telor dadar.png') }}" alt="Telur Dadar" class="w-full h-44 object-cover">
                        <div class="p-4">
                            <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Telur Dadar</h3>
                            <p class="text-xs text-gray-500 leading-relaxed">Telur ayam didadar tipis dengan bumbu bawang dan rempah pilihan</p>
                        </div>
                    </div>

                    <!-- Telur Balado -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                        <img src="{{ asset('images/telor balado.png') }}" alt="Telur Balado" class="w-full h-44 object-cover">
                        <div class="p-4">
                            <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Telur Balado</h3>
                            <p class="text-xs text-gray-500 leading-relaxed">Telur ayam rebus digoreng dan dilumuri sambal balado merah pedas</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center">
                    <!-- Perkedel -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition w-full sm:w-[calc(50%-12px)] md:w-[calc(33.333%-16px)]">
                        <img src="{{ asset('images/perkedel.png') }}" alt="Perkedel" class="w-full h-44 object-cover">
                        <div class="p-4">
                            <h3 class="font-serif-custom font-bold text-base text-amber-950 mb-1">Perkedel</h3>
                            <p class="text-xs text-gray-500 leading-relaxed">Perkedel kentang goreng renyah dengan campuran daging dan rempah</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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