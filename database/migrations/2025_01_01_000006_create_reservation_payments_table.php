<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservation_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('event_reservations')->cascadeOnDelete();

            // Admin yang memverifikasi pembayaran manual (tidak dipakai untuk QRIS, karena verifikasi otomatis via webhook)
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();

            $table->enum('payment_method', ['qris', 'manual_transfer']);
            $table->enum('payment_type', ['dp', 'pelunasan'])->default('dp');
            $table->decimal('amount', 12, 2);
            $table->dateTime('payment_date'); // waktu invoice/permintaan bayar dibuat

            // Kolom khusus jalur QRIS (Xendit)
            $table->string('xendit_invoice_id')->nullable();
            $table->string('payment_url')->nullable();
            $table->dateTime('expired_at')->nullable();

            // Kolom khusus jalur manual
            $table->string('payment_proof')->nullable(); // path/link bukti transfer yang diupload customer

            $table->enum('status', ['pending', 'paid', 'expired', 'rejected'])->default('pending');
            $table->dateTime('paid_at')->nullable(); // waktu pembayaran benar-benar terkonfirmasi

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservation_payments');
    }
};
