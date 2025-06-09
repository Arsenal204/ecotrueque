<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galerias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_imagen');
            $table->string('ruta_imagen');
            $table->date('fecha_subida')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignId('id_objeto')->constrained('objetos');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galerias');
    }
};
