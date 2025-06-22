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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role',['admin','saller','customer'])->default('saller')->after('password');
            $table->string('alamat')->after('role');
            $table->string('no_telpon',15)->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table-> dropColumn(['role','alamat','no_telpon']);
            //
        });
    }
};
