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
        Schema::create('kasir_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kasir_id')->constrained('kasirs')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade'); // Perbaiki nama kolom
            $table->decimal('weight', 5, 2); // Berat pakaian dalam kg
            $table->decimal('subtotal', 10, 2); // Harga total layanan ini
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kasir_service');
    }
};
