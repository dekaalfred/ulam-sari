<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('reservation_payments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('reservation_id')->constrained('reservations')->cascadeOnDelete();
        $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();

        $table->enum('payment_method', ['manual', 'midtrans'])->default('manual');
        $table->decimal('amount', 12, 2);

        // Jalur manual (aktif sekarang)
        $table->string('payment_proof')->nullable(); // path bukti_transfer

        // Jalur Midtrans (lihat Tahap 7)
        $table->string('midtrans_order_id')->nullable()->unique();
        $table->string('snap_token')->nullable();
        $table->string('midtrans_transaction_id')->nullable();
        $table->string('transaction_status')->nullable(); // pending/settlement/capture/deny/cancel/expire
        $table->dateTime('expired_at')->nullable();

        $table->enum('status', ['pending', 'paid', 'expired', 'rejected'])->default('pending');
        $table->dateTime('paid_at')->nullable();

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('reservation_payments');
}
};
