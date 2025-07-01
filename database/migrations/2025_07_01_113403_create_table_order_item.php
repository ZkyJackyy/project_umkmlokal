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
        Schema::create('zacky_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')           // order_id (FK)
                ->constrained('zacky_orders')
                ->onDelete('cascade');

            $table->foreignId('product_id')         // product_id (FK)
                ->constrained('zacky_products')
                ->onDelete('restrict');

            $table->integer('jumlah');              // jumlah
            $table->decimal('harga_satuan', 12, 2); // harga satuan saat pembelian
            $table->decimal('subtotal', 12, 2);  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zacky_order_items');
    }
};
