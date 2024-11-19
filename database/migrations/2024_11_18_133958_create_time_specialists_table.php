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
        Schema::create('time_specialists', function (Blueprint $table) {
            $table->id();
            $table->integer('time_id')->index()->nullable();
            $table->time('start_time')->nullable(); // Store time
            $table->time('end_time')->nullable(); // Store time
            $table->integer('service_id')->index()->default(1); // Flag if the time is booked
            $table->integer('specialist_id')->index()->default(1); // Flag if the time is booked
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_specialists');
    }
};
