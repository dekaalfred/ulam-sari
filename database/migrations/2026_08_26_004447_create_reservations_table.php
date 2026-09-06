<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_reservasi')->unique()->nullable();
            $table->string('nama_lengkap');
            $table->string('nomor_whatsapp');
            $table->date('tanggal_acara');
            $table->time('waktu_acara');
            $table->unsignedInteger('jumlah_peserta');
            $table->unsignedInteger('jumlah_meja');
            $table->text('catatan')->nullable();
            $table->unsignedBigInteger('nominal_dp')->default(0);
            $table->string('metode_pembayaran')->default('Belum Dibayar');
            $table->string('status_pembayaran')->default('menunggu_konfirmasi');
            $table->string('bukti_transfer')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};