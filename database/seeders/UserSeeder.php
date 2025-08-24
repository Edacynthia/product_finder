<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MarketerProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        // Create 9 additional marketers (PermissionSeeder creates 1)
        for ($i = 0; $i < 9; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
            ]);

            $user->assignRole('marketer');

            MarketerProfile::create([
                'user_id' => $user->id,
                'type' => $faker->randomElement(['individual', 'company']),
                'location' => $faker->city,
                'description' => $faker->sentence,
                'contact_phone' => $faker->phoneNumber,
                'contact_email' => $faker->safeEmail,
                'website' => $faker->url,
                'image_path' => null, // Optional: Add fake image paths
            ]);
        }
    }
}