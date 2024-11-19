<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('specialist_id')->nullable();
            $table->bigInteger('service_id')->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->Integer('time_id')->nullable();
            $table->Integer('time_specialist_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->Integer('remind_me')->default(0)->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
