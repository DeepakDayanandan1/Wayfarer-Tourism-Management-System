<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'FullName' => fake()->name(),
            'MobileNumber' => fake()->numerify('##########'),
            'EmailId' => fake()->unique()->safeEmail(),
            'Password' => Hash::make('password'),
        ];
    }
}

