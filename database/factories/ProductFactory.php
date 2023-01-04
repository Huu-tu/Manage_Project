<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{

    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->name(),
        ];
    }
}
