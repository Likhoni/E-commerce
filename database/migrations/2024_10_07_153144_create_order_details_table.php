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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('order_id')->constrained()->cascadeOnDelete();
            //$table->foreignId('product_id')->constrained()->restrictOnDelete();
            $table->string('product_unit_price');
            $table->string('product_quantity');
            $table->string('subtotal');
            $table->string('discount')->default(0.0);
            $table->string('discount_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
