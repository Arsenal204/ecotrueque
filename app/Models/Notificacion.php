<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notificacion extends Model
{
    use HasFactory;


    protected $fillable = ['contenido', 'fecha_envio', 'leido', 'usuario_receptor'];
}
