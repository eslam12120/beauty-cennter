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
        Schema::create('service_specialities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services','id')->onDelete('cascade');
            $table->foreignId('specialist_id')->constrained('specialists','id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_specialities');
    }
};
