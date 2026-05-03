<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil seeder untuk Admin, Kategori, dan Produk Olahraga
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class, // <-- Diaktifkan agar produk Padel dll masuk ke database
        ]);
    }
}