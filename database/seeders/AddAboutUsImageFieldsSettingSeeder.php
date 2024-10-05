<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class AddAboutUsImageFieldsSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aboutImage1 = [
            'key' => 'about_image_1',
            'value' => ('assets/front/images/about/pic-2.jpg'),
        ];
        $image1 = $aboutImage1['value'];
        $setting1 = Setting::create($aboutImage1);
        //        $setting1->addMediaFromUrl($image1)->toMediaCollection(Setting::IMAGE, config('app.media_disc'));

        $aboutImage2 = [
            'key' => 'about_image_2',
            'value' => ('assets/front/images/about/pic-1.jpg'),
        ];
        $image2 = $aboutImage2['value'];
        $setting2 = Setting::create($aboutImage2);
        //        $setting2->addMediaFromUrl($image2)->toMediaCollection(Setting::IMAGE, config('app.media_disc'));

        $aboutImage3 = [
            'key' => 'about_image_3',
            'value' => ('assets/front/images/about/pic-3.jpg'),
        ];
        $image3 = $aboutImage3['value'];
        $setting3 = Setting::create($aboutImage3);
        //        $setting3->addMediaFromUrl($image3)->toMediaCollection(Setting::IMAGE, config('app.media_disc'));
    }
}
