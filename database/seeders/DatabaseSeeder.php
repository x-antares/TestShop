<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(30)->create();
        Product::factory(100)->create();

        $categories = Category::all();

        Product::all()->each(function ($product) use ($categories) {
            $product->categories()->sync(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        Order::factory(300)->create();

        Order::take(50)->chunkById(20, function ($chunk) {
            $products = Product::inRandomOrder()->take($chunk->count())->get();

            foreach ($chunk as $order) {
                $orderProducts = [];


                foreach ($products as $product) {
                    $orderProducts[] = [
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => rand(1, 9),
                    ];
                }

                $order->orderProducts()->createMany($orderProducts);
            }
        });
    }
}
