<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    use HasFactory;


    protected $fillable = ['nombre_categoria', 'descripcion_categoria'];

    public function objetos(): HasMany
    {
        return $this->hasMany(Objeto::class, 'categoria');
    }
}
