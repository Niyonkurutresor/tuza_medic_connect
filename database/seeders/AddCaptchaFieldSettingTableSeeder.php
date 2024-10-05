<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class AddCaptchaFieldSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create(['key' => 'recaptcha', 'value' => '0']);
        Setting::create(['key' => 'googleCaptchaKey', 'value' => '']);
        Setting::create(['key' => 'googleCaptchaSecret', 'value' => '']);
    }
}
