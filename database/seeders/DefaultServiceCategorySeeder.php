<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class DefaultServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $input = [
            [
                'name' => 'Dentist',
            ],
            [
                'name' => 'Dieticians',
            ],
            [
                'name' => 'General Physicians',
            ],
            [
                'name' => 'Gynecologists',
            ],
            [
                'name' => 'physiotherapy',
            ],
            [
                'name' => 'Psychologist',
            ],
        ];

        foreach ($input as $data) {
            ServiceCategory::create($data);
        }
    }
}
