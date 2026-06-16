<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Seed default site settings (structural placeholders only — no real data).
     * All values can be updated via Admin → Settings.
     */
    public function run(): void
    {
        $defaults = [
            'site_name'         => '',   // e.g. ELD Solutions Ltd
            'tagline'           => '',   // e.g. Delivering Excellence Across Every Project
            'phone'             => '',   // e.g. +233 XX XXX XXXX
            'email'             => '',   // e.g. info@eldsolutions.com
            'address'           => '',   // e.g. Accra, Ghana
            'admin_email'       => '',   // receives contact form notifications
            'linkedin'          => '',
            'twitter'           => '',
            'facebook'          => '',
            'google_maps_embed' => '',
            'footer_text'       => '',   // e.g. All rights reserved.
        ];

        foreach ($defaults as $key => $value) {
            Setting::firstOrCreate(['key' => $key], ['value' => $value]);
        }

        $this->command->info('Default settings seeded. Update them at Admin → Settings.');
    }
}
