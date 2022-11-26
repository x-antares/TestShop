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
        $data = [];
        $gender = $this->faker->randomElement(['male', 'female']);
        $products = Product::take(80)->get()->random(40);

        foreach ($products as $key => $product) {
           $data['products'][$key]['id'] = $product->id;
           $data['products'][$key]['slug'] = $product->slug;
           $data['products'][$key]['name'] = $product->name;
           $data['products'][$key]['price'] = $product->price;
        }

        return [
            'first_name' => $this->faker->name($gender),
            'city' => $this->faker->city(),
            'phone' => $this->faker->phoneNumber(),
            'data' => $data,
        ];
    }
}
