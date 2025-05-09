<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Objeto extends Model
{
    use HasFactory;



    protected $fillable = ['titulo', 'descripcion', 'estado', 'fecha_publicacion', 'tipo_oferta', 'usuario', 'categoria'];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario');
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria');
    }

    public function imagenes()
    {
        return $this->hasMany(Galeria::class, 'id_objeto');
    }
}
