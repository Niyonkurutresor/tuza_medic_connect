<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class AddFrontSliderSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inputs = [
            [
                'key' => 'about_us_image',
                'value' => ('assets/front/demos/covid-care/images/page-title/about.jpg'),
            ],
            [
                'key' => 'service_image',
                'value' => ('assets/front/demos/covid-care/images/page-title/services.jpg'),
            ],
            [
                'key' => 'contact_image',
                'value' => ('assets/front/demos/covid-care/images/page-title/contact.jpg'),
            ],
        ];

        foreach ($inputs as $input) {
            Setting::create($input);
        }
    }
}
