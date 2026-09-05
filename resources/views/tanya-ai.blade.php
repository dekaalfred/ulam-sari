<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tanya Ulam AI - Ulam Sari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .chat-scroll::-webkit-scrollbar { width: 6px; }
        .chat-scroll::-webkit-scrollbar-track { background: transparent; }
        .chat-scroll::-webkit-scrollbar-thumb { background: #e2d8cd; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#FAF8F5] text-[#2C2C2C] font-sans antialiased min-h-screen flex flex-col justify-between">

    <!-- NAVBAR -->
    <nav class="bg-[#FAF8F5] py-5 px-8 md:px-16 border-b border-stone-200/50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="/" class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-[#2D1A12] flex items-center justify-center text-white text-xs font-serif font-bold">
                    US
                </div>
                <span class="text-2xl font-serif font-bold tracking-tight text-[#1C1C1C]">Ulam Sari</span>
            </a>

            <div class="hidden md:flex items-center space-x-10 text-sm font-medium text-stone-700">
                <a href="/" class="hover:text-black transition">Beranda</a>
                <a href="/menu" class="hover:text-black transition">Menu</a>
                <a href="/reservasi" class="hover:text-black transition">Reservasi</a>
                <a href="/tentang-kami" class="hover:text-black transition">Tentang Kami</a>
            </div>

            <a href="{{ route('ai.index') }}" class="bg-[#A0522D] hover:bg-[#8B4513] text-white text-xs md:text-sm font-medium px-5 py-2.5 rounded-xl flex items-center gap-2 shadow-sm transition">
                <i class="fa-solid fa-sparkles text-amber-200 text-xs"></i>
                <span>Tanya Ulam AI</span>
            </a>
        </div>
    </nav>

    <!-- AREA CHAT -->
    <main class="flex-1 max-w-4xl w-full mx-auto px-4 py-8 flex flex-col justify-between">
        
        <!-- Riwayat Chat -->
        <div id="chat-container" class="space-y-6 chat-scroll overflow-y-auto max-h-[60vh] pr-2 mb-6">
            
            <!-- Pesan Sambutan Awal AI -->
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full bg-[#EAE3D9] flex-shrink-0 flex items-center justify-center border border-stone-300 text-[#2D1A12]">
                    <i class="fa-solid fa-utensils text-xs"></i>
                </div>
                <div class="bg-[#EFECE6] text-[#2D2D2D] p-4 rounded-2xl rounded-tl-none max-w-xl text-sm leading-relaxed shadow-sm">
                    Sugeng siang. Selamat datang di Ulam Sari. Ada yang bisa saya bantu hari ini? Anda bisa menanyakan rekomendasi menu, ketersediaan meja, atau kisah di balik hidangan tradisional kami.
                </div>
            </div>

        </div>

        <!-- Input Pesan -->
        <div class="w-full">
            <form id="chat-form" onsubmit="handleSendMessage(event)" class="flex gap-3 items-center">
                <input 
                    type="text" 
                    id="user-input"
                    placeholder="Ketik pesan..." 
                    class="flex-1 bg-[#EFECE6] border border-stone-300 rounded-xl px-5 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#A0522D]/50 placeholder-stone-400 text-stone-800"
                    required
                >
                <button 
                    type="submit" 
                    id="btn-send"
                    class="bg-[#A0522D] hover:bg-[#8B4513] text-white px-5 py-3.5 rounded-xl transition flex items-center justify-center"
                >
                    <i class="fa-solid fa-paper-plane text-sm"></i>
                </button>
            </form>
            <p class="text-center text-[11px] text-stone-400 mt-2">
                Powered by Ulam AI. Asisten dapat membuat kesalahan.
            </p>
        </div>

    </main>

    <!-- FOOTER LENGKAP DENGAN INFORMASI LOKASI -->
    <footer class="bg-[#0F2218] text-amber-100/80 pt-16 pb-8 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-emerald-800/60 text-sm">
            <div class="space-y-4">
                <h3 class="font-serif font-bold text-2xl text-[#E0C097]">Ulam Sari</h3>
                <p class="text-emerald-200/80 text-xs leading-relaxed">
                    Masakan khas Jawa tradisional. Menyajikan kehangatan masakan keluarga bernuansa keakraban di Ajibarang, Banyumas.
                </p>
            </div>
            <div class="space-y-3">
                <h4 class="font-bold text-[#E0C097] text-xs uppercase tracking-wider">Tautan</h4>
                <ul class="space-y-2 text-xs text-emerald-100/90">
                    <li><a href="/" class="hover:underline">Beranda</a></li>
                    <li><a href="/menu" class="hover:underline">Menu</a></li>
                    <li><a href="/reservasi" class="hover:underline">Reservasi</a></li>
                    <li><a href="/tentang-kami" class="hover:underline">Tentang Kami</a></li>
                </ul>
            </div>
            <div class="space-y-3">
                <h4 class="font-bold text-[#E0C097] text-xs uppercase tracking-wider">Informasi & Lokasi</h4>
                <ul class="space-y-2 text-xs text-emerald-100/90">
                    <li><a href="https://maps.app.goo.gl/i7ge5vpXZHDj5fn48" target="_blank" class="hover:underline flex items-start gap-1.5"><i class="fa-solid fa-location-dot text-[#C86D3B] mt-0.5"></i> <span>Ajibarang, Banyumas, Jawa Tengah</span></a></li>
                    <li><a href="/tentang-kami" class="hover:underline">Tentang Kami</a></li>
                </ul>
            </div>
            <div class="space-y-3">
                <h4 class="font-bold text-[#E0C097] text-xs uppercase tracking-wider">Jam Buka</h4>
                <p class="text-xs text-emerald-100/90 flex items-center gap-1.5">
                    <i class="fa-regular fa-clock text-[#C86D3B]"></i> Setiap Hari: 09.00 - 21.00 WIB
                </p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto pt-6 text-center text-xs text-emerald-300/70">
            &copy; 2026 Resto dan Lesehan Ulam Sari. Hak Cipta Dilindungi Undang-Undang.
        </div>
    </footer>

    <!-- SCRIPT AJAX LARAVEL -->
    <script>
        async function handleSendMessage(event) {
            event.preventDefault();
            
            const input = document.getElementById('user-input');
            const btnSend = document.getElementById('btn-send');
            const message = input.value.trim();
            if (!message) return;

            const chatContainer = document.getElementById('chat-container');

            // 1. Tampilkan pesan user ke layar
            const userMsgHTML = `
                <div class="flex items-start justify-end gap-3">
                    <div class="bg-[#4A2E2B] text-white p-4 rounded-2xl rounded-tr-none max-w-xl text-sm leading-relaxed shadow-sm">
                        ${escapeHtml(message)}
                    </div>
                    <div class="w-8 h-8 rounded-full bg-[#A0522D] flex-shrink-0 flex items-center justify-center text-white text-xs">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
            `;
            chatContainer.insertAdjacentHTML('beforeend', userMsgHTML);

            input.value = '';
            input.disabled = true;
            btnSend.disabled = true;
            chatContainer.scrollTop = chatContainer.scrollHeight;

            // 2. Tampilkan indikator mengetik
            const loadingId = 'loading-' + Date.now();
            const loadingHTML = `
                <div id="${loadingId}" class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-[#EAE3D9] flex-shrink-0 flex items-center justify-center border border-stone-300 text-[#2D1A12]">
                        <i class="fa-solid fa-utensils text-xs"></i>
                    </div>
                    <div class="bg-[#EFECE6] text-[#2D2D2D] p-4 rounded-2xl rounded-tl-none text-sm leading-relaxed shadow-sm italic text-stone-500 flex items-center gap-2">
                        <i class="fa-solid fa-circle-notch fa-spin"></i> Ulam AI sedang mengetik...
                    </div>
                </div>
            `;
            chatContainer.insertAdjacentHTML('beforeend', loadingHTML);
            chatContainer.scrollTop = chatContainer.scrollHeight;

            try {
                // 3. Kirim data ke Controller Laravel
                const response = await fetch("{{ route('ai.chat') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ message: message })
                });

                const data = await response.json();
                document.getElementById(loadingId).remove();

                // 4. Tampilkan jawaban dari Controller AI
                const aiReply = data.reply.replace(/\n/g, '<br>');
                const aiMsgHTML = `
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-[#EAE3D9] flex-shrink-0 flex items-center justify-center border border-stone-300 text-[#2D1A12]">
                            <i class="fa-solid fa-utensils text-xs"></i>
                        </div>
                        <div class="bg-[#EFECE6] text-[#2D2D2D] p-4 rounded-2xl rounded-tl-none max-w-xl text-sm leading-relaxed shadow-sm">
                            ${aiReply}
                        </div>
                    </div>
                `;
                chatContainer.insertAdjacentHTML('beforeend', aiMsgHTML);

            } catch (error) {
                if (document.getElementById(loadingId)) {
                    document.getElementById(loadingId).remove();
                }
                alert('Gagal terhubung dengan server.');
            } finally {
                input.disabled = false;
                btnSend.disabled = false;
                input.focus();
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        }

        function escapeHtml(text) {
            return text
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }
    </script>
</body>
</html>