<?php

namespace Database\Factories\sktop\naxum\task2\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DisplayOrders>
 */
class DisplayOrdersFactory extends Factory

{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'invoice_number' => Str::random(5),
            'Purchaser' => fake()->name(),
            'distributor' => fake()->name(),
            'referred_number' => fake()->unique()->safeEmail(),
            'order_date' => fake()->date(),
            'percentage' => Str::random(10),
            'commission' => Str::random(10) . " " . Str::random(10),
        ];
    }
}
