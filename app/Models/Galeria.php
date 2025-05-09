<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Galeria extends Model
{
    use HasFactory;


    protected $fillable = ['nombre_imagen', 'ruta_imagen', 'fecha_subida', 'id_objeto'];
}
