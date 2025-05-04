<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            ProductSeeder::class,
        ]);
    
        $user = User::first(); // pastikan user sudah ada
        $product = \App\Models\Product::first();
    
        if ($user && $product) {
            \App\Models\Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 2,
                'selected_color' => '#FF69B4',
            ]);            
        }
    }
}