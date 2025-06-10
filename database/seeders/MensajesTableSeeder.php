<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mensaje;
use App\Models\Intercambio;

class MensajesTableSeeder extends Seeder
{
    public function run()
    {
        Mensaje::truncate();

        $intercambios = Intercambio::all();

        foreach ($intercambios as $intercambio) {
            Mensaje::create([
                'contenido' => 'Hola, ¿cuándo podríamos hacer el intercambio?',
                'id_emisor' => $intercambio->id_usuario_emisor,
                'id_receptor' => $intercambio->id_usuario_receptor,
                'id_intercambio' => $intercambio->id,
            ]);

            Mensaje::create([
                'contenido' => 'Perfecto, ¿te va bien esta semana?',
                'id_emisor' => $intercambio->id_usuario_receptor,
                'id_receptor' => $intercambio->id_usuario_emisor,
                'id_intercambio' => $intercambio->id,
            ]);
        }
    }
}
