<?php

namespace Database\Seeders;


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // HAPUS SEMUA DATA
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('data_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // BUAT USER ADMIN
        DB::table('data_user')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@rentcar.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'status_login' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Demo',
                'email' => 'user@rentcar.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'status_login' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}