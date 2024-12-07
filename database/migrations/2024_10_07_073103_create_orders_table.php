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
            //$table->foreignId('customer_id')->constrained()->restrictOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('contact_number')->nullable();
            $table->string('country')->default('bangladesh');
            $table->foreignId('division_id')->constrained('divisions')->restrictOnDelete();
            $table->foreignId('district_id')->constrained('districts')->restrictOnDelete();
            $table->foreignId('upazila_id')->constrained('upazilas')->restrictOnDelete();
            $table->foreignId('union_id')->constrained('unions')->restrictOnDelete();
            $table->string('address');
            $table->decimal('amount');
            $table->string('payment_method')->nullable();
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
