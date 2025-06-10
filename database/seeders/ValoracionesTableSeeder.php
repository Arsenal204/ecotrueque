<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Valoracion;
use App\Models\Intercambio;

class ValoracionesTableSeeder extends Seeder
{
    public function run()
    {
        Valoracion::truncate();

        $intercambiosConfirmados = Intercambio::where('estado', 'confirmado')->get();

        foreach ($intercambiosConfirmados as $intercambio) {
            // Emisor valora al receptor
            Valoracion::create([
                'puntuacion' => rand(3, 5),
                'comentario' => 'Buena experiencia, todo ha ido bien.',
                'id_intercambio' => $intercambio->id,
                'id_usuario_valorado' => $intercambio->id_usuario_receptor,
                'id_valorador' => $intercambio->id_usuario_emisor,
            ]);

            // Receptor valora al emisor
            Valoracion::create([
                'puntuacion' => rand(3, 5),
                'comentario' => 'Intercambio satisfactorio, repetiría.',
                'id_intercambio' => $intercambio->id,
                'id_usuario_valorado' => $intercambio->id_usuario_emisor,
                'id_valorador' => $intercambio->id_usuario_receptor,
            ]);
        }
    }
}
