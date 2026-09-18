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
    DB::statement("ALTER TABLE reservation_payments MODIFY payment_method ENUM('manual', 'midtrans', 'bayar_ditempat') DEFAULT 'manual'");
}

public function down(): void
{
    DB::statement("ALTER TABLE reservation_payments MODIFY payment_method ENUM('manual', 'midtrans') DEFAULT 'manual'");
}

};
