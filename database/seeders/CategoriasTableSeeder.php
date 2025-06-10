<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasTableSeeder extends Seeder
{
    public function run()
    {
        Categoria::truncate();

        $categorias = [
            [
                'nombre_categoria' => 'Muebles',
                'descripcion_categoria' => 'Sillas, mesas, estanterías y otros muebles del hogar.'
            ],
            [
                'nombre_categoria' => 'Electrodomésticos',
                'descripcion_categoria' => 'Artículos eléctricos como microondas, lavadoras o cafeteras.'
            ],
            [
                'nombre_categoria' => 'Transporte',
                'descripcion_categoria' => 'Bicicletas, patinetes y otros medios de transporte personales.'
            ],
            [
                'nombre_categoria' => 'Tecnología',
                'descripcion_categoria' => 'Televisores, ventiladores, y productos electrónicos.'
            ],
            [
                'nombre_categoria' => 'Ropa y Calzado',
                'descripcion_categoria' => 'Prendas de vestir y calzado en buen estado.'
            ],
            [
                'nombre_categoria' => 'Libros y Papelería',
                'descripcion_categoria' => 'Libros, cuadernos, material de oficina y escolar.'
            ],
            [
                'nombre_categoria' => 'Herramientas',
                'descripcion_categoria' => 'Herramientas manuales, eléctricas y cajas de herramientas.'
            ],
            [
                'nombre_categoria' => 'Hogar y Cocina',
                'descripcion_categoria' => 'Sartenes, lámparas y otros objetos del hogar.'
            ]
        ];

        foreach ($categorias as $cat) {
            Categoria::create($cat);
        }
    }
}
