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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name_en')->nullable();
            $table->string('service_name_ar')->nullable();
            $table->foreignId('category_id')->constrained('categories','id')->onDelete('cascade');
            $table->integer('price')->nullable();
            $table->string('image')->nullable();
            $table->string('session_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
