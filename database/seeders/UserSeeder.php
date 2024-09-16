<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $institutionalIds = [1, 2, 3, 4, 5]; // IDs de las instituciones creadas anteriormente
        $roleIds = [3, 4]; // IDs de los roles permitidos
        $password = 'patoro123';
        for ($i = 1; $i <= 15; $i++) {
            DB::table('users')->insert([
                'userId' => 202408170 + $i,
                'username' => 'user' . $i,
                'name' => 'Usuario ' . $i,
                'email' => 'user' . $i . '@gmail.com',
                'password' => Hash::make($password),
                'role_id' => $roleIds[array_rand($roleIds)], // Selecciona un rol al azar de la lista
                'institutionalId' => $institutionalIds[array_rand($institutionalIds)], // Selecciona una institución al azar de la lista
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
