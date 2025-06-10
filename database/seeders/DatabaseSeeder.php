<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call([
            UsersTableSeeder::class,
            DireccionesTableSeeder::class,
            CategoriasTableSeeder::class,
            ObjetosTableSeeder::class,
            IntercambiosTableSeeder::class,
            MensajesTableSeeder::class,
            ValoracionesTableSeeder::class,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
