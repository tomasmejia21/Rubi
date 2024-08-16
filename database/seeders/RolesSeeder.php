<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'Administrator',
                'label' => 'Administrator',
                'description' => 'Full access to all system features and settings.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Teacher',
                'label' => 'Educator',
                'description' => 'Access to create and manage educational content.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'In-Learning-Teacher',
                'label' => 'Apprentice Educator',
                'description' => 'In training to teach accessibility.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'In-Learning-Developer',
                'label' => 'Apprentice Developer',
                'description' => 'In training to develop accessibility features.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
