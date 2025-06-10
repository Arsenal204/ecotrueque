<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Intercambio;
use App\Models\User;
use App\Models\Objeto;
use Illuminate\Support\Facades\DB;

class IntercambiosTableSeeder extends Seeder
{
    public function run()
    {
        Intercambio::truncate();

        // Obtenemos todos los usuarios y objetos
        $usuarios = User::all();
        $objetos = Objeto::all();

        // Generamos hasta 5 intercambios entre usuarios distintos
        $intercambiosCreados = 0;

        for ($i = 0; $i < $usuarios->count(); $i++) {
            for ($j = $i + 1; $j < $usuarios->count(); $j++) {
                if ($intercambiosCreados >= 5) break;

                $emisor = $usuarios[$i];
                $receptor = $usuarios[$j];

                $objEmisor = $objetos->where('usuario', $emisor->id)->first();
                $objReceptor = $objetos->where('usuario', $receptor->id)->first();

                if ($objEmisor && $objReceptor) {
                    Intercambio::create([
                        'fecha' => now()->subDays(rand(1, 30)),
                        'estado' => ['pendiente', 'confirmado', 'entregado', 'cancelado'][rand(0, 3)],
                        'id_usuario_emisor' => $emisor->id,
                        'id_usuario_receptor' => $receptor->id,
                        'id_objeto_emisor' => $objEmisor->id,
                        'id_objeto_receptor' => $objReceptor->id,
                    ]);
                    $intercambiosCreados++;
                }
            }
        }
    }
}
