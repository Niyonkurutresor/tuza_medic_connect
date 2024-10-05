<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class DefaultCurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $input = [
            [
                'currency_name' => 'United states dollar',
                'currency_icon' => '$',
                'currency_code' => 'USD',
            ],
            [
                'currency_name' => 'Indian rupee',
                'currency_icon' => '₹',
                'currency_code' => 'INR',
            ],
        ];

        foreach ($input as $data) {
            Currency::create($data);
        }
    }
}
