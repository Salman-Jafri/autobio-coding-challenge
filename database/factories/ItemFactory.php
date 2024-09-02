<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Item::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'quantity' => $this->faker->numberBetween(1, 10),
            'order_id' => Order::factory(),
            'price' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
