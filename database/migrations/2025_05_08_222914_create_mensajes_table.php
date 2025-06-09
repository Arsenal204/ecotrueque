<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->text('contenido');
            $table->dateTime('fecha_envio');
            $table->foreignId('id_emisor')->constrained('users');
            $table->foreignId('id_receptor')->constrained('users');
            $table->foreignId('id_intercambio')->nullable()->constrained('intercambios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};
