<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'email' => 'info@skillshub.com',
            'phone' => '002-011-2337-6466',
            'facebook' => 'https://www.facebook.com',
            'twitter' => 'https://www.twitter.com',
            'instagram' => 'https://www.instagram.com',
            'youtube' => 'https://www.youtube.com',
            'linkedin' => 'https://www.linkedin.com',
        ]);
    }
}
