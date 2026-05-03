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
        $footwearCategory = Category::where('slug', 'footwear')->first();
        $activewearCategory = Category::where('slug', 'activewear')->first();

        // Produk 1: Sepatu Lari
        $product1 = Product::create([
            'category_id' => $footwearCategory->id,
            'name' => 'AeroGlide Pro Running Shoes',
            'slug' => Str::slug('AeroGlide Pro Running Shoes') . '-' . time(),
            'description' => 'Sepatu lari berkinerja tinggi dengan material super ringan dan bantalan aerodinamis. Sangat cocok untuk marathon dan track harian Anda.',
            'price' => 2500000, // Rp 2.500.000
            'stock' => 10,
            'is_active' => true,
            'is_featured' => true,
        ]);

        // Variant Sepatu Lari
        ProductVariant::create(['product_id' => $product1->id, 'material' => 'Neon Green', 'size' => 'Size 42', 'stock' => 5]);
        ProductVariant::create(['product_id' => $product1->id, 'material' => 'Stealth Black', 'size' => 'Size 43', 'stock' => 5]);

        // Produk 2: Jaket Olahraga
        $product2 = Product::create([
            'category_id' => $activewearCategory->id,
            'name' => 'EnduroShield Windbreaker',
            'slug' => Str::slug('EnduroShield Windbreaker') . '-' . time(),
            'description' => 'Jaket olahraga tahan angin dan air dengan teknologi sirkulasi udara maksimal. Melindungi Anda di kondisi cuaca paling ekstrem.',
            'price' => 1250000, // Rp 1.250.000
            'stock' => 5,
            'is_active' => true,
            'is_featured' => true,
        ]);

        // Variant Jaket
        ProductVariant::create(['product_id' => $product2->id, 'material' => 'Navy Blue', 'size' => 'Size M', 'stock' => 3]);
        ProductVariant::create(['product_id' => $product2->id, 'material' => 'Crimson Red', 'size' => 'Size L', 'stock' => 2]);
    }
}