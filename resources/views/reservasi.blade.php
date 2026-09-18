<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Reservasi & Pembayaran QRIS - Ulam Sari</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ============================================================
           MOTION & TRANSITION PRIMITIVES
           Dipakai konsisten untuk modal, toast, dan slot jam supaya
           terasa satu bahasa gerak, bukan efek yang dipasang acak.
           ============================================================ */

        .overlay-enter {
            opacity: 0;
            transition: opacity .25s ease;
        }
        .overlay-enter.is-open {
            opacity: 1;
        }

        .sheet-enter {
            opacity: 0;
            transform: translateY(12px) scale(.97);
            transition: opacity .25s ease, transform .25s cubic-bezier(.16,1,.3,1);
        }
        .overlay-enter.is-open .sheet-enter {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        @keyframes toast-in {
            from { opacity: 0; transform: translateY(-8px) scale(.96); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes toast-out {
            from { opacity: 1; transform: translateY(0) scale(1); }
            to   { opacity: 0; transform: translateY(-8px) scale(.96); }
        }
        .toast-in  { animation: toast-in .25s cubic-bezier(.16,1,.3,1) forwards; }
        .toast-out { animation: toast-out .2s ease forwards; }

        .spinner {
            border: 2px solid rgba(255,255,255,.35);
            border-top-color: #fff;
            border-radius: 999px;
            width: 14px;
            height: 14px;
            animation: spin .7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        .slot-btn {
            transition: border-color .15s ease, background-color .15s ease, color .15s ease, transform .1s ease;
        }
        .slot-btn:active:not(:disabled) { transform: scale(.96); }

        .booking-slot {
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #991b1b;
        }

        .booking-slot .booking-status {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .04em;
        }

        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
        }

        .schedule-card {
            border: 1px solid #e5e7eb;
            background: #fff;
            border-radius: 12px;
            padding: 10px 11px;
            text-align: left;
            transition: all .15s ease;
        }

        .schedule-card.available {
            cursor: pointer;
        }

        .schedule-card.available:hover {
            border-color: #1C3A27;
            background: #f6faf7;
            transform: translateY(-1px);
        }

        .schedule-card.selected {
            border-color: #1C3A27;
            background: #1C3A27;
            color: #fff;
            box-shadow: 0 5px 14px rgba(28,58,39,.16);
        }

        .schedule-card.in-range {
            border-color: #2f6b49;
            background: #eaf3ed;
            color: #173b27;
        }

        .schedule-card.range-start,
        .schedule-card.range-end {
            border-color: #1C3A27;
            background: #1C3A27;
            color: #fff;
            box-shadow: 0 5px 14px rgba(28,58,39,.16);
        }

        .schedule-card.range-start .schedule-meta,
        .schedule-card.range-end .schedule-meta {
            color: rgba(255,255,255,.78);
        }

        .range-helper {
            border: 1px solid #e0c097;
            background: #fffaf3;
            color: #795548;
        }

        .schedule-card.booked {
            border-color: #fecaca;
            background: #fef2f2;
            color: #991b1b;
            cursor: not-allowed;
            opacity: .9;
        }

        .schedule-card.pending {
            border-color: #fde68a;
            background: #fffbeb;
            color: #92400e;
            cursor: not-allowed;
        }

        .schedule-time {
            font-size: 12px;
            font-weight: 800;
        }

        .schedule-meta {
            margin-top: 3px;
            font-size: 9px;
            color: #6b7280;
        }

        .schedule-card.selected .schedule-meta {
            color: rgba(255,255,255,.75);
        }

        .schedule-card.booked .schedule-meta {
            color: #b91c1c;
        }

        .schedule-card.pending .schedule-meta {
            color: #b45309;
        }

        .schedule-card.insufficient {
    border: 1px solid #f59e0b;
    background: #fff7ed;
    color: #9a3412;
    cursor: not-allowed;
    opacity: 0.9;
}

.schedule-card.insufficient .schedule-time {
    color: #c2410c;
}

.schedule-card.insufficient .schedule-meta {
    color: #ea580c;
    font-weight: 700;
}

.schedule-card.full {
    border: 1px solid #ef4444;
    background: #fef2f2;
    color: #991b1b;
    cursor: not-allowed;
    opacity: 0.9;
}

.schedule-card.full .schedule-time {
    color: #991b1b;
}

.schedule-card.full .schedule-meta {
    color: #dc2626;
    font-weight: 700;
}

.schedule-card.available {
    border: 1px solid #86efac;
    background: #f0fdf4;
    color: #166534;
    cursor: pointer;
}

.schedule-card.available:hover {
    border-color: #22c55e;
    background: #dcfce7;
}

.schedule-card.selected {
    border: 2px solid #1C3A27 !important;
    background: #dcfce7 !important;
}

        @media (max-width: 640px) {
            .schedule-grid { grid-template-columns: 1fr; }
        }

        input:focus-visible,
        button:focus-visible,
        a:focus-visible {
            outline: 2px solid #C86D3B;
            outline-offset: 2px;
        }

        @media (prefers-reduced-motion: reduce) {
            .overlay-enter, .sheet-enter, .slot-btn, .spinner { animation: none !important; transition: none !important; }
        }
        .schedule-card.full {
    border: 1px solid #fca5a5;
    background: #fef2f2;
    color: #991b1b;
    cursor: not-allowed;
    opacity: 0.85;
}

.schedule-card.full .schedule-time {
    color: #991b1b;
}

.schedule-card.full .schedule-meta {
    color: #dc2626;
}
.schedule-card.insufficient {
    border: 1px solid #fdba74;
    background: #fff7ed;
    color: #9a3412;
    cursor: not-allowed;
    opacity: .9;
}

.schedule-card.insufficient .schedule-time {
    color: #c2410c;
}

.schedule-card.insufficient .schedule-meta {
    color: #ea580c;
}

.schedule-card.full {
    border: 1px solid #fca5a5;
    background: #fef2f2;
    color: #991b1b;
    cursor: not-allowed;
    opacity: .9;
}
    </style>
</head>

<body class="bg-[#FAF7F2] text-[#2C2C2C] font-sans antialiased">


<!-- ========================================================= -->
<!-- TOAST CONTAINER -->
<!-- ========================================================= -->

<div id="toastContainer" class="fixed top-5 right-5 z-[100] flex flex-col gap-3 w-[calc(100%-2.5rem)] max-w-sm"></div>


<!-- ========================================================= -->
<!-- NAVBAR -->
<!-- ========================================================= -->

<nav class="bg-[#2D1A12] text-white py-4 px-8 sticky top-0 z-50 shadow-md">
    <div class="max-w-7xl mx-auto flex justify-between items-center">

        <span class="text-2xl font-serif font-bold tracking-wide">Ulam Sari</span>

        <div class="hidden md:flex space-x-8 text-sm font-medium text-[#D1C7BD]">
            <a href="/" class="hover:text-white transition">Beranda</a>
            <a href="/menu" class="hover:text-white transition">Menu</a>
            <a href="/reservasi" class="text-white font-semibold border-b-2 border-[#C86D3B] pb-1">Reservasi</a>
            <a href="/tentang-kami" class="hover:text-white transition">Tentang Kami</a>
        </div>

        <a href="{{ route('ai.index') }}"
           class="bg-[#1C3A27] hover:bg-[#142B1D] text-white text-xs md:text-sm px-4 py-2 rounded-full flex items-center gap-2 transition">
            <span>💬 Tanya Ulam AI</span>
        </a>

    </div>
</nav>


<!-- ========================================================= -->
<!-- HERO -->
<!-- ========================================================= -->

<section
    class="relative bg-cover bg-center py-28 min-h-[380px] flex items-center justify-center text-white"
    style="background-image: url('{{ asset('images/reservasi-bg.png') }}');">

    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative z-10 text-center px-4 max-w-2xl mx-auto">
        <p class="text-[11px] font-semibold tracking-[0.2em] text-[#E0C097]/80 mb-3">Warung Jawa Ulam Sari</p>
        <h1 class="text-4xl md:text-5xl font-serif font-bold text-[#E0C097] tracking-wide leading-tight">
            Reservasi Tempat
        </h1>
        <p class="mt-4 text-sm md:text-base font-light text-amber-100/90 leading-relaxed">
            Amankan meja dan jam kedatangan Anda lebih dulu — cukup pilih jadwal yang masih kosong,
            sisanya kami yang siapkan.
        </p>
    </div>

</section>


<!-- ========================================================= -->
<!-- MAIN -->
<!-- ========================================================= -->

<main class="max-w-6xl mx-auto px-4 py-12">

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl mb-8 text-sm flex items-start gap-3">
            <i class="fa-solid fa-circle-check text-green-600 mt-0.5"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl mb-8 text-sm flex items-start gap-3">
        <i class="fa-solid fa-circle-exclamation text-red-600 mt-0.5"></i>
        <span>{{ session('error') }}</span>
    </div>
@endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl mb-8 text-sm">
            <p class="font-semibold mb-1">Data yang Anda kirim belum bisa diproses:</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- ===================================================== -->
    <!-- FASILITAS -->
    <!-- ===================================================== -->

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-16">

        <img
            src="{{ asset('images/tradisional foods.jpg') }}"
            alt="Ruang Meeting Pack lantai 2 Ulam Sari"
            class="rounded-2xl h-80 w-full object-cover shadow-sm">

        <div>
            <p class="text-xs font-semibold tracking-widest text-[#B58A5B] mb-2">Fasilitas Ulam Sari</p>

            <h2 class="text-3xl font-serif font-bold text-[#2C2C2C] mb-4">Meeting Pack</h2>

            <p class="text-sm text-gray-600 mb-6 leading-relaxed max-w-md">
                Wujudkan pertemuan reuni atau acara spesial Anda di lantai 2 Ulam Sari
                dengan kenyamanan maksimal.
            </p>

            <div class="grid grid-cols-2 gap-y-4 gap-x-6 text-sm text-gray-700">
                <div class="flex items-center gap-3">
                    <i class="fa-regular fa-building text-[#B58A5B] w-4"></i> Ruangan Lantai 2
                </div>
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-volume-high text-[#B58A5B] w-4"></i> Sound System
                </div>
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-chair text-[#B58A5B] w-4"></i> Meja &amp; Kursi
                </div>
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-utensils text-[#B58A5B] w-4"></i> Paket Prasmanan
                </div>
            </div>
        </div>

    </div>

    <div class="flex items-center justify-center my-12">
        <div class="h-px bg-gray-300 w-1/3"></div>
        <span class="px-4 text-gray-400 font-serif">✤</span>
        <div class="h-px bg-gray-300 w-1/3"></div>
    </div>


    <!-- ===================================================== -->
    <!-- FORM RESERVASI -->
    <!-- ===================================================== -->

    <div class="bg-[#F5EFEC] rounded-2xl p-8 md:p-12 shadow-sm border border-gray-100">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- SIDEBAR -->

            <div class="lg:col-span-4">

                <h2 class="text-2xl font-serif font-bold mb-3">Detail Reservasi</h2>

                <p class="text-xs text-gray-600 leading-relaxed mb-6">
                    Lengkapi data reservasi Anda. DP wajib dibayarkan sebesar
                    <span class="font-semibold text-[#B58A5B]">Rp10.000 per peserta</span>
                    dan dihitung otomatis oleh sistem.
                </p>

                <div class="bg-[#EFE9E2] p-4 rounded-xl border border-gray-200/60 text-xs text-gray-700 space-y-3">
                    <p class="font-semibold text-gray-900 flex items-center gap-2">
                        <i class="fa-regular fa-lightbulb text-[#B58A5B]"></i> Informasi Reservasi
                    </p>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-[#1C3A27] mt-0.5"></i>
                            Jam yang sudah penuh langsung terlihat saat Anda memilih tanggal
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-[#1C3A27] mt-0.5"></i>
                            DP dihitung otomatis: Rp10.000 &times; jumlah peserta
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-[#1C3A27] mt-0.5"></i>
                            Bukti reservasi tersimpan otomatis di sistem kami
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-[#1C3A27] mt-0.5"></i>
                            Dapat berkonsultasi dengan admin kapan saja
                        </li>
                    </ul>
                </div>

                <div class="mt-4 bg-white border border-[#E0C097] rounded-xl p-4">
                    <p class="text-[10px] font-semibold tracking-widest text-[#B58A5B] mb-1">Estimasi DP Saat Ini</p>
                    <p id="dpPreview" class="text-2xl font-serif font-bold text-[#231512]">Rp0</p>
                    <p class="text-[11px] text-gray-500 mt-1">Otomatis diperbarui sesuai jumlah peserta yang Anda masukkan.</p>
                </div>

                <div class="mt-4 flex items-center gap-2 text-[11px] text-gray-500">
                    <i class="fa-regular fa-clock text-[#B58A5B]"></i>
                    Jam operasional harian: 09.00 &ndash; 21.00 WIB
                </div>

            </div>


            <!-- FORM -->

            <div class="lg:col-span-8 bg-white p-6 md:p-8 rounded-xl shadow-sm">

                <form id="reservasiForm" action="{{ route('reservasi.store') }}" method="POST"
                      enctype="multipart/form-data" class="space-y-8" novalidate>

                    @csrf

                    <!-- GROUP 1: DATA PEMESAN -->
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="w-5 h-5 rounded-full bg-[#231512] text-white text-[10px] font-bold flex items-center justify-center">1</span>
                            <h3 class="text-sm font-bold text-gray-800">Data Pemesan</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label for="nama" class="block text-xs font-bold text-gray-700 mb-2">Nama Lengkap</label>
                                <input
                                    type="text" id="nama" name="nama_lengkap"
                                    placeholder="Masukkan nama Anda" required
                                    onblur="validateField('nama')" oninput="clearFieldError('nama')"
                                    class="w-full text-sm border-b border-gray-300 py-2 focus:outline-none focus:border-[#C86D3B] bg-transparent transition-colors">
                                <p id="errNama" class="text-[11px] text-red-600 mt-1 hidden"></p>
                            </div>

                            <div>
                                <label for="whatsapp" class="block text-xs font-bold text-gray-700 mb-2">Nomor WhatsApp</label>
                                <input
                                    type="tel"
                                    id="whatsapp"
                                    name="nomor_whatsapp"
                                    placeholder="08xx xxxx xxxx"
                                    required
                                    maxlength="14"
                                    minlength="10"
                                    inputmode="numeric"
                                    pattern="^08[0-9]{8,12}$"
                                    onblur="validateField('whatsapp')"
                                    oninput="clearFieldError('whatsapp')"
                                    class="w-full text-sm border-b border-gray-300 py-2 focus:outline-none focus:border-[#C86D3B] bg-transparent transition-colors">
                            <p id="errWhatsapp" class="text-[11px] text-red-600 mt-1 hidden"></p>

                        </div>
                    </div>


                    <!-- GROUP 2: JADWAL & KAPASITAS -->
                    
                    <div class="mt-3">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="w-5 h-5 rounded-full bg-[#231512] text-white text-[10px] font-bold flex items-center justify-center">2</span>
                            <h3 class="text-sm font-bold text-gray-800">Jadwal &amp; Kapasitas</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                            <div>
                                <label for="tanggal" class="block text-xs font-bold text-gray-700 mb-2">Tanggal Acara</label>
                                <input
                                    type="date" id="tanggal" name="tanggal_acara" required
                                    onchange="onTanggalChange()"
                                    class="w-full text-sm border-b border-gray-300 py-2 focus:outline-none focus:border-[#C86D3B] bg-transparent text-gray-700 transition-colors">
                                <p id="errTanggal" class="text-[11px] text-red-600 mt-1 hidden"></p>
                            </div>

                            <div>
                                <label for="peserta" class="block text-xs font-bold text-gray-700 mb-2">Jumlah Peserta</label>
                                <input
    type="number"
    id="peserta"
    name="jumlah_peserta"
    placeholder="Contoh: 20"
    min="1"
    max="100"
    required
    oninput="updateDpPreview(); clearFieldError('peserta'); onPesertaChange()"
    onblur="validateField('peserta')"
    class="w-full text-sm border-b border-gray-300 py-2 focus:outline-none focus:border-[#C86D3B] bg-transparent transition-colors"
>
                            </div>

                        </div>

                        <!-- PEMILIH JAM VISUAL -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-2">Rentang Waktu Reservasi</label>

                            <div class="grid grid-cols-2 gap-4 mb-3">

    <div>
        <label class="block text-[11px] text-gray-500 mb-1">
            Jam Mulai
        </label>

        <input
            type="hidden"
            id="jamMulai"
            name="jam_mulai"
        >

        <div
            id="jamMulaiDisplay"
            class="w-full text-sm border-b border-gray-300 py-2 text-gray-400"
        >
            Pilih slot di bawah
        </div>
    </div>

    <div>
        <label class="block text-[11px] text-gray-500 mb-1">
            Jam Selesai
        </label>

        <input
            type="hidden"
            id="jamSelesai"
            name="jam_selesai"
        >

        <div
            id="jamSelesaiDisplay"
            class="w-full text-sm border-b border-gray-300 py-2 text-gray-400"
        >
            Pilih slot di bawah
        </div>
    </div>

</div>

                            <p id="statusJam" class="text-[11px] mb-2"></p>

                            <div id="jadwalTerpakaiBox" class="hidden border border-gray-200 rounded-2xl p-4 bg-gray-50/70">
                                <div class="flex items-start justify-between gap-4 mb-3">
                                    <div class="flex items-start gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-[#1C3A27] text-white flex items-center justify-center shrink-0">
                                            <i class="fa-regular fa-calendar-check text-xs"></i>
                                        </div>
                                        <div>
                                            <p class="text-[11px] font-bold text-gray-800">Ketersediaan Jadwal</p>
                                            <p id="jadwalTanggalLabel" class="text-[10px] text-gray-500 mt-0.5">Pilih slot yang masih tersedia.</p>
                                        </div>
                                    </div>
                                    <span id="slotCounter" class="shrink-0 text-[9px] font-bold bg-white border border-gray-200 rounded-full px-2.5 py-1 text-gray-600">-</span>
                                </div>

                                <div class="flex flex-wrap gap-2 mb-3 text-[9px] font-medium text-gray-600">
                                    <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-[#1C3A27]"></span>Tersedia</span>
                                    <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-red-500"></span>Sudah dibooking</span>
                                </div>

                                <div id="rangeHelper" class="range-helper rounded-lg px-3 py-2 mb-3 text-[10px]">
                                    <i class="fa-solid fa-hand-pointer mr-1"></i> Klik jam mulai, lalu klik jam akhir. Contoh: pilih 10.00–11.00 lalu 12.00–13.00 untuk mendapatkan rentang <strong>10.00–13.00 WIB</strong>.
                                </div>

                                <div id="jadwalTerpakaiList" class="schedule-grid"></div>

                                <div id="rangeAction" class="hidden mt-3 flex items-center justify-between gap-3 rounded-xl bg-[#1C3A27] text-white px-3 py-2.5">
                                    <div>
                                        <p class="text-[9px] text-white/70">Rentang dipilih</p>
                                        <p id="rangeSummary" class="text-[12px] font-bold">-</p>
                                    </div>
                                    <button type="button" onclick="resetRangeSelection()" class="text-[9px] font-semibold border border-white/30 rounded-md px-2 py-1.5 hover:bg-white/10">Ganti</button>
                                </div>

                                <div class="mt-3 flex items-center gap-2 text-[10px] text-gray-500">
                                    <i class="fa-solid fa-circle-info text-[#B58A5B]"></i>
                                    Slot merah tidak dapat dipilih. Pilih slot hijau untuk mengisi rentang waktu reservasi.
                                </div>
                            </div>

                            <input type="hidden" id="waktu" value="">
                            <p id="errWaktu" class="text-[11px] text-red-600 mt-1 hidden"></p>
                        </div>
                    </div>


                    <!-- GROUP 3: CATATAN -->
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="w-5 h-5 rounded-full bg-[#231512] text-white text-[10px] font-bold flex items-center justify-center">3</span>
                            <h3 class="text-sm font-bold text-gray-800">Catatan <span class="font-normal text-gray-400">(opsional)</span></h3>
                        </div>

                        <input
                            type="text" name="catatan"
                            placeholder="Contoh: alergi seafood, butuh proyektor, dll."
                            class="w-full text-sm border-b border-gray-300 py-2 focus:outline-none focus:border-[#C86D3B] bg-transparent transition-colors">
                    </div>


                    <!-- HIDDEN FIELDS -->
                    <input type="hidden" id="nominal_dp" name="nominal_dp" value="0">
                    <input type="hidden" id="metode_pembayaran" name="metode_pembayaran" value="Belum Dibayar">
                    <input type="hidden" id="status_pembayaran" name="status_pembayaran" value="menunggu_konfirmasi">


                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-circle-info text-amber-700 mt-1"></i>
                            <div>
                                <p class="font-semibold text-sm text-amber-900">Informasi Pembayaran DP</p>
                                <p class="text-xs text-amber-800 mt-1 leading-relaxed">
                                    Setiap peserta wajib membayar DP sebesar <strong>Rp10.000</strong>.
                                    Nominal total dihitung otomatis berdasarkan jumlah peserta yang Anda masukkan,
                                    dan ditampilkan sebelum Anda melakukan pembayaran QRIS.
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="pt-2 flex flex-col sm:flex-row gap-4">

                        <button type="submit" name="metode_pembayaran" value="bayar_ditempat"
                            class="flex-1 bg-[#231512] text-white text-xs py-3 px-6 rounded-lg font-medium hover:bg-black transition">
                            <i class="fa-solid fa-paper-plane mr-2"></i> Kirim Data (Bayar Nanti)
                        </button>

                        <button type="button" onclick="validateAndOpenQris()"
                            class="flex-1 bg-[#C86D3B] hover:bg-[#b05d31] text-white text-xs py-3 px-6 rounded-lg font-medium transition shadow-md">
                            <i class="fa-solid fa-qrcode mr-2"></i> Bayar DP via QRIS
                        </button>

                        <a href="https://wa.me/6281391218819" target="_blank"
                           class="flex-1 text-center border border-gray-300 text-xs py-3 px-6 rounded-lg font-medium text-gray-800 hover:bg-gray-50 transition">
                            <i class="fa-brands fa-whatsapp mr-2 text-green-600"></i> Tanya Admin
                        </a>

                    </div>

                </form>
            </div>

        </div>
    </div>

</main>


<!-- ========================================================= -->
<!-- MODAL QRIS -->
<!-- ========================================================= -->

<div id="qrisModal" class="overlay-enter fixed inset-0 bg-black/70 z-50 hidden items-center justify-center p-4">

    <div class="sheet-enter bg-white rounded-2xl max-w-md w-full max-h-[90vh] relative shadow-2xl border border-gray-100 flex flex-col overflow-hidden">

        <button onclick="closeQrisModal()" class="absolute top-4 right-4 text-gray-400 hover:text-black z-10 bg-white/80 rounded-full w-7 h-7 flex items-center justify-center">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>

        <div class="p-6 text-center overflow-y-auto">

            <div class="flex items-center justify-center gap-2 mb-1">
                <span class="bg-amber-100 text-amber-800 text-[10px] font-bold px-2.5 py-0.5 rounded-full tracking-wide">Official QRIS</span>
            </div>

            <h3 class="font-serif text-xl font-bold text-[#2D1A12]">Warung Jawa Ulam Sari</h3>

            <p class="text-xs text-gray-500 mb-3">
                Scan kode QR di bawah menggunakan BCA, Mandiri, OVO, GoPay, Dana, dan aplikasi pembayaran lainnya.
            </p>

            <div class="bg-amber-50 border border-amber-200 text-amber-900 rounded-lg py-1.5 px-3 text-xs mb-4 flex items-center justify-center gap-2 font-medium">
                <i class="fa-regular fa-clock"></i> Waktu pembayaran: <span id="countdown" class="font-bold text-red-600">05:00</span>
            </div>

            <div class="bg-white p-3 rounded-xl inline-block mb-3 border-2 border-dashed border-gray-300 shadow-inner">
                <img src="{{ asset('images/Qris.png') }}" alt="QRIS Ulam Sari" class="w-48 h-48 mx-auto object-contain rounded-md">
            </div>

            <div class="bg-[#231512] text-white rounded-xl py-3 px-4 mb-4">
                <p class="text-[10px] tracking-widest text-amber-200/80">Total DP yang Harus Dibayar</p>
                <p id="summaryDpBesar" class="text-2xl font-serif font-bold text-[#E0C097]">Rp0</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl text-left text-xs text-gray-700 mb-5 space-y-2 border border-gray-200">
                <div class="flex justify-between gap-4"><span>Nama Pemesan:</span><span id="summaryNama" class="font-semibold text-gray-900 text-right">-</span></div>
                <div class="flex justify-between gap-4"><span>Tanggal:</span><span id="summaryTanggal" class="font-semibold text-gray-900">-</span></div>
                <div class="flex justify-between gap-4"><span>Jam Reservasi:</span><span id="summaryWaktu" class="font-semibold text-gray-900">-</span></div>
                <div class="flex justify-between gap-4"><span>Jumlah Peserta:</span><span id="summaryPeserta" class="font-semibold text-gray-900">-</span></div>
                <div class="flex justify-between gap-4"><span>Rincian DP:</span><span id="summaryDpRincian" class="font-semibold text-[#C86D3B] text-right">-</span></div>
                <div class="flex justify-between gap-4"><span>Metode:</span><span class="font-semibold">QRIS</span></div>
            </div>

            <div class="mb-4 text-left">
                <label class="block text-xs font-bold text-gray-700 mb-2">Upload Bukti Transfer <span class="text-red-500">*</span></label>
                <input type="file" id="buktiTransfer" name="bukti_transfer" accept="image/*"
                    class="w-full text-xs border border-gray-300 rounded-lg p-2 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-medium file:bg-[#F5EFEC] file:text-[#231512]">
                <p class="text-[11px] text-gray-500 mt-1">
                    Screenshot bukti transfer wajib dilampirkan. Admin akan memverifikasi pembayaran Anda secara manual sebelum reservasi dikonfirmasi.
                </p>
            </div>

            <div class="bg-amber-50 border border-amber-200 rounded-lg p-3 mb-4 text-left">
                <p class="text-xs text-amber-800 leading-relaxed">
                    <i class="fa-solid fa-circle-info mr-1"></i>
                    Reservasi <strong>belum dianggap terkonfirmasi</strong> hanya karena Anda menekan tombol ini.
                    Status akan berubah menjadi <strong>"Terkonfirmasi"</strong> setelah admin memeriksa dan mencocokkan bukti transfer Anda.
                </p>
            </div>

            <div class="space-y-2">
                <button id="confirmPaymentBtn" onclick="confirmPayment()"
                    class="w-full bg-[#1C3A27] hover:bg-[#142B1D] text-white text-xs py-3 rounded-lg font-medium transition shadow-sm disabled:opacity-60 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                    <i id="confirmPaymentIcon" class="fa-solid fa-paper-plane"></i>
                    <span id="confirmPaymentBtnText">Kirim Bukti Pembayaran</span>
                </button>

                <button onclick="paymentCancelled()"
                    class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs py-2 rounded-lg font-medium transition">
                    Batalkan
                </button>
            </div>

        </div>

    </div>
</div>


<!-- ========================================================= -->
<!-- MODAL STATUS -->
<!-- ========================================================= -->

<div id="statusModal" class="overlay-enter fixed inset-0 bg-black/70 z-50 hidden items-center justify-center p-4">

    <div class="sheet-enter bg-white rounded-2xl max-w-sm w-full max-h-[90vh] relative shadow-xl flex flex-col overflow-hidden">

        <div class="p-6 text-center overflow-y-auto">

            <div id="statusIcon" class="text-5xl mb-3"></div>
            <h3 id="statusTitle" class="font-serif text-xl font-bold mb-2"></h3>
            <p id="statusDesc" class="text-xs text-gray-600 mb-4"></p>

            <div id="statusDetailBox" class="hidden bg-gray-50 border border-gray-200 rounded-xl p-4 text-left text-xs text-gray-700 space-y-2 mb-5">
                <div class="flex justify-between gap-4"><span>Kode Reservasi:</span><span id="detailKode" class="font-semibold text-gray-900">-</span></div>
                <div class="flex justify-between gap-4"><span>Nama:</span><span id="detailNama" class="font-semibold text-gray-900">-</span></div>
                <div class="flex justify-between gap-4"><span>Tanggal Acara:</span><span id="detailTanggal" class="font-semibold text-gray-900">-</span></div>
                <div class="flex justify-between gap-4"><span>Jumlah Peserta:</span><span id="detailPeserta" class="font-semibold text-gray-900">-</span></div>
                <div class="flex justify-between gap-4"><span>Total DP Dibayar:</span><span id="detailDp" class="font-semibold text-[#C86D3B]">-</span></div>
                <div class="flex justify-between gap-4"><span>Status:</span><span id="detailStatus" class="font-semibold text-amber-700">-</span></div>
            </div>

            <button onclick="closeStatusModal()" class="w-full bg-[#2D1A12] text-white text-xs py-2.5 rounded-lg font-medium">
                OK / Selesai
            </button>

        </div>

    </div>
</div>


<!-- ========================================================= -->
<!-- FOOTER -->
<!-- ========================================================= -->

<footer class="bg-[#0F2218] text-amber-100/80 pt-16 pb-8 px-6">

    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-emerald-800/60 text-sm">

        <div class="space-y-4">
            <h3 class="font-serif font-bold text-2xl text-[#E0C097]">Ulam Sari</h3>
            <p class="text-emerald-200/80 text-xs leading-relaxed">
                Masakan khas Jawa tradisional. Menyajikan kehangatan masakan keluarga
                bernuansa keakraban di Ajibarang, Banyumas.
            </p>
        </div>

        <div class="space-y-3">
            <h4 class="font-bold text-[#E0C097] text-xs tracking-wider">Tautan</h4>
            <ul class="space-y-2 text-xs text-emerald-100/90">
                <li><a href="/" class="hover:underline">Beranda</a></li>
                <li><a href="/menu" class="hover:underline">Menu</a></li>
                <li><a href="/reservasi" class="hover:underline">Reservasi</a></li>
                <li><a href="/tentang-kami" class="hover:underline">Tentang Kami</a></li>
            </ul>
        </div>

        <div class="space-y-3">
            <h4 class="font-bold text-[#E0C097] text-xs tracking-wider">Informasi &amp; Lokasi</h4>
            <ul class="space-y-2 text-xs text-emerald-100/90">
                <li>
                    <a href="https://maps.app.goo.gl/i7ge5vpXZHDj5fn48" target="_blank" class="hover:underline flex items-start gap-1.5">
                        <i class="fa-solid fa-location-dot text-[#C86D3B] mt-0.5"></i>
                        <span>Ajibarang, Banyumas, Jawa Tengah</span>
                    </a>
                </li>
                <li><a href="/tentang-kami" class="hover:underline">Tentang Kami</a></li>
            </ul>
        </div>

        <div class="space-y-3">
            <h4 class="font-bold text-[#E0C097] text-xs tracking-wider">Jam Buka</h4>
            <p class="text-xs text-emerald-100/90 flex items-center gap-1.5">
                <i class="fa-regular fa-clock text-[#C86D3B]"></i> Setiap Hari: 09.00 - 21.00 WIB
            </p>
        </div>

    </div>

    <div class="max-w-7xl mx-auto pt-6 text-center text-xs text-emerald-300/70">
        &copy; 2026 Resto dan Lesehan Ulam Sari. Hak Cipta Dilindungi Undang-Undang.
    </div>

</footer>


<!-- ========================================================= -->
<!-- JAVASCRIPT -->
<!-- ========================================================= -->

<script>

    const DP_PER_ORANG = 10000;
    let timerInterval;
let jamTersedia = false;
let rangeMulai = null;
let rangeSelesai = null;
let scheduleSlots = [];

    // ============================================================
    // DATA JAM YANG SUDAH DIBOOKING
    // Kalau nanti mau ambil dari database, ganti baris di bawah jadi:
    //   const jamTerbooking = @json($jamTerbooking ?? []);
    // dan controller cukup kirim variabel $jamTerbooking ke view.
    // Format tiap item: { tanggal: 'YYYY-MM-DD', waktu: 'HH:MM' }
    // ============================================================

    // ============================================================
    // DATA JADWAL YANG SUDAH DIBOOKING (dummy / contoh)
    // Ini BUKAN dari database — cuma simulasi supaya tampilan bisa
    // dicoba. Ganti baris di bawah dengan data asli kalau backend
    // sudah siap, misalnya:
    //   const jamTerbooking = @json($jamTerbooking ?? []);
    // dan controller mengirim variabel $jamTerbooking ke view berupa
    // array objek { tanggal, mulai, selesai }.
    // ============================================================

    // ============================================================
    // DATA BOOKING
    // ============================================================
    // Untuk produksi, ganti dengan:
    // const jamTerbooking = @json($jamTerbooking ?? []);
    //
    // Format:
    // { tanggal: 'YYYY-MM-DD', mulai: 'HH:MM', selesai: 'HH:MM', status: 'confirmed' }
    //
    // status:
    // confirmed = sudah dikonfirmasi
    // pending   = menunggu verifikasi/pembayaran
    // ============================================================

async function loadAvailability() {
    const tanggal = document.getElementById('tanggal')?.value;
    const pesertaInput = document.getElementById('peserta');

    const jumlahPeserta = parseInt(pesertaInput?.value || 1);

    const list = document.getElementById('jadwalTerpakaiList');
    const box = document.getElementById('jadwalTerpakaiBox');

    if (!tanggal) {
        if (box) box.classList.add('hidden');
        return;
    }

    if (!jumlahPeserta || jumlahPeserta < 1) {
        if (box) box.classList.add('hidden');
        return;
    }

    // Tampilkan box jadwal
    box.classList.remove('hidden');

    list.innerHTML = `
        <div class="col-span-2 text-center py-6 text-gray-400 text-sm">
            Mengecek ketersediaan jam...
        </div>
    `;

    try {
        const res = await fetch(
            `/reservasi/cek-ketersediaan?tanggal=${encodeURIComponent(tanggal)}&peserta=${encodeURIComponent(jumlahPeserta)}`
        );

        const data = await res.json();

        if (!res.ok || !data.success) {
            throw new Error('Gagal mengambil data ketersediaan.');
        }

scheduleSlots = data.slots || [];
resetRangeSelection(true);
renderScheduleSlots(tanggal, scheduleSlots);
        // Label tanggal
        const tanggalLabel = document.getElementById('jadwalTanggalLabel');

        if (tanggalLabel) {
            const dateObj = new Date(tanggal + 'T00:00:00');

            tanggalLabel.textContent =
                dateObj.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                }) + ' • Jam operasional 09.00–21.00 WIB';
        }

        // Counter
        const counter = document.getElementById('slotCounter');

        if (counter) {
            const tersedia = scheduleSlots.filter(
                slot => slot.bisa_dipilih
            ).length;

            counter.textContent = `${tersedia} slot tersedia`;
        }

    } catch (error) {

        console.error('Ketersediaan jam:', error);

        scheduleSlots = [];

        list.innerHTML = `
            <div class="col-span-2 text-center py-6 text-red-500 text-sm">
                Gagal mengambil data ketersediaan jam.
            </div>
        `;
    }
}

    const JAM_BUKA = '09:00';
    const JAM_TUTUP = '21:00';


    // ============================================================
    // TOAST NOTIFICATION
    // ============================================================

    function showToast(message, type = 'info') {

        const config = {
            success: { icon: 'fa-circle-check', bg: 'bg-[#1C3A27]', text: 'text-white' },
            error:   { icon: 'fa-circle-exclamation', bg: 'bg-[#7A2E22]', text: 'text-white' },
            warning: { icon: 'fa-triangle-exclamation', bg: 'bg-[#C86D3B]', text: 'text-white' },
            info:    { icon: 'fa-circle-info', bg: 'bg-[#2D1A12]', text: 'text-white' },
        }[type] || {};

        const container = document.getElementById('toastContainer');

        const toast = document.createElement('div');
        toast.className = `toast-in ${config.bg} ${config.text} rounded-xl shadow-lg px-4 py-3 text-sm flex items-start gap-3`;
        toast.innerHTML = `
            <i class="fa-solid ${config.icon} mt-0.5"></i>
            <span class="flex-1 leading-snug">${message}</span>
            <button class="opacity-70 hover:opacity-100" aria-label="Tutup notifikasi">
                <i class="fa-solid fa-xmark text-xs"></i>
            </button>
        `;

        toast.querySelector('button').onclick = () => dismissToast(toast);
        container.appendChild(toast);

        setTimeout(() => dismissToast(toast), 4500);

    }

    function dismissToast(toast) {

        if (!toast.isConnected) return;

        toast.classList.remove('toast-in');
        toast.classList.add('toast-out');

        setTimeout(() => toast.remove(), 200);

    }


    // ============================================================
    // FORMAT HELPERS
    // ============================================================

    function formatRupiah(angka) {
        return 'Rp' + Number(angka).toLocaleString('id-ID');
    }

    function hitungDp(jumlahPeserta) {
        return (parseInt(jumlahPeserta) || 0) * DP_PER_ORANG;
    }

    function formatTanggal(tanggal) {
        const date = new Date(tanggal + 'T00:00:00');
        return date.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
    }

    function updateDpPreview() {
        const dp = hitungDp(document.getElementById('peserta').value);
        document.getElementById('dpPreview').textContent = formatRupiah(dp);
    }


    // ============================================================
    // VALIDASI PER-FIELD (REAL TIME)
    // ============================================================

    const fieldRules = {
        nama: {
            check: v => v.trim().length > 0,
            message: 'Nama lengkap wajib diisi.'
        },
        whatsapp: {
            check: v => /^08[0-9]{8,12}$/.test(v.trim()),
            message: 'Gunakan format nomor Indonesia, contoh: 081234567890.'
        },
        peserta: {
            check: v => parseInt(v) >= 1,
            message: 'Jumlah peserta minimal 1 orang.'
        },
        
    };

    function validateField(id) {

        const input = document.getElementById(id);
        const errEl = document.getElementById('err' + id.charAt(0).toUpperCase() + id.slice(1));
        const rule = fieldRules[id];

        if (!rule) return true;

        const valid = rule.check(input.value);

        if (!valid) {
            input.classList.add('border-red-400');
            errEl.textContent = rule.message;
            errEl.classList.remove('hidden');
        } else {
            clearFieldError(id);
        }

        return valid;

    }

    function clearFieldError(id) {

        const input = document.getElementById(id);
        const errEl = document.getElementById('err' + id.charAt(0).toUpperCase() + id.slice(1));

        input.classList.remove('border-red-400');
        errEl.classList.add('hidden');

    }

    function setFieldError(id, message) {

        const errEl = document.getElementById('err' + id.charAt(0).toUpperCase() + id.slice(1));
        errEl.textContent = message;
        errEl.classList.remove('hidden');

    }


    // ============================================================
    // PEMILIH JAM VISUAL
    // ============================================================

async function onTanggalChange() {
    document.getElementById('jamMulai').value = '';
    document.getElementById('jamSelesai').value = '';
    document.getElementById('waktu').value = '';
    document.getElementById('statusJam').textContent = '';
    jamTersedia = false;

    clearFieldError('tanggal');
    document.getElementById('errWaktu').classList.add('hidden');
    resetRangeSelection(true);

    const tanggal = document.getElementById('tanggal').value;
    const peserta = parseInt(document.getElementById('peserta').value) || 0;

    const box = document.getElementById('jadwalTerpakaiBox');
    const list = document.getElementById('jadwalTerpakaiList');
    const label = document.getElementById('jadwalTanggalLabel');
    const counter = document.getElementById('slotCounter');

    if (!tanggal) {
        box.classList.add('hidden');
        return;
    }

    if (peserta < 1) {
        box.classList.add('hidden');
        return;
    }

    label.textContent =
        formatTanggal(tanggal) + ' • Jam operasional 09.00–21.00 WIB';

    try {
        const res = await fetch(
            `/reservasi/cek-ketersediaan?tanggal=${encodeURIComponent(tanggal)}&peserta=${encodeURIComponent(peserta)}`
        );

        if (!res.ok) {
            throw new Error(`HTTP ${res.status}`);
        }

        const data = await res.json();

        if (!data.success) {
            throw new Error('Data ketersediaan tidak valid');
        }

        scheduleSlots = data.slots;

        renderScheduleSlots(tanggal, data.slots);

        const slotTersedia = data.slots.filter(
            slot => slot.bisa_dipilih
        ).length;

        counter.textContent = `${slotTersedia} slot tersedia`;

        box.classList.remove('hidden');

    } catch (error) {
        console.error('Gagal mengambil data ketersediaan:', error);

        list.innerHTML = `
            <p class="text-red-500 text-sm text-center py-6">
                Gagal mengambil data ketersediaan jam.
            </p>
        `;

        box.classList.remove('hidden');
    }
}

function renderScheduleSlots(tanggal, slots) {
    scheduleSlots = slots;

    const list = document.getElementById('jadwalTerpakaiList');

    list.innerHTML = slots.map(slot => {

        if (slot.penuh) {
            return `
                <button
                    type="button"
                    disabled
                    class="schedule-card full"
                >
                    <div class="flex items-center justify-between gap-2">
                        <span class="schedule-time">
                            ${slot.mulai.replace(':', '.')} – ${slot.selesai.replace(':', '.')}
                        </span>
                        <i class="fa-solid fa-lock text-red-600 text-[10px]"></i>
                    </div>

                    <p class="schedule-meta text-red-600 font-semibold">
                        PENUH • ${slot.terisi} / ${slot.kapasitas} ORANG
                    </p>
                </button>
            `;
        }

        if (!slot.bisa_dipilih) {
            return `
                <button
                    type="button"
                    disabled
                    class="schedule-card insufficient"
                >
                    <div class="flex items-center justify-between gap-2">
                        <span class="schedule-time">
                            ${slot.mulai.replace(':', '.')} – ${slot.selesai.replace(':', '.')}
                        </span>

                        <i class="fa-solid fa-triangle-exclamation text-orange-600 text-[10px]"></i>
                    </div>

                    <p class="schedule-meta text-orange-600 font-semibold">
                        TIDAK CUKUP • ${slot.tersisa} KURSI TERSISA
                    </p>
                </button>
            `;
        }

        return `
            <button
                type="button"
                class="schedule-card available"
                data-start="${slot.mulai}"
                data-end="${slot.selesai}"
                onclick="pilihSlot('${slot.mulai}', '${slot.selesai}', this)"
            >
                <div class="flex items-center justify-between gap-2">
                    <span class="schedule-time">
                        ${slot.mulai.replace(':', '.')} – ${slot.selesai.replace(':', '.')}
                    </span>

                    <i class="fa-solid fa-circle-check text-[#1C3A27] text-[10px]"></i>
                </div>

                <p class="schedule-meta">
                    TERSEDIA • ${slot.tersisa} kursi tersisa
                </p>
            </button>
        `;
    }).join('');

    refreshRangeVisual();
}

let selectedStart = null;
let selectedEnd = null;

function pilihSlot(mulai, selesai, button) {

    // Klik pertama = JAM MULAI
    if (!selectedStart || selectedEnd) {

        selectedStart = mulai;
        selectedEnd = null;

        document.getElementById('jamMulai').value = selectedStart;
document.getElementById('jamSelesai').value = '';

document.getElementById('waktu').value = '';

document.getElementById('jamMulaiDisplay').textContent = selectedStart.replace(':', '.') + ' WIB';
document.getElementById('jamMulaiDisplay').classList.remove('text-gray-400');
document.getElementById('jamMulaiDisplay').classList.add('text-gray-900', 'font-semibold');

document.getElementById('jamSelesaiDisplay').textContent = 'Pilih slot di bawah';
document.getElementById('jamSelesaiDisplay').classList.remove('text-gray-900', 'font-semibold');
document.getElementById('jamSelesaiDisplay').classList.add('text-gray-400');

        document.getElementById('statusJam').textContent =
            `Jam mulai dipilih: ${mulai.replace(':', '.')} WIB. Pilih jam selesai.`;

        refreshRangeVisual();

        return;
    }

    // Klik kedua = JAM SELESAI
    if (!selectedEnd) {

        // Tidak boleh pilih jam selesai sebelum jam mulai
        if (selesai <= selectedStart) {
            document.getElementById('statusJam').textContent =
                'Jam selesai harus setelah jam mulai.';
            return;
        }

        selectedEnd = selesai;

        document.getElementById('jamSelesai').value = selectedEnd;

        document.getElementById('waktu').value =
            `${selectedStart} - ${selectedEnd}`;

        document.getElementById('jamSelesaiDisplay').textContent = selectedEnd.replace(':', '.') + ' WIB';
document.getElementById('jamSelesaiDisplay').classList.remove('text-gray-400');
document.getElementById('jamSelesaiDisplay').classList.add('text-gray-900', 'font-semibold');

        document.getElementById('statusJam').textContent =
            `Rentang dipilih: ${selectedStart.replace(':', '.')} – ${selectedEnd.replace(':', '.')} WIB`;

        refreshRangeVisual();
    }
}

function refreshRangeVisual() {
    const buttons = document.querySelectorAll(
        '#jadwalTerpakaiList .schedule-card.available'
    );

    buttons.forEach(button => {

        const start = button.dataset.start;
        const end = button.dataset.end;

        button.classList.remove(
            'selected-start',
            'selected-end',
            'selected-range'
        );

        if (!selectedStart) {
            return;
        }

        // Slot jam mulai
        if (start === selectedStart) {
            button.classList.add('selected-start');
        }

        // Slot jam selesai
        if (selectedEnd && end === selectedEnd) {
            button.classList.add('selected-end');
        }

        // Slot yang berada di dalam rentang
        if (
            selectedEnd &&
            start >= selectedStart &&
            end <= selectedEnd
        ) {
            button.classList.add('selected-range');
        }
    });
}

function resetRangeSelection(clearFields = false) {

    selectedStart = null;
    selectedEnd = null;

    if (clearFields) {
        document.getElementById('jamMulai').value = '';
        document.getElementById('jamSelesai').value = '';
        document.getElementById('waktu').value = '';
        document.getElementById('statusJam').textContent = '';
    }

    refreshRangeVisual();
}
    function timeToMinutes(hhmm) {
        const [h, m] = hhmm.split(':').map(Number);
        return h * 60 + m;
    }

    function onJamChange() {

        const tanggal = document.getElementById('tanggal').value;
        const mulai = document.getElementById('jamMulai').value;
        const selesai = document.getElementById('jamSelesai').value;
        const statusEl = document.getElementById('statusJam');

        jamTersedia = false;
        document.getElementById('waktu').value = '';

        if (!tanggal) {
            statusEl.textContent = '⚠️ Pilih tanggal acara terlebih dahulu.';
            statusEl.className = 'text-[11px] mb-2 text-amber-600 font-medium';
            return;
        }

        if (!mulai || !selesai) {
            statusEl.textContent = '';
            return;
        }

        if (mulai < JAM_BUKA || selesai > JAM_TUTUP) {
            statusEl.textContent = `⚠️ Jam operasional kami 09.00 - 21.00 WIB. Silakan sesuaikan jam Anda.`;
            statusEl.className = 'text-[11px] mb-2 text-red-600 font-medium';
            return;
        }

        if (timeToMinutes(selesai) <= timeToMinutes(mulai)) {
            statusEl.textContent = '⚠️ Jam selesai harus lebih besar dari jam mulai.';
            statusEl.className = 'text-[11px] mb-2 text-red-600 font-medium';
            return;
        }

    
        if (bentrok) {
            const bookingBentrok = jamTerbooking.find(item => {
                if (item.tanggal !== tanggal) return false;
                return timeToMinutes(mulai) < timeToMinutes(item.selesai)
                    && timeToMinutes(selesai) > timeToMinutes(item.mulai);
            });

            const detailBentrok = bookingBentrok
                ? ` (${bookingBentrok.mulai.replace(':', '.')} - ${bookingBentrok.selesai.replace(':', '.')} WIB)`
                : '';

            statusEl.textContent =
                `❌ ${mulai.replace(':', '.')}–${selesai.replace(':', '.')} WIB sudah terisi${detailBentrok}. Pilih slot hijau yang tersedia.`;
            statusEl.className = 'text-[11px] mb-2 text-red-600 font-semibold';
            jamTersedia = false;
        } else {
            statusEl.textContent = '✅ Jam ini tersedia — jadwal siap dipesan';
            statusEl.className = 'text-[11px] mb-2 text-green-600 font-semibold';
            statusEl.className = 'text-[11px] mb-2 text-green-600 font-medium';
            jamTersedia = true;
            document.getElementById('waktu').value = mulai;
            document.getElementById('errWaktu').classList.add('hidden');
        }

    }


    // ============================================================
    // VALIDASI FORM SECARA KESELURUHAN
    // ============================================================

    function validateForm() {

        let valid = true;

        ['nama', 'whatsapp', 'peserta'].forEach(id => {
            if (!validateField(id)) valid = false;
        });

        const tanggal = document.getElementById('tanggal').value;
        if (!tanggal) {
            setFieldError('tanggal', 'Tanggal acara wajib dipilih.');
            valid = false;
        }

        const jamMulai = document.getElementById('jamMulai').value;
        const jamSelesai = document.getElementById('jamSelesai').value;

        if (!jamMulai || !jamSelesai) {
            document.getElementById('errWaktu').textContent = 'Jam mulai dan jam selesai wajib diisi.';
            document.getElementById('errWaktu').classList.remove('hidden');
            valid = false;
        } else if (!jamTersedia) {
            setFieldError('waktu', 'Jam yang Anda pilih belum tersedia. Silakan sesuaikan lagi.');
            valid = false;
        }

        if (!valid) {
            showToast('Beberapa data belum lengkap atau belum sesuai. Silakan periksa kembali form Anda.', 'error');
        }

        return valid;

    }


    // ============================================================
    // SUBMIT "KIRIM DATA (BAYAR NANTI)"
    // ============================================================

    document.getElementById('reservasiForm').addEventListener('submit', function (e) {

        if (!validateForm()) {
            e.preventDefault();
        }

    });


    // ============================================================
    // BUKA MODAL QRIS
    // ============================================================

    function validateAndOpenQris() {

        if (!validateForm()) return;

        const nama = document.getElementById('nama').value.trim();
        const tanggal = document.getElementById('tanggal').value;
        const jamMulai = document.getElementById('jamMulai').value;
        const jamSelesai = document.getElementById('jamSelesai').value;
        const peserta = document.getElementById('peserta').value;

        const dp = hitungDp(peserta);

        document.getElementById('nominal_dp').value = dp;
        document.getElementById('metode_pembayaran').value = 'QRIS';

        document.getElementById('summaryNama').innerText = nama;
        document.getElementById('summaryTanggal').innerText = formatTanggal(tanggal);
        document.getElementById('summaryWaktu').innerText =
            jamMulai.replace(':', '.') + ' - ' + jamSelesai.replace(':', '.') + ' WIB';
        document.getElementById('summaryPeserta').innerText = peserta + ' orang';
        document.getElementById('summaryDpRincian').innerText = peserta + ' x ' + formatRupiah(DP_PER_ORANG) + ' = ' + formatRupiah(dp);
        document.getElementById('summaryDpBesar').innerText = formatRupiah(dp);

        openOverlay('qrisModal');
        startCountdown(300);

    }


    // ============================================================
    // OVERLAY HELPERS (modal open/close dengan transisi)
    // ============================================================

    function openOverlay(id) {

        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        requestAnimationFrame(() => modal.classList.add('is-open'));

    }

    function closeOverlay(id) {

        const modal = document.getElementById(id);
        modal.classList.remove('is-open');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 200);

    }

    function closeQrisModal() {
        closeOverlay('qrisModal');
        clearInterval(timerInterval);
    }


    // ============================================================
    // COUNTDOWN
    // ============================================================

    function startCountdown(duration) {

        let timer = duration;
        clearInterval(timerInterval);

        timerInterval = setInterval(function () {

            const minutes = Math.floor(timer / 60);
            const seconds = timer % 60;

            document.getElementById('countdown').textContent =
                String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');

            if (timer <= 0) {
                clearInterval(timerInterval);
                document.getElementById('countdown').textContent = 'Waktu Habis';
                showToast('Waktu pembayaran QRIS telah habis. Silakan ulangi proses reservasi.', 'warning');
                return;
            }

            timer--;

        }, 1000);

    }


    // ============================================================
    // KONFIRMASI PEMBAYARAN -> KIRIM KE SERVER
    // ============================================================

    async function confirmPayment() {

        const btn = document.getElementById('confirmPaymentBtn');
        const btnText = document.getElementById('confirmPaymentBtnText');
        const btnIcon = document.getElementById('confirmPaymentIcon');
        const form = document.getElementById('reservasiForm');
        const buktiInput = document.getElementById('buktiTransfer');

        if (!buktiInput.files || buktiInput.files.length === 0) {
            showToast('Mohon unggah screenshot bukti transfer terlebih dahulu.', 'warning');
            return;
        }

        btn.disabled = true;
        btnText.innerText = 'Mengirim bukti...';
        btnIcon.outerHTML = '<span id="confirmPaymentIcon" class="spinner"></span>';

        try {

            const formData = new FormData(form);
            formData.append('metode_pembayaran', 'dp_qris');
const buktiInput = document.getElementById('buktiTransfer');
if (buktiInput && buktiInput.files[0]) {
formData.append('bukti_transfer', buktiInput.files[0]);

}
            const response = await fetch(form.action, {
                method: 'POST',
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: formData
            });

            const data = await response.json().catch(() => null);

            if (!response.ok) {
                throw new Error((data && data.message) ? data.message : 'Gagal menyimpan reservasi. Silakan coba lagi.');
            }

            closeQrisModal();

            document.getElementById('statusIcon').innerHTML = '⏳';
            document.getElementById('statusTitle').innerText = 'Bukti Pembayaran Terkirim';
            document.getElementById('statusDesc').innerText =
                'Data reservasi dan bukti transfer Anda telah tersimpan. Reservasi ini BELUM terkonfirmasi otomatis — admin akan memeriksa bukti transfer Anda terlebih dahulu dan mengonfirmasi melalui WhatsApp setelah pembayaran tervalidasi.';

            const detail = (data && data.data) ? data.data : {};

            document.getElementById('detailKode').innerText = detail.kode_reservasi || detail.id || '-';
            document.getElementById('detailNama').innerText = detail.nama_lengkap || document.getElementById('nama').value;
            document.getElementById('detailTanggal').innerText = formatTanggal(document.getElementById('tanggal').value);
            document.getElementById('detailPeserta').innerText = (detail.jumlah_peserta || document.getElementById('peserta').value) + ' orang';
            document.getElementById('detailDp').innerText = formatRupiah(detail.nominal_dp || document.getElementById('nominal_dp').value);
            document.getElementById('detailStatus').innerText = 'Menunggu Verifikasi Admin';

            document.getElementById('statusDetailBox').classList.remove('hidden');

            openOverlay('statusModal');
            showToast('Bukti pembayaran berhasil dikirim.', 'success');

        } catch (error) {

            closeQrisModal();

            document.getElementById('statusIcon').innerHTML = '⚠️';
            document.getElementById('statusTitle').innerText = 'Reservasi Belum Tersimpan';
            document.getElementById('statusDesc').innerText =
                error.message || 'Terjadi kesalahan saat menyimpan data. Silakan hubungi admin melalui WhatsApp.';
            document.getElementById('statusDetailBox').classList.add('hidden');

            openOverlay('statusModal');
            showToast('Gagal mengirim data reservasi.', 'error');

        } finally {

            btn.disabled = false;
            btnText.innerText = 'Kirim Bukti Pembayaran';

            const spinner = document.getElementById('confirmPaymentIcon');
            if (spinner) spinner.outerHTML = '<i id="confirmPaymentIcon" class="fa-solid fa-paper-plane"></i>';

        }

    }


    // ============================================================
    // PEMBAYARAN DIBATALKAN
    // ============================================================

    function paymentCancelled() {

        closeQrisModal();

        document.getElementById('nominal_dp').value = 0;
        document.getElementById('metode_pembayaran').value = 'Belum Dibayar';

        document.getElementById('statusIcon').innerHTML = '❌';
        document.getElementById('statusTitle').innerText = 'Pembayaran Dibatalkan';
        document.getElementById('statusDesc').innerText =
            'Pembayaran belum dilanjutkan dan data belum tersimpan. Silakan ulangi proses reservasi jika ingin melanjutkan.';
        document.getElementById('statusDetailBox').classList.add('hidden');

        openOverlay('statusModal');

    }

    function closeStatusModal() {
        closeOverlay('statusModal');
    }


    // ============================================================
    // INISIALISASI
    // ============================================================

    document.getElementById('tanggal').setAttribute('min', new Date().toISOString().split('T')[0]);
    document.getElementById('tanggal')?.addEventListener(
    'change',
    loadAvailability
);
let availabilityTimer = null;

function onPesertaChange() {
    clearTimeout(availabilityTimer);

    availabilityTimer = setTimeout(() => {
        const tanggal = document.getElementById('tanggal').value;

        if (tanggal) {
            resetRangeSelection(true);
            onTanggalChange();
        }
    }, 300);
}
document.getElementById('peserta')?.addEventListener(
    'input',
    () => {
        updateDpPreview();

        clearTimeout(window.availabilityTimer);

        window.availabilityTimer = setTimeout(() => {
            loadAvailability();
        }, 300);
    }
);

</script>


</body>
</html>