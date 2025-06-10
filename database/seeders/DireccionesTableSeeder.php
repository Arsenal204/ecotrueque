<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Direccion;
use App\Models\User;

class DireccionesTableSeeder extends Seeder
{
    public function run()
    {
        Direccion::truncate();

        $usuarios = User::all();

        $calles = [
            'Calle Central 1',
            'Calle Donaciones 22',
            'Calle Verde 10',
            'Av. Ayuda 7',
            'Calle Esperanza 5',
        ];

        $ciudades = [
            'Madrid',
            'Valencia',
            'Sevilla',
            'Bilbao',
            'Barcelona',
        ];

        $provincias = [
            'Madrid',
            'Valencia',
            'Sevilla',
            'Bizkaia',
            'Barcelona',
        ];

        $codigos_postales = [
            '28001',
            '46001',
            '41001',
            '48001',
            '08001',
        ];

        foreach ($usuarios as $index => $usuario) {
            Direccion::create([
                'calle' => $calles[$index % count($calles)],
                'ciudad' => $ciudades[$index % count($ciudades)],
                'provincia' => $provincias[$index % count($provincias)],
                'codigo_postal' => $codigos_postales[$index % count($codigos_postales)],
                'id_usuario' => $usuario->id,
            ]);
        }
    }
}
