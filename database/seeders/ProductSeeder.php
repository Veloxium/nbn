<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Jaket Crop Furry Faux Fur',
            'price' => 130000,
            'image' => 'jaket.jpg',
            'colors' => ['#FF69B4', '#ADD8E6', '#F5F5DC'], // ← JANGAN pakai json_encode
        ]);        
    }
}
