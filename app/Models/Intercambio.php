<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Intercambio extends Model
{
    use HasFactory;


    protected $fillable = ['fecha', 'estado', 'id_usuario_emisor', 'id_usuario_receptor', 'id_objeto_emisor', 'id_objeto_receptor'];

    public function emisor()
    {
        return $this->belongsTo(User::class, 'id_usuario_emisor');
    }

    public function receptor()
    {
        return $this->belongsTo(User::class, 'id_usuario_receptor');
    }

    public function objetoEmisor()
    {
        return $this->belongsTo(Objeto::class, 'id_objeto_emisor');
    }

    public function objetoReceptor()
    {
        return $this->belongsTo(Objeto::class, 'id_objeto_receptor');
    }
}
