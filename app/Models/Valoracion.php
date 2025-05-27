<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    use HasFactory;
    protected $table = 'valoraciones';


    protected $fillable = ['id_usuario_valorado', 'id_valorador', 'puntuacion', 'comentario', 'id_intercambio'];

    public function valorador()
    {
        return $this->belongsTo(User::class, 'id_valorador');
    }

    public function valorado()
    {
        return $this->belongsTo(User::class, 'id_usuario_valorado');
    }
}
