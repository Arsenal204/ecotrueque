<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('objetos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->string('estado');
            $table->date('fecha_publicacion')->nullable();
            $table->enum('tipo_oferta', ['donación', 'trueque']);
            $table->foreignId('usuario')->constrained('users');
            $table->foreignId('categoria')->constrained('categorias');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('objetos');
    }
};
