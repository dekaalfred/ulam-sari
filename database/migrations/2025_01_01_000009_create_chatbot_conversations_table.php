<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Satu baris = satu sesi percakapan. Customer boleh anonim (belum login/reservasi),
     * makanya customer_id nullable dan ada session_token untuk melacak sesi via cookie/browser.
     */
    public function up(): void
    {
        Schema::create('chatbot_conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();
            $table->string('session_token')->unique(); // penanda sesi untuk pengunjung anonim
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chatbot_conversations');
    }
};
