<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu - Ulam Sari</title>
    <!-- Tailwind CSS (via CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
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
        <a href="#" class="bg-[#1C3A27] hover:bg-[#142B1D] text-white text-xs md:text-sm px-4 py-2 rounded-full flex items-center gap-2 transition">
            <span>💬 Tanya Ulam AI</span>
        </a>
    </div>
</nav>
   <section class="relative bg-cover bg-center py-36 min-h-[450px] flex items-center justify-center text-white" 
         style="background-image: url('{{ asset('images/menu.png') }}');">
    
    <!-- Overlay Gelap -->
    <div class="absolute inset-0 bg-black/60"></div>

    <!-- Konten Teks -->
    <div class="relative z-10 text-center px-4 max-w-3xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-serif font-bold text-[#E0C097] tracking-wide">Daftar Menu</h1>
        <p class="mt-3 text-sm md:text-base italic font-light text-amber-100/90 leading-relaxed">
            Nikmati keaslian cita rasa warisan Nusantara yang disajikan dengan kehangatan dan tradisi Jawa yang mendalam.
        </p>
    </div>
</section>

    <!-- FILTER / CATEGORY TABS -->
<div class="py-4 border-b border-amber-900/10 mb-8 bg-[#FAF8F5] sticky top-[57px] z-40 shadow-sm">
    <div class="max-w-6xl mx-auto px-4 flex flex-wrap justify-center gap-6 text-xs md:text-sm font-medium text-amber-900">
        
        <a href="#aneka-ikan" class="hover:text-amber-600 transition pb-1">
            Aneka Ikan
        </a>

        <a href="#aneka-ayam" class="hover:text-amber-600 transition pb-1">
            Aneka Ayam
        </a>

        <a href="#sayuran-tumisan" class="hover:text-amber-600 transition pb-1">
            Sayuran & Tumisan
        </a>

        <a href="#menu-lainnya" class="hover:text-amber-600 transition pb-1">
            Menu Lainnya
        </a>

    </div>
</div>

    <!-- MAIN CONTENT CONTAINER -->
    <main class="max-w-6xl mx-auto px-4 pb-16 space-y-16">

     <!-- 1. ANEKA IKAN -->
        <section id="aneka-ikan">
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
                        <p class="text-xs text-gray-500 leading-relaxed">Ikan lele segar digoreng garing
dengan bumbu kuning rempah pilihan.</p>
                    </div>
                </div>

                <!-- Lele Kuah -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="{{ asset('images/lele kuah.png') }}" alt="Lele Kuah" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Lele Kuah Acar</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Ikan lele disajikan dengan kuah acar
kuning segar dan bumbu rempah.</p>
                    </div>
                </div>

                <!-- Patin Kuah Acar -->
                <!-- Patin Kuah Acar -->
<div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
    <img src="{{ asset('images/patin kuah.png') }}" alt="Patin kuah acar" class="w-full h-44 object-cover">
    <div class="p-4">
        <h3 class="font-bold text-base text-amber-950 mb-1">Patin kuah acar</h3>
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
                    <img src="{{ asset('images/pepes nila.png') }}" alt="Pepes Ikan nila" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Pepes Ikan nila</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Ikan nila dibungkus daun pisang dengan bumbu rempah kukus khas.</p>
                    </div>
                </div>
            </div>
        </section>
    
</div>
            </div>
        </section>

        <!-- 2. ANEKA AYAM -->
        <section id="aneka-ayam">
            <div class="flex items-center justify-between border-b border-amber-900/20 pb-2 mb-6">
                <h2 class="text-xl md:text-2xl font-serif-custom font-bold text-amber-900">Aneka Ayam</h2>
                <span class="text-amber-700 text-lg">›</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?auto=format&fit=crop&w=500&q=80" alt="Ayam Goreng Lengkuas" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Ayam Goreng Lengkuas</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Ayam empuk ditaburi parutan lengkuas goreng renyah dan gurih.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?auto=format&fit=crop&w=500&q=80" alt="Ayam Bakar Kecap" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Ayam Bakar Kecap Sweet</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Potongan ayam pilihan diolesi kecap manis beraroma harum rempah.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?auto=format&fit=crop&w=500&q=80" alt="Ayam Kampoeng Goreng" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Ayam Kampoeng Goreng</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Ayam kampung asli diungkep tradisional dengan bumbu kuning kaya rasa.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?auto=format&fit=crop&w=500&q=80" alt="Ayam Kampoeng Bakar" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Ayam Kampoeng Bakar</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Daging ayam kampung pilihan dibakar dengan olesan bumbu asam manis khas.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?auto=format&fit=crop&w=500&q=80" alt="Ayam Goreng Serundeng" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Ayam Goreng Serundeng</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Ayam goreng gurih disajikan dengan taburan serundeng kelapa manis gurih.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. SAYURAN & TUMISAN -->
        <section id="sayuran-tumisan">
            <div class="flex items-center justify-between border-b border-amber-900/20 pb-2 mb-6">
                <h2 class="text-xl md:text-2xl font-serif-custom font-bold text-amber-900">Sayuran & Tumisan</h2>
                <span class="text-amber-700 text-lg">›</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=500&q=80" alt="Kangkung" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Kangkung</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Tumis kangkung segar dengan pilihan saus tiram atau terasi pedas manis.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=500&q=80" alt="Toge" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Toge</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Tumis toge renyah dipadu dengan irisan cabai merah dan daun bawang segar.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=500&q=80" alt="Genjer" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Genjer</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Genjer muda segar ditumis dengan racikan taoco atau terasi harum khas Jawa.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=500&q=80" alt="Terong" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Terong</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Terong ungu balado dengan baluran sambal merah khas yang menggugah selera.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=500&q=80" alt="Oseng Kikil" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Oseng Kikil</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Kikil sapi kenyal ditumis pedas dengan potongan cabai hijau dan rempah pilihan.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=500&q=80" alt="Peda" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Peda</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Ikan asin peda digoreng atau ditumis dengan petai dan irisan cabai rawit.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. MENU COBEKAN -->
        <section id="menu-lainnya">
            <div class="flex items-center justify-between border-b border-amber-900/20 pb-2 mb-6">
                <h2 class="text-xl md:text-2xl font-serif-custom font-bold text-amber-900">Menu Lainnya</h2>
                <span class="text-amber-700 text-lg">›</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=500&q=80" alt="Belut" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Belut</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Belut digoreng garing lalu disajikan hangat di atas cobek sambal ulek segar.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=500&q=80" alt="Tempe Penyet" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Tempe Penyet</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Tempe bumbu kuning digoreng dan dipenyet langsung di atas sambal terasi pedas.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-amber-900/10 hover:shadow-md transition">
                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=500&q=80" alt="Penyetan" class="w-full h-44 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-base text-amber-950 mb-1">Penyetan Mix</h3>
                        <p class="text-xs text-gray-500 leading-relaxed">Kombinasi tahu, tempe, telur, dan lalapan disajikan dengan sambal cobek mantap.</p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="bg-[#0F2218] text-amber-100/80 py-12">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8 text-sm">
            <div>
                <h3 class="text-xl font-serif-custom text-[#E0C097] font-bold mb-3">Ulam Sari</h3>
                <p class="text-xs leading-relaxed opacity-80">
                    Menyajikan hidangan cita rasa tradisional khas Indonesia dengan bahan-bahan berkualitas dan suasana yang nyaman.
                </p>
            </div>
            <div>
                <h4 class="font-bold text-[#E0C097] mb-3 text-xs">Navigasi</h4>
                <ul class="space-y-2 text-xs opacity-80">
                    <li><a href="/" class="hover:underline">Beranda</a></li>
                    <li><a href="/menu" class="hover:underline">Menu</a></li>
                    <li><a href="#" class="hover:underline">Tentang Kami</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-[#E0C097] mb-3 text-xs">Informasi</h4>
                <ul class="space-y-2 text-xs opacity-80">
                    <li><a href="#" class="hover:underline">Galeri</a></li>
                    <li><a href="#" class="hover:underline">Reservasi</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-[#E0C097] mb-3 text-xs">Jam Buka</h4>
                <p class="text-xs opacity-80">Senin - Minggu</p>
                <p class="text-xs font-semibold text-[#E0C097]">10.00 - 22.00 WIB</p>
            </div>
        </div>
    </footer>

</body>
</html>