<?php

   namespace Database\Seeders;

   use Illuminate\Database\Seeder;
   use App\Models\Category;

   class CategorySeeder extends Seeder
   {
       public function run()
      {
        $categories = [
            'Books',
            'Electronics',
            'Clothing',
            'Services',
            'jewelries',
            'Home Appliances',
            'Sports Equipment',
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category]);
        }
    }
}