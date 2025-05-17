<?php

namespace Database\Factories;

use App\Enum\InteractionTypsEnum;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookInteraction>
 */
class BookInteractionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first(),
            'book_id' => Book::inRandomOrder()->first(),
            'quantity' => random_int(1, 15),
            'interaction_type' => fake()->randomElement(InteractionTypsEnum::cases()),
        ];
    }
}
