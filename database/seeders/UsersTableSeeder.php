<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::truncate();

        User::create([
            'name' => 'Admin EcoTrueque',
            'email' => 'admin@ecotrueque.com',
            'password' => Hash::make('admin123'),
            'tipo_usuario' => 'admin',
            'direccion' => 'Calle Central 1',
            'ciudad' => 'Madrid',
            'telefono' => '600000001',
            'baneado' => 0,
        ]);

        User::create([
            'name' => 'Carlos Donador',
            'email' => 'carlos@ecotrueque.com',
            'password' => Hash::make('donador123'),
            'tipo_usuario' => 'receptor',
            'direccion' => 'Calle Donaciones 22',
            'ciudad' => 'Valencia',
            'telefono' => '600000002',
            'baneado' => 0,
        ]);

        User::create([
            'name' => 'María Donadora',
            'email' => 'maria@ecotrueque.com',
            'password' => Hash::make('donadora123'),
            'tipo_usuario' => 'receptor',
            'direccion' => 'Calle Verde 10',
            'ciudad' => 'Sevilla',
            'telefono' => '600000003',
            'baneado' => 0,
        ]);

        User::create([
            'name' => 'Luis Receptor',
            'email' => 'luis@ecotrueque.com',
            'password' => Hash::make('receptor123'),
            'tipo_usuario' => 'receptor',
            'direccion' => 'Av. Ayuda 7',
            'ciudad' => 'Bilbao',
            'telefono' => '600000004',
            'baneado' => 0,
        ]);

        User::create([
            'name' => 'Ana Receptora',
            'email' => 'ana@ecotrueque.com',
            'password' => Hash::make('receptora123'),
            'tipo_usuario' => 'receptor',
            'direccion' => 'Calle Esperanza 5',
            'ciudad' => 'Barcelona',
            'telefono' => '600000005',
            'baneado' => 0,
        ]);
    }
}
