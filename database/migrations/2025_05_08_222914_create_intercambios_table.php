<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('intercambios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->enum('estado', ['pendiente', 'confirmado', 'entregado', 'cancelado']);
            $table->foreignId('id_usuario_emisor')->constrained('users');
            $table->foreignId('id_usuario_receptor')->constrained('users');
            $table->foreignId('id_objeto_emisor')->constrained('objetos');
            $table->foreignId('id_objeto_receptor')->nullable()->constrained('objetos');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('intercambios');
    }
};
