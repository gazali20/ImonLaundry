<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->string('name');
            $table->enum('role', ['mechanic', 'cashier', 'admin']);
            $table->integer('no_handphone');
            $table->text('address');
            $table->timestamps();
        });
    }
     
        
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
