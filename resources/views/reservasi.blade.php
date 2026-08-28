<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reservasi & Pembayaran QRIS - Ulam Sari</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-[#FAF7F2] text-[#2C2C2C] font-sans antialiased">


<!-- ========================================================= -->
<!-- NAVBAR -->
<!-- ========================================================= -->

<nav class="bg-[#2D1A12] text-white py-4 px-8 sticky top-0 z-50 shadow-md">

    <div class="max-w-7xl mx-auto flex justify-between items-center">

        <!-- LOGO -->
        <div class="flex items-center gap-2">

            <span class="text-2xl font-serif font-bold tracking-wide">
                Ulam Sari
            </span>

        </div>


        <!-- MENU -->
        <div class="hidden md:flex space-x-8 text-sm font-medium text-[#D1C7BD]">

            <a href="/" class="hover:text-white transition">
                Beranda
            </a>

            <a href="/menu" class="hover:text-white transition">
                Menu
            </a>

            <a href="/reservasi"
               class="text-white font-semibold border-b-2 border-[#C86D3B] pb-1">
                Reservasi
            </a>

            <a href="/tentang-kami"
               class="hover:text-white transition">
                Tentang Kami
            </a>

        </div>


        <!-- TANYA ULAM AI -->
        <!-- Menggunakan route yang sama dengan halaman Beranda -->

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

    <div class="relative z-10 text-center px-4 max-w-3xl mx-auto">

        <h1 class="text-4xl md:text-5xl font-serif font-bold text-[#E0C097] tracking-wide">
            Reservasi Tempat
        </h1>

        <p class="mt-3 text-sm md:text-base italic font-light text-amber-100/90 leading-relaxed">
            Amankan lokasi dan momen berharga Anda di Ulam Sari dengan layanan tempat dan sajian terbaik kami.
        </p>

    </div>

</section>



<!-- ========================================================= -->
<!-- MAIN -->
<!-- ========================================================= -->

<main class="max-w-6xl mx-auto px-4 py-12">


    <!-- SUCCESS MESSAGE -->

    @if(session('success'))

        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-8">

            {{ session('success') }}

        </div>

    @endif



    <!-- ===================================================== -->
    <!-- FASILITAS -->
    <!-- ===================================================== -->

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center mb-16">


        <img
            src="{{ asset('images/tradisional foods.jpg') }}"
            alt="Fasilitas Meeting Pack Ulam Sari"
            class="rounded-2xl h-80 w-full object-cover shadow-sm">


        <div>

            <span class="text-xs font-bold tracking-widest text-[#B58A5B] uppercase">
                Fasilitas Ulam Sari
            </span>


            <h2 class="text-3xl font-serif font-bold text-[#2C2C2C] mt-2 mb-4">
                Meeting Pack
            </h2>


            <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                Wujudkan pertemuan reuni atau acara spesial Anda di lantai 2 Ulam Sari dengan kenyamanan maksimal.
            </p>


            <div class="grid grid-cols-2 gap-y-4 gap-x-6 text-sm text-gray-700">


                <div class="flex items-center gap-3">

                    <i class="fa-regular fa-building text-[#B58A5B]"></i>

                    Ruangan Lantai 2

                </div>


                <div class="flex items-center gap-3">

                    <i class="fa-solid fa-volume-high text-[#B58A5B]"></i>

                    Sound System

                </div>


                <div class="flex items-center gap-3">

                    <i class="fa-solid fa-chair text-[#B58A5B]"></i>

                    Meja & Kursi

                </div>


                <div class="flex items-center gap-3">

                    <i class="fa-solid fa-utensils text-[#B58A5B]"></i>

                    Paket Prasmanan

                </div>


            </div>

        </div>

    </div>



    <!-- PEMBATAS -->

    <div class="flex items-center justify-center my-12">

        <div class="h-px bg-gray-300 w-1/3"></div>

        <span class="px-4 text-gray-400 font-serif">
            ✤
        </span>

        <div class="h-px bg-gray-300 w-1/3"></div>

    </div>



    <!-- ===================================================== -->
    <!-- FORM RESERVASI -->
    <!-- ===================================================== -->

    <div class="bg-[#F5EFEC] rounded-2xl p-8 md:p-12 shadow-sm border border-gray-100">


        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">


            <!-- INFORMASI -->

            <div class="lg:col-span-4">

                <h2 class="text-2xl font-serif font-bold mb-3">
                    Detail Reservasi
                </h2>


                <p class="text-xs text-gray-600 leading-relaxed mb-6">

                    Lengkapi data reservasi Anda. Besaran DP akan menyesuaikan dengan jumlah meja yang dipesan.

                </p>


                <div class="bg-[#EFE9E2] p-4 rounded-xl border border-gray-200/60 text-xs text-gray-700 space-y-3">


                    <p class="font-semibold text-gray-900 flex items-center gap-2">

                        <i class="fa-regular fa-lightbulb text-[#B58A5B]"></i>

                        Informasi Reservasi

                    </p>


                    <ul class="space-y-2 text-gray-600">


                        <li class="flex items-start gap-2">

                            <i class="fa-solid fa-check text-green-700 mt-0.5"></i>

                            Konfirmasi reservasi melalui sistem

                        </li>


                        <li class="flex items-start gap-2">

                            <i class="fa-solid fa-check text-green-700 mt-0.5"></i>

                            Jumlah DP menyesuaikan meja

                        </li>


                        <li class="flex items-start gap-2">

                            <i class="fa-solid fa-check text-green-700 mt-0.5"></i>

                            Dapat berkonsultasi dengan admin

                        </li>


                    </ul>

                </div>

            </div>



            <!-- FORM -->

            <div class="lg:col-span-8 bg-white p-6 md:p-8 rounded-xl shadow-sm">


                <form
                    id="reservasiForm"
                    action="{{ route('reservasi.store') }}"
                    method="POST"
                    class="space-y-6">

                    @csrf



                    <!-- BARIS 1 -->

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        <!-- NAMA -->

                        <div>

                            <label class="block text-xs font-bold text-gray-700 mb-2">
                                Nama Lengkap
                            </label>


                            <input
                                type="text"
                                id="nama"
                                name="nama_lengkap"
                                placeholder="Masukkan nama Anda"
                                required
                                class="w-full text-sm border-b border-gray-300 py-2 focus:outline-none focus:border-black bg-transparent">

                        </div>



                        <!-- WHATSAPP -->

                        <div>

                            <label class="block text-xs font-bold text-gray-700 mb-2">
                                Nomor WhatsApp
                            </label>


                            <input
                                type="text"
                                id="whatsapp"
                                name="nomor_whatsapp"
                                placeholder="08xx xxxx xxxx"
                                required
                                class="w-full text-sm border-b border-gray-300 py-2 focus:outline-none focus:border-black bg-transparent">

                        </div>



                        <!-- TANGGAL -->

                        <div>

                            <label class="block text-xs font-bold text-gray-700 mb-2">
                                Tanggal Acara
                            </label>


                            <input
                                type="date"
                                id="tanggal"
                                name="tanggal_acara"
                                required
                                class="w-full text-sm border-b border-gray-300 py-2 focus:outline-none focus:border-black bg-transparent text-gray-500">

                        </div>



                        <!-- JUMLAH PESERTA -->

                        <div>

                            <label class="block text-xs font-bold text-gray-700 mb-2">
                                Jumlah Peserta
                            </label>


                            <input
                                type="number"
                                id="peserta"
                                name="jumlah_peserta"
                                placeholder="Contoh: 20"
                                min="1"
                                required
                                class="w-full text-sm border-b border-gray-300 py-2 focus:outline-none focus:border-black bg-transparent">

                        </div>



                        <!-- JUMLAH MEJA -->

                        <div>

                            <label class="block text-xs font-bold text-gray-700 mb-2">
                                Jumlah Meja
                            </label>


                            <input
                                type="number"
                                id="meja"
                                name="jumlah_meja"
                                placeholder="Contoh: 2"
                                min="1"
                                required
                                class="w-full text-sm border-b border-gray-300 py-2 focus:outline-none focus:border-black bg-transparent">

                        </div>



                        <!-- WAKTU ACARA -->

                        <div>

                            <label class="block text-xs font-bold text-gray-700 mb-2">
                                Waktu Acara
                            </label>


                            <input
                                type="time"
                                id="waktu"
                                name="waktu_acara"
                                required
                                class="w-full text-sm border-b border-gray-300 py-2 focus:outline-none focus:border-black bg-transparent">

                        </div>


                    </div>



                    <!-- CATATAN -->

                    <div>

                        <label class="block text-xs font-bold text-gray-700 mb-2">

                            Catatan Tambahan
                            <span class="font-normal text-gray-400">
                                (Opsional)
                            </span>

                        </label>


                        <input
                            type="text"
                            name="catatan"
                            placeholder="Contoh: Alergi seafood, butuh proyektor, dll."
                            class="w-full text-sm border-b border-gray-300 py-2 focus:outline-none focus:border-black bg-transparent">

                    </div>



                    <!-- INFORMASI DP -->

                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">

                        <div class="flex items-start gap-3">

                            <i class="fa-solid fa-circle-info text-amber-700 mt-1"></i>

                            <div>

                                <p class="font-semibold text-sm text-amber-900">
                                    Informasi Pembayaran DP
                                </p>

                                <p class="text-xs text-amber-800 mt-1 leading-relaxed">

                                    Nominal DP tidak memiliki harga tetap.
                                    Besaran DP akan menyesuaikan dengan jumlah meja yang Anda reservasi.
                                    Silakan konfirmasi nominal DP kepada admin.

                                </p>

                            </div>

                        </div>

                    </div>



                    <!-- TOMBOL -->

                    <div class="pt-4 flex flex-col sm:flex-row gap-4">


                        <!-- KIRIM DATA -->

                        <button
                            type="submit"
                            class="flex-1 bg-[#231512] text-white text-xs py-3 px-6 rounded-lg font-medium hover:bg-black transition">

                            <i class="fa-solid fa-paper-plane mr-2"></i>

                            Kirim Data

                        </button>



                        <!-- QRIS -->

                        <button
                            type="button"
                            onclick="validateAndOpenQris()"
                            class="flex-1 bg-[#C86D3B] hover:bg-[#b05d31] text-white text-xs py-3 px-6 rounded-lg font-medium transition text-center shadow-md">

                            <i class="fa-solid fa-qrcode mr-2"></i>

                            Bayar DP via QRIS

                        </button>



                        <!-- ADMIN -->

                        <a
                            href="https://wa.me/6281391218819"
                            target="_blank"
                            class="flex-1 text-center border border-gray-400 text-xs py-3 px-6 rounded-lg font-medium text-gray-800 hover:bg-gray-50 transition">

                            <i class="fa-brands fa-whatsapp mr-2 text-green-600"></i>

                            Tanya Admin

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

<div
    id="qrisModal"
    class="fixed inset-0 bg-black/70 z-50 hidden items-center justify-center p-4">

    <div class="bg-white rounded-2xl max-w-md w-full p-6 text-center relative shadow-2xl border border-gray-100">


        <!-- CLOSE -->

        <button
            onclick="closeQrisModal()"
            class="absolute top-4 right-4 text-gray-400 hover:text-black">

            <i class="fa-solid fa-xmark text-lg"></i>

        </button>



        <!-- BADGE -->

        <div class="flex items-center justify-center gap-2 mb-1">

            <span class="bg-amber-100 text-amber-800 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider">

                Official QRIS

            </span>

        </div>



        <h3 class="font-serif text-xl font-bold text-[#2D1A12]">

            Warung Jawa Ulam Sari

        </h3>



        <p class="text-xs text-gray-500 mb-3">

            Scan kode QR di bawah menggunakan BCA, Mandiri, OVO, GoPay, Dana, dan aplikasi pembayaran lainnya.

        </p>



        <!-- TIMER -->

        <div class="bg-amber-50 border border-amber-200 text-amber-900 rounded-lg py-1.5 px-3 text-xs mb-4 flex items-center justify-center gap-2 font-medium">

            <i class="fa-regular fa-clock"></i>

            Waktu pembayaran:

            <span
                id="countdown"
                class="font-bold text-red-600">

                05:00

            </span>

        </div>



        <!-- QRIS IMAGE -->

        <div class="bg-white p-3 rounded-xl inline-block mb-3 border-2 border-dashed border-gray-300 shadow-inner">

            <img
                src="{{ asset('images/Qris.png') }}"
                alt="QRIS Ulam Sari"
                class="w-48 h-48 mx-auto object-contain rounded-md">

        </div>



        <!-- SUMMARY -->

        <div class="bg-gray-50 p-4 rounded-xl text-left text-xs text-gray-700 mb-5 space-y-2 border border-gray-200">


            <!-- NAMA -->

            <div class="flex justify-between gap-4">

                <span>
                    Nama Pemesan:
                </span>

                <span
                    id="summaryNama"
                    class="font-semibold text-gray-900 text-right">

                    -

                </span>

            </div>



            <!-- TANGGAL -->

            <div class="flex justify-between gap-4">

                <span>
                    Tanggal:
                </span>

                <span
                    id="summaryTanggal"
                    class="font-semibold text-gray-900">

                    -

                </span>

            </div>



            <!-- MEJA -->

            <div class="flex justify-between gap-4">

                <span>
                    Jumlah Meja:
                </span>

                <span
                    id="summaryMeja"
                    class="font-semibold text-gray-900">

                    -

                </span>

            </div>



            <!-- DP -->

            <div class="flex justify-between gap-4">

                <span>
                    Nominal DP:
                </span>

                <span
                    class="font-semibold text-[#C86D3B] text-right">

                    Menyesuaikan jumlah meja

                </span>

            </div>



            <!-- METODE -->

            <div class="flex justify-between gap-4">

                <span>
                    Metode:
                </span>

                <span class="font-semibold">

                    QRIS

                </span>

            </div>

        </div>



        <!-- PERINGATAN -->

        <div class="bg-red-50 border border-red-200 rounded-lg p-3 mb-4 text-left">

            <p class="text-xs text-red-700 leading-relaxed">

                <i class="fa-solid fa-triangle-exclamation mr-1"></i>

                Nominal pembayaran belum ditentukan secara otomatis.
                Silakan konfirmasi nominal DP kepada admin sebelum melakukan pembayaran.

            </p>

        </div>



        <!-- BUTTON -->

        <div class="space-y-2">


            <button
                onclick="confirmPayment()"
                class="w-full bg-[#1C3A27] hover:bg-[#142B1D] text-white text-xs py-3 rounded-lg font-medium transition shadow-sm">

                <i class="fa-solid fa-check mr-2"></i>

                Saya Sudah Membayar

            </button>



            <button
                onclick="paymentFailedSim()"
                class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs py-2 rounded-lg font-medium transition">

                Batalkan

            </button>


        </div>

    </div>

</div>



<!-- ========================================================= -->
<!-- MODAL STATUS -->
<!-- ========================================================= -->

<div
    id="statusModal"
    class="fixed inset-0 bg-black/70 z-50 hidden items-center justify-center p-4">

    <div class="bg-white rounded-2xl max-w-sm w-full p-6 text-center relative shadow-xl">


        <div
            id="statusIcon"
            class="text-5xl mb-3">
        </div>


        <h3
            id="statusTitle"
            class="font-serif text-xl font-bold mb-2">
        </h3>


        <p
            id="statusDesc"
            class="text-xs text-gray-600 mb-6">
        </p>


        <button
            onclick="closeStatusModal()"
            class="w-full bg-[#2D1A12] text-white text-xs py-2.5 rounded-lg font-medium">

            OK / Selesai

        </button>

    </div>

</div>



<!-- ========================================================= -->
<!-- FOOTER -->
<!-- ========================================================= -->

<footer class="bg-[#0F2218] text-amber-100/80 pt-16 pb-8 px-6">


    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-emerald-800/60 text-sm">


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



        <!-- LOCATION -->

        <div class="space-y-3">

            <h4 class="font-bold text-[#E0C097] text-xs uppercase tracking-wider">
                Informasi & Lokasi
            </h4>


            <ul class="space-y-2 text-xs text-emerald-100/90">

                <li>

                    <a
                        href="https://maps.app.goo.gl/i7ge5vpXZHDj5fn48"
                        target="_blank"
                        class="hover:underline flex items-start gap-1.5">

                        <i class="fa-solid fa-location-dot text-[#C86D3B] mt-0.5"></i>

                        <span>
                            Ajibarang, Banyumas, Jawa Tengah
                        </span>

                    </a>

                </li>


                <li>

                    <a href="/tentang-kami" class="hover:underline">

                        Tentang Kami

                    </a>

                </li>

            </ul>

        </div>



        <!-- JAM -->

        <div class="space-y-3">

            <h4 class="font-bold text-[#E0C097] text-xs uppercase tracking-wider">

                Jam Buka

            </h4>


            <p class="text-xs text-emerald-100/90 flex items-center gap-1.5">

                <i class="fa-regular fa-clock text-[#C86D3B]"></i>

                Setiap Hari: 09.00 - 21.00 WIB

            </p>

        </div>


    </div>



    <div class="max-w-7xl mx-auto pt-6 text-center text-xs text-emerald-300/70">

        &copy; 2026 Resto dan Lesehan Ulam Sari.
        Hak Cipta Dilindungi Undang-Undang.

    </div>

</footer>



<!-- ========================================================= -->
<!-- JAVASCRIPT -->
<!-- ========================================================= -->

<script>

    let timerInterval;



    // ========================================================
    // VALIDASI DAN BUKA QRIS
    // ========================================================

    function validateAndOpenQris() {


        const nama =
            document.getElementById('nama').value.trim();


        const whatsapp =
            document.getElementById('whatsapp').value.trim();


        const tanggal =
            document.getElementById('tanggal').value;


        const peserta =
            document.getElementById('peserta').value;


        const meja =
            document.getElementById('meja').value;


        const waktu =
            document.getElementById('waktu').value;



        if (
            !nama ||
            !whatsapp ||
            !tanggal ||
            !peserta ||
            !meja ||
            !waktu
        ) {

            alert(
                'Mohon lengkapi Nama, WhatsApp, Tanggal Acara, Jumlah Peserta, Jumlah Meja, dan Waktu Acara terlebih dahulu.'
            );

            return;

        }



        // Isi data ke modal

        document.getElementById('summaryNama').innerText =
            nama;


        document.getElementById('summaryTanggal').innerText =
            formatTanggal(tanggal);


        document.getElementById('summaryMeja').innerText =
            meja + ' meja';



        // Buka modal

        const modal =
            document.getElementById('qrisModal');


        modal.classList.remove('hidden');

        modal.classList.add('flex');



        // Mulai timer 5 menit

        startCountdown(300);

    }



    // ========================================================
    // FORMAT TANGGAL
    // ========================================================

    function formatTanggal(tanggal) {


        const date =
            new Date(tanggal + 'T00:00:00');


        return date.toLocaleDateString(
            'id-ID',
            {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            }
        );

    }



    // ========================================================
    // CLOSE QRIS
    // ========================================================

    function closeQrisModal() {


        const modal =
            document.getElementById('qrisModal');


        modal.classList.add('hidden');

        modal.classList.remove('flex');


        clearInterval(timerInterval);

    }



    // ========================================================
    // COUNTDOWN
    // ========================================================

    function startCountdown(duration) {


        let timer = duration;


        clearInterval(timerInterval);


        timerInterval = setInterval(function () {


            const minutes =
                Math.floor(timer / 60);


            const seconds =
                timer % 60;



            const formattedMinutes =
                minutes < 10
                    ? "0" + minutes
                    : minutes;


            const formattedSeconds =
                seconds < 10
                    ? "0" + seconds
                    : seconds;



            document.getElementById('countdown').textContent =
                formattedMinutes + ":" + formattedSeconds;



            if (timer <= 0) {


                clearInterval(timerInterval);


                document.getElementById('countdown').textContent =
                    "Waktu Habis";


                return;

            }



            timer--;

        }, 1000);

    }



    // ========================================================
    // KONFIRMASI PEMBAYARAN
    // ========================================================

    function confirmPayment() {


        closeQrisModal();


        document.getElementById('statusIcon').innerHTML =
            '✅';


        document.getElementById('statusTitle').innerText =
            'Data Pembayaran Diterima';


        document.getElementById('statusDesc').innerText =
            'Terima kasih. Data reservasi dan informasi pembayaran Anda telah diterima. Admin akan melakukan pengecekan pembayaran dan mengonfirmasi reservasi melalui WhatsApp.';



        const modal =
            document.getElementById('statusModal');


        modal.classList.remove('hidden');

        modal.classList.add('flex');

    }



    // ========================================================
    // PEMBAYARAN DIBATALKAN
    // ========================================================

    function paymentFailedSim() {


        closeQrisModal();


        document.getElementById('statusIcon').innerHTML =
            '❌';


        document.getElementById('statusTitle').innerText =
            'Pembayaran Dibatalkan';


        document.getElementById('statusDesc').innerText =
            'Pembayaran belum dilanjutkan. Silakan hubungi admin jika Anda membutuhkan informasi mengenai nominal DP.';



        const modal =
            document.getElementById('statusModal');


        modal.classList.remove('hidden');

        modal.classList.add('flex');

    }



    // ========================================================
    // CLOSE STATUS
    // ========================================================

    function closeStatusModal() {


        const modal =
            document.getElementById('statusModal');


        modal.classList.add('hidden');

        modal.classList.remove('flex');

    }

</script>


</body>
</html>