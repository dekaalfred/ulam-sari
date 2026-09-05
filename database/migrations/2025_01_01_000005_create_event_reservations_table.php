<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reservation_code')->unique(); // kode booking untuk ditunjukkan ke customer, misal RSV-20260826-001
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->date('event_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedInteger('guest_count');
            $table->unsignedInteger('table_count'); // jumlah meja yang direservasi, dasar hitungan DP
            // Status detail untuk kebutuhan backend; tampilan admin boleh dikelompokkan lebih sederhana:
            // pending & dp_paid -> "Menunggu Konfirmasi", confirmed -> "Dikonfirmasi", rejected/cancelled -> "Ditolak"
            $table->enum('status', ['pending', 'dp_paid', 'confirmed', 'rejected', 'completed', 'cancelled'])
                  ->default('pending');
            $table->decimal('dp_amount', 12, 2)->nullable(); // table_count x settings.price_per_table, dihitung saat invoice dibuat
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_reservations');
    }
};
