<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;

class DefaultSpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $input = [
            [
                'name' => 'Marine Medicine',
            ],
            [
                'name' => 'Medical Genetics',
            ],
            [
                'name' => 'Microbiology',
            ],
            [
                'name' => 'Nuclear Medicine',
            ],
            [
                'name' => 'Paediatrics',
            ],
            [
                'name' => 'Palliative Medicine',
            ],
            [
                'name' => 'Pathology',
            ],
            [
                'name' => 'Pharmacology',
            ],
            [
                'name' => 'Psychiatry',
            ],
            [
                'name' => 'Physiology',
            ],
            [
                'name' => 'Physical Medicine',
            ],
            [
                'name' => 'Radiotherapy',
            ],
        ];

        foreach ($input as $data) {
            Specialization::create($data);
        }
    }
}
