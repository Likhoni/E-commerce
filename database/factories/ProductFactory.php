<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name'=>$this->faker->name(),
            'category_id'=>$this->faker->numberBetween(1, 4),
            'product_quantity'=>$this->faker->randomDigit(100, 200),
            //'product_image' => $this->faker->imageUrl(640, 480, 'products', true, 'Faker'),
            'product_price'=>$this->faker->randomDigit(100, 1000),
            'discount'=>$this->faker->randomDigit(10, 40),
            'product_description'=>$this->faker->paragraph(1)
        ];
    }
}
