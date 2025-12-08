<?php
// database/factories/OrderFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_number' => 'CMD' . now()->format('Ymd') . strtoupper($this->faker->lexify('??????')),
            'user_id' => User::factory(),
            'customer_email' => $this->faker->email(),
            'customer_firstname' => $this->faker->firstName(),
            'customer_lastname' => $this->faker->lastName(),
            'customer_phone' => $this->faker->phoneNumber(),
            'shipping_address' => $this->faker->address(),
            'shipping_city' => $this->faker->city(),
            'billing_address' => $this->faker->address(),
            'billing_city' => $this->faker->city(),
            'subtotal' => $amount = $this->faker->numberBetween(1000, 50000),
            'tax_amount' => $amount * 0.18,
            'shipping_cost' => $this->faker->numberBetween(500, 5000),
            'discount_amount' => $this->faker->numberBetween(0, 5000),
            'total' => fn (array $attributes) => 
                $attributes['subtotal'] + 
                $attributes['tax_amount'] + 
                $attributes['shipping_cost'] - 
                $attributes['discount_amount'],
            'status' => $this->faker->randomElement(['pending', 'paid', 'processing', 'shipped']),
            'items' => json_encode([
                [
                    'product_id' => 1,
                    'name' => $this->faker->word(),
                    'quantity' => $this->faker->numberBetween(1, 5),
                    'price' => $this->faker->numberBetween(1000, 10000),
                    'total' => $this->faker->numberBetween(1000, 50000),
                ]
            ]),
            'notes' => $this->faker->optional()->sentence(),
            'paid_at' => $this->faker->optional()->dateTime(),
        ];
    }
}