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
            'teacherId' => 202408170,
            'teacherUser' => 'magachate',
            'name' => 'Marcelo Agachate Pomapelo',
            'email' => 'marcelo@gmail.com',
            'password' => Hash::make($password),
        ]);
    }
}
