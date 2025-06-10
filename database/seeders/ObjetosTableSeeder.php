<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Objeto;
use App\Models\User;
use App\Models\Categoria;

class ObjetosTableSeeder extends Seeder
{
    public function run()
    {
        Objeto::truncate();

        $nombresObjetos = [
            ['titulo' => 'Silla de madera', 'descripcion' => 'Silla de comedor en buen estado, ideal para cocina o salón.'],
            ['titulo' => 'Mesa plegable', 'descripcion' => 'Mesa plegable perfecta para espacios pequeños o picnics.'],
            ['titulo' => 'Microondas Samsung', 'descripcion' => 'Microondas en funcionamiento, con señales de uso.'],
            ['titulo' => 'Bicicleta de montaña', 'descripcion' => 'Bicicleta en buen estado, ideal para rutas urbanas o de campo.'],
            ['titulo' => 'Lavadora usada', 'descripcion' => 'Lavadora con 5 años de uso, funcionando correctamente.'],
            ['titulo' => 'Cafetera italiana', 'descripcion' => 'Cafetera de aluminio para 3 tazas, apenas usada.'],
            ['titulo' => 'Estantería blanca', 'descripcion' => 'Estantería IKEA, blanca, con cuatro niveles.'],
            ['titulo' => 'TV de 32 pulgadas', 'descripcion' => 'Televisor LED, funciona bien pero sin mando a distancia.'],
            ['titulo' => 'Lámpara de pie', 'descripcion' => 'Lámpara moderna con luz cálida, ideal para salón.'],
            ['titulo' => 'Juego de sartenes', 'descripcion' => 'Set de 3 sartenes antiadherentes, poco uso.'],
            ['titulo' => 'Ventilador de torre', 'descripcion' => 'Ventilador vertical, silencioso y potente.'],
            ['titulo' => 'Zapatillas deportivas', 'descripcion' => 'Zapatillas talla 42 en buen estado, poco uso.'],
            ['titulo' => 'Chaqueta de cuero', 'descripcion' => 'Chaqueta negra, talla M, con algo de desgaste.'],
            ['titulo' => 'Pila de libros', 'descripcion' => '3 libros variados de novela y ensayo.'],
            ['titulo' => 'Caja de herramientas', 'descripcion' => 'Caja metálica con martillo, destornilladores y más.'],
        ];

        $categorias = Categoria::pluck('id')->toArray();
        $usuarios = User::all();

        $index = 0;
        foreach ($usuarios as $usuario) {
            for ($i = 0; $i < 3; $i++) {
                $objeto = $nombresObjetos[$index];

                Objeto::create([
                    'titulo' => $objeto['titulo'],
                    'descripcion' => $objeto['descripcion'],
                    'estado' => 'usado',
                    'tipo_oferta' => 'trueque',
                    'usuario' => $usuario->id,
                    'categoria' => $categorias[array_rand($categorias)],
                ]);

                $index++;
            }
        }
    }
}
