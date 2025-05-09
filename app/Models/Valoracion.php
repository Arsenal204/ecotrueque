<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Valoracion extends Model
{
    use HasFactory;


    protected $fillable = ['puntuacion', 'comentario', 'intercambio', 'usuario_valorado'];
}
