<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('valoraciones', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('puntuacion')->unsigned();
            $table->text('comentario')->nullable();
            $table->foreignId('id_intercambio')->constrained('intercambios');
            $table->foreignId('id_usuario_valorado')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_valorador')->constrained('users')->onDelete('cascade');


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('valoraciones');
    }
};
