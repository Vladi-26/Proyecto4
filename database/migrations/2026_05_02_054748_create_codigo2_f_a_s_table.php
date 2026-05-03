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
    Schema::create('codigo_2fas', function (Blueprint $table) {
        $table->id();
        // Relación con tu tabla de usuarios (asegúrate que el nombre sea correcto)
        $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade'); 
        $table->string('codigo'); // El código OTP numérico
        $table->timestamp('expiracion'); // Tiempo de validez (ej. 5 min)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codigo2_f_a_s');
    }
};
