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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_code', 5)->unique(); // Kode unik untuk kamar
            $table->enum('room_type', ['suite', 'deluxe', 'standard']);
            $table->integer('price_per_night'); // Harga per malam
            $table->integer('capacity'); // Kapasitas maksimal tamu
            $table->text('facilities'); // Fasilitas kamar
            $table->enum('status', ['available', 'occupied',])->default('available'); // Status kamar
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
