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
        Schema::create('zacky_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table-> date('tanggal_pemesanan')->nullable();
            $table-> enum('status',['pending', 'diproses', 'selesai', 'dibatalkan'])->default('pending');
            $table-> decimal('total_harga',12,2);
            $table-> text('alamat_pengiriman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zacky_orders');
    }
};
