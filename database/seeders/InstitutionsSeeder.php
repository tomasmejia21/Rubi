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
            ]
        ]);
    }
}
