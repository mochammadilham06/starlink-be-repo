<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "uuid"=>Uuid::uuid4()->toString(),
            "name"=>fake()->name(),
            "images"=>fake()->imageUrl(),
            "purchase_price"=>fake()->numberBetween(1000,50000),
            "selling_price" => fake()->numberBetween(1000, 50000),
            "stock"=> fake()->numberBetween(0, 100)
        ];
    }
}
