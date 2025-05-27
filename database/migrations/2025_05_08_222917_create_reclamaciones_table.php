<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reclamaciones', function (Blueprint $table) {
            $table->id();
            $table->string('motivo');
            $table->text('descripcion')->nullable();
            $table->date('fecha_reclamacion')->default(DB::raw('CURRENT_DATE'));
            $table->enum('estado_reclamacion', ['pendiente', 'en revisión', 'resuelta', 'rechazada']);
            $table->foreignId('id_usuario_emisor')->constrained('users');
            $table->foreignId('id_usuario_reclamado')->constrained('users');
            $table->foreignId('id_intercambio')->nullable()->constrained('intercambios');
            $table->string('ruta_imagen')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reclamaciones');
    }
};
