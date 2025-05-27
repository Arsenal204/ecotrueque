<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reclamacion extends Model
{
    use HasFactory;

    protected $table = 'reclamaciones';

    protected $casts = [
        'fecha_reclamacion' => 'datetime',
    ];


    protected $fillable = [
        'motivo',
        'descripcion',
        'estado_reclamacion',
        'fecha_reclamacion',
        'id_usuario_emisor',
        'id_usuario_reclamado',
        'id_intercambio',
        'ruta_imagen'
    ];


    public function emisor()
    {
        return $this->belongsTo(User::class, 'id_usuario_emisor');
    }

    public function reclamado()
    {
        return $this->belongsTo(User::class, 'id_usuario_reclamado');
    }

    public function intercambio()
    {
        return $this->belongsTo(Intercambio::class, 'id_intercambio');
    }
    public function usuarioEmisor()
    {
        return $this->belongsTo(User::class, 'id_usuario_emisor');
    }

    public function usuarioReclamado()
    {
        return $this->belongsTo(User::class, 'id_usuario_reclamado');
    }
}
