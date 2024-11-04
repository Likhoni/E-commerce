<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{

    protected $model = Customer::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->unique()->firstName(),
            'last_name' => fake()->unique()->lastName(),
            'email' => fake()->unique()->email(),
            'password' => bcrypt('123456'),
            'phone_number' => fake()->phoneNumber(),
            'image' => fake()->imageUrl(640 , 480),
            'address' => fake()->unique()->address(),
            'is_email_verified' => true
        ];
    }
}
