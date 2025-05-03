<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\BookOrder;
use App\Models\Order;
use App\Models\ShippingArea;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => fake()->unique()->numerify('ORD-####'),
            'shipping_fee' => fake()->randomFloat(2, 5, 100),
            'books_total' => fake()->randomFloat(2, 10, 500),
            'total' => fake()->randomFloat(2, 50, 1000),
            'status' => fake()->randomElement(['confirmed','delivered','pending']),
            'payment_status' => fake()->randomElement(['unpaid','paid','refunded']),
            'payment_type' => fake()->randomElement(['cash','visa']),
            'tax_amount' => fake()->randomFloat(2, 0, 50),
            'transaction_reference' => fake()->unique()->bothify('Ref-####??##'),
            'address' => fake()->address(),
            'shipping_area_id' => ShippingArea::inRandomOrder()->first()?->id ?? ShippingArea::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
        ];
    }

    public function withBooks()
    {
        return $this->afterCreating(function (Order $order) {
            $books = Book::inRandomOrder()->limit(rand(1, 5))->get();
            foreach ($books as $book) {
                BookOrder::create([
                    'order_id' => $order->id,
                    'book_id' => $book->id,
                    'price' => $book->price ?? fake()->randomFloat(2, 5, 50),
                    'quantity' => rand(1, 5),
                ]);
            }
        });
    }

    public function previousWeeks($weeks = 0): static
    {
        return $this->state(fn () => ['created_at' => Carbon::now()->subWeeks($weeks)]);
    }
    public function previousMonths($months = 0): static
    {
        return $this->state(fn () => ['created_at' => Carbon::now()->subMonths($months)]);
    }
    public function previousYears($years = 0): static
    {
        return $this->state(fn () => ['created_at' => Carbon::now()->subYear($years)]);
    }
}
