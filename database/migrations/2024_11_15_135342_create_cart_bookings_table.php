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
        Schema::create('cart_bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('specialist_id')->nullable();
            $table->bigInteger('service_id')->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->Integer('time_id')->nullable();
            $table->Integer('time_specialist_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_bookings');
    }
};
