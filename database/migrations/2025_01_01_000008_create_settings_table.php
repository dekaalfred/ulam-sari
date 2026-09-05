<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Tabel key-value untuk pengaturan umum restoran yang bisa diubah admin
     * tanpa perlu edit kode, misal harga per meja untuk hitungan DP reservasi.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('value');
            $table->timestamps();
        });

        // Nilai default awal, admin bisa ubah nanti lewat dashboard
        DB::table('settings')->insert([
            'key' => 'price_per_table',
            'value' => '150000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
