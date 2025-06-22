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
        Schema::create('zacky_stores', function (Blueprint $table) {
            $table-> id();
            $table->foreignId('user_id')->constrained();
            $table-> string('nama_toko');
            $table-> text('deskripsi');
            $table-> string('alamat');
            $table-> string('logo')->nullable();
            $table-> enum('status',['aktif','nonaktif']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zacky_stores');
    }
};
