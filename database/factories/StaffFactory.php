<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->word(),
            'last_name' => $this->faker->word(),
            'email' => $this->faker->word(),
            'phone_number' => $this->faker->word(),
            'password' => $this->faker->word(),
            'gender' => $this->faker->word(),
            'role' => $this->faker->word(),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}
