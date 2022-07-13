<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            "price" => rand(100000, 1000000),
            "description" => $this->faker->text(50),
            "ingredients" => implode(",", $this->faker->words(4)),
            "img" => "",
            "cateId" => rand(1, 3)
        ];
    }
}
