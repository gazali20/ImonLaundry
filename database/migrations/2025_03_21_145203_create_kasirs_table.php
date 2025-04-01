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
        Schema::create('kasirs', function (Blueprint $table) {
            $table->id();
            $table->string('customer'); // Nama pelanggan
            $table->string('payment')->nullable(); // Metode pembayaran
            $table->string('no_handphone');
            $table->decimal('grand_total', 10, 2); // Total harga
            $table->date('date')->useCurrent(); // Tanggal transaksi otomatis
            $table->enum('status', ['sedang_dicuci', 'siap_diambil', 'selesai'])->default('sedang_dicuci'); // Status transaksi
            $table->string('code_invoice')->unique(); // Kode invoice unik
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kasirs');
    }
};
