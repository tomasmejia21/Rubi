<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 'patoro123';
        DB::table('admins')->insert([
            'adminId' => 20240816,
            'adminUser' => 'vtabares',
            'role_id' => 1,
            'name' => 'Valentina Tabares Morales',
            'email' => 'vtabaresm@unal.edu.co',
            'password' => Hash::make($password),
        ]);

        DB::table('admins')->insert([
            'adminId' => 20240915,
            'adminUser' => 'ndario',
            'role_id' => 1,
            'name' => 'Nestor Dario Duque',
            'email' => 'ndario@unal.edu.co',
            'password' => Hash::make($password),
        ]);
        
        DB::table('admins')->insert([
            'adminId' => 20240916,
            'adminUser' => 'jeduardov',
            'role_id' => 1,
            'name' => 'Jose Eduardo Villegas',
            'email' => 'jeduardov@unal.edu.co',
            'password' => Hash::make($password),
        ]);
    }
}