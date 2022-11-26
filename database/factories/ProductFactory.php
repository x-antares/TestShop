<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        $slug = str_slug($name, '-');
        $price = $this->faker->numberBetween($min = 50, $max = 1000);

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => $this->faker->text(50),
            'price' => $price,
        ];
    }
}
