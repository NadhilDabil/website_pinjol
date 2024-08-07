<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'dummy',
                'email' => 'dummy@gmail.com',
                'password' => Hash::make('dummy123'),
                'role' => 'nasabah',
                'email_verified_at' => Carbon::now(),
                'tanggal_pembuatan' => Carbon::now(),
            ],
            [
                'name' => 'nasabah',
                'email' => 'nasabah@gmail.com',
                'password' => Hash::make('nasabah123'),
                'role' => 'nasabah',
                'email_verified_at' => Carbon::now(),
                'tanggal_pembuatan' => Carbon::now(),
            ],

            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => Carbon::now(),
                'tanggal_pembuatan' => Carbon::now(),
            ],








        ]);
    }
}
