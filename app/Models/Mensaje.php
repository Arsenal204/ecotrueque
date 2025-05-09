<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mensaje extends Model
{
    use HasFactory;


    protected $fillable = ['contenido', 'fecha_envio', 'emisor', 'receptor', 'intercambio'];
}
