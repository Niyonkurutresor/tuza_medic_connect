<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class DefaultSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inputs = [
            [
                'title' => 'We Provide All Health Care Solution',
                'short_description' => 'Protect Your Health And Take Care To Of Your Health',
                'image' => ('assets/front/images/home/home-page-image.png'),
                'is_default' => true,
            ],
        ];

        foreach ($inputs as $input) {
            $image = $input['image'];
            unset($input['image']);
            $slider = Slider::create($input);
            //            $slider->addMediaFromUrl($image)->toMediaCollection(Slider::SLIDER_IMAGE, config('app.media_disc'));
        }
    }
}
