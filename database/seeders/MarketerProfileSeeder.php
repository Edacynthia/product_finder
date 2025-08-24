<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MarketerProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class MarketerProfileSeeder extends Seeder
{
    public function run()
    {
        $marketers = User::role('marketer')->get();

        if ($marketers->isEmpty()) {
            Log::error('MarketerProfileSeeder: No marketers found.');
            return;
        }

        foreach ($marketers as $marketer) {
            $isJohnMarketer = $marketer->email === 'marketer@example.com';
            MarketerProfile::firstOrCreate(
                ['user_id' => $marketer->id],
                [
                    'type' => $isJohnMarketer ? 'company' : 'individual',
                    'location' => $isJohnMarketer ? 'Abuja, Nigeria' : 'Lagos, Nigeria',
                    'description' => 'Marketer profile for ' . $marketer->name,
                    'contact_phone' => $isJohnMarketer ? '08098765432' : '08012345678',
                    'contact_email' => $marketer->email,
                    'website' => $isJohnMarketer ? 'https://johnmarketer.com' : 'https://example.com',
                    'image_path' => "marketer_images/{$marketer->id}.jpg",
                    'whatsapp_link' => 'https://wa.me/' . ($isJohnMarketer ? '2348098765432' : '2348012345678'),
                    'telegram_handle' => '@' . str_replace(' ', '', $marketer->name),
                    'instagram_handle' => '@' . str_replace(' ', '', $marketer->name),
                ]
            );
        }

        Log::info('MarketerProfileSeeder: Created profiles for ' . $marketers->count() . ' marketers.');
    }
}