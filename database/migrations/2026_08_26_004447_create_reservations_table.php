<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('customer');
            $table->string('date');
            $table->string('time');
            $table->integer('guests')->default(1);
            $table->string('phone')->nullable();
            $table->enum('status', ['menunggu', 'dikonfirmasi', 'ditolak'])->default('menunggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
