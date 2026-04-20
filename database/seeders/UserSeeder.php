<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat akun Admin
        User::create([
            'name' => 'Lumen Admin',
            'email' => 'admin@lumen.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Lumen HQ, Jakarta',
        ]);

        // Membuat akun Customer (Pelanggan)
        User::create([
            'name' => 'Jane Doe',
            'email' => 'customer@lumen.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '089876543210',
            'address' => 'Jl. Sudirman No. 1, Jakarta Selatan',
        ]);
    }
}