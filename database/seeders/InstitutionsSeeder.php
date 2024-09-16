<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('educational_institutions')->insert([
            [
                'institutionalId' => 1,
                'name' => 'Semenor',
                'address' => 'Avkevinpepe',
                'city' => 'Manizales',
                'country' => 'Colombia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'institutionalId' => 2,
                'name' => 'Instituto Pegasus',
                'address' => 'Calle 123',
                'city' => 'Bogotá',
                'country' => 'Colombia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'institutionalId' => 3,
                'name' => 'Colegio Phoenix',
                'address' => 'Avenida 456',
                'city' => 'Medellín',
                'country' => 'Colombia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'institutionalId' => 4,
                'name' => 'Universidad Centauro',
                'address' => 'Carrera 789',
                'city' => 'Cali',
                'country' => 'Colombia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'institutionalId' => 5,
                'name' => 'Escuela Unicornio',
                'address' => 'Transversal 012',
                'city' => 'Barranquilla',
                'country' => 'Colombia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
