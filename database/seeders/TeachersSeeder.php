<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = 'patoro123';
        DB::table('teachers')->insert([
            [
                'teacherId' => 202408170,
                'teacherUser' => 'magachate',
                'role_id' => 2,
                'name' => 'Marcelo Agachate Pomapelo',
                'email' => 'marcelo@gmail.com',
                'password' => Hash::make($password),
            ],
            [
                'teacherId' => 202408171,
                'teacherUser' => 'jrodriguez',
                'role_id' => 2,
                'name' => 'Juan Rodriguez',
                'email' => 'jrodriguez@gmail.com',
                'password' => Hash::make($password),
            ],
            [
                'teacherId' => 202408172,
                'teacherUser' => 'mperez',
                'role_id' => 2,
                'name' => 'Maria Perez',
                'email' => 'mperez@gmail.com',
                'password' => Hash::make($password),
            ],
            [
                'teacherId' => 202408173,
                'teacherUser' => 'cgomez',
                'role_id' => 2,
                'name' => 'Carlos Gomez',
                'email' => 'cgomez@gmail.com',
                'password' => Hash::make($password),
            ],
            [
                'teacherId' => 202408174,
                'teacherUser' => 'lramirez',
                'role_id' => 2,
                'name' => 'Luisa Ramirez',
                'email' => 'lramirez@gmail.com',
                'password' => Hash::make($password),
            ],
            [
                'teacherId' => 202408175,
                'teacherUser' => 'jtorres',
                'role_id' => 2,
                'name' => 'Javier Torres',
                'email' => 'jtorres@gmail.com',
                'password' => Hash::make($password),
            ],
        ]);
    }
}
