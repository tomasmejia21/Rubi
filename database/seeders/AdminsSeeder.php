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
            'adminUser' => 'vtabaresm',
            'name' => 'Valentina Tabares Morales',
            'email' => 'vtabaresm@unal.edu.co',
            'password' => Hash::make($password),
        ]);
    }
}