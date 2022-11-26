<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'first_name' => $this->faker->name($gender),
            'city' => $this->faker->city(),
            'phone' => $this->faker->phoneNumber()
        ];
    }
}
