<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Intercambio extends Model
{
    use HasFactory;


    protected $fillable = ['fecha', 'estado', 'usuario_emisor', 'usuario_receptor', 'objeto_emisor', 'objeto_receptor'];
}
