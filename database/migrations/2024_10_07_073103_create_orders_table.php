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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('customer_id')->constrained()->restrictOnDelete();
            $table->string('receiver_name');
            $table->string('receiver_email');
            $table->string('receiver_mobile');
            $table->string('country')->default('bangladesh');
            $table->foreignId('district_id')->constrained('districts')->restrictOnDelete();
            $table->string('thana');
            $table->string('receiver_address');
            $table->string('status')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('order_number')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('total_discount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
