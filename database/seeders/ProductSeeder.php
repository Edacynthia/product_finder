<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Ensure categories and marketers exist
        $categories = Category::all();
        $marketers = User::role('marketer')->get();

        if ($categories->isEmpty()) {
            throw new \Exception('No categories found. Please seed categories first.');
        }
        if ($marketers->isEmpty()) {
            throw new \Exception('No marketer users found. Please seed users first.');
        }

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            Product::create([
                'name' => $faker->words(3, true),
                'description' => $faker->paragraph,
                'price' => $faker->randomFloat(2, 5, 500),
                'category_id' => $categories->random()->id,
                'user_id' => $marketers->random()->id,
                'whatsapp_link' => $faker->boolean(70) ? 'https://wa.me/' . $faker->numerify('+234##########') : null,
                'instagram_handle' => $faker->boolean(70) ? '@' . $faker->userName : null,
                'image_path' => 'products/placeholder.jpg', // Optional: Add fake image paths
            ]);
        }
    }
}