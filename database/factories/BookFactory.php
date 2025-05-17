<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => [
                'en' => fake()->unique()->name(),
                'ar' => fake()->unique()->name(),
            ],
            'description' => [
                'en' => fake()->unique()->sentence(),
                'ar' => fake()->unique()->sentence(),
            ],
            'quantity' => fake()->numberBetween(1, 1000),
            'rate' => fake()->numberBetween(1, 100),
            'publish_year' => fake()->dateTime()->format('Y'),
            'price' => fake()->randomDigit(),
            'is_available' => true,
            'category_id' => Category::factory()->create(),
            'publisher_id' => Publisher::factory()->create(),
            'author_id' => Author::factory()->create(),
        ];
    }
}
