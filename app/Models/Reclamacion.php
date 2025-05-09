<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reclamacion extends Model
{
    use HasFactory;



    protected $fillable = ['motivo', 'descripcion', 'fecha_reclamacion', 'estado_reclamacion', 'usuario_emisor', 'usuario_reclamado', 'intercambio'];
}
