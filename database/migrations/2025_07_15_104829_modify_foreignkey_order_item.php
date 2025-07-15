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
        Schema::table('zacky_order_items', function (Blueprint $table) {
            $table->foreign('product_id', 'fk_order_items_product')
            ->references('id')->on('zacky_products')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zacky_order_items', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });
    }
};
