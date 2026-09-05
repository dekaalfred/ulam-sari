<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('reservation_code')->unique()->nullable()->after('id');
            $table->unsignedInteger('table_count')->nullable()->after('guests');
            $table->decimal('dp_amount', 12, 2)->nullable()->after('table_count');
            $table->text('notes')->nullable()->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn([
                'reservation_code',
                'table_count',
                'dp_amount',
                'notes'
            ]);
        });
    }
};