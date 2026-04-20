<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $ringCategory = Category::where('slug', 'rings')->first();
        $necklaceCategory = Category::where('slug', 'necklaces')->first();

        // Produk 1: Cincin
        $product1 = Product::create([
            'category_id' => $ringCategory->id,
            'name' => 'Eternity Diamond Ring',
            'slug' => Str::slug('Eternity Diamond Ring') . '-' . time(),
            'description' => 'Cincin berlian elegan yang dibuat dengan emas 18k murni. Sangat cocok untuk momen spesial Anda.',
            'price' => 15000000, // Rp 15.000.000
            'stock' => 10,
            'is_active' => true,
            'is_featured' => true,
        ]);

        // Variant Cincin
        ProductVariant::create(['product_id' => $product1->id, 'material' => '18k Yellow Gold', 'size' => 'Size 6', 'stock' => 5]);
        ProductVariant::create(['product_id' => $product1->id, 'material' => '18k White Gold', 'size' => 'Size 7', 'stock' => 5]);

        // Produk 2: Kalung
        $product2 = Product::create([
            'category_id' => $necklaceCategory->id,
            'name' => 'Sapphire Tear Necklace',
            'slug' => Str::slug('Sapphire Tear Necklace') . '-' . time(),
            'description' => 'Kalung dengan liontin batu safir biru berbentuk tetesan air mata, dikelilingi berlian kecil yang memukau.',
            'price' => 22500000, // Rp 22.500.000
            'stock' => 5,
            'is_active' => true,
            'is_featured' => true,
        ]);

        // Variant Kalung
        ProductVariant::create(['product_id' => $product2->id, 'material' => 'Platinum', 'size' => '45 cm', 'stock' => 3]);
        ProductVariant::create(['product_id' => $product2->id, 'material' => '18k Rose Gold', 'size' => '45 cm', 'stock' => 2]);
    }
}