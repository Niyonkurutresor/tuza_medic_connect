<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class AddTwoFieldsSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create(['key' => 'about_title', 'value' => 'What We do Actually']);
        Setting::create(['key' => 'about_short_description',
            'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur necessitatibus placeat numquam enim adipisci nostrum facilis distinctio modi, cupiditate laborum ea eius repellendus? Obcaecati saepe numquam pariatur aliquid, aspernatur necessitatibus dolores harum quos eum esse, laudantium odit alias, iste dolorem!',
        ]);
    }
}
