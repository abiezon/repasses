<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'description' => 'Administrador'
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'full_name' => 'Administrador',
            'email' => 'admin@nucleomg.com.br',
            'password' => Hash::make('password'),
            'status' => true,
            'birth_date' => '1980-01-01',
            'role_id' => 1
        ]);        
    }
}
