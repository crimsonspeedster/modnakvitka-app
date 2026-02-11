<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
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
        $delivery_type = $this->faker->randomElement(['local_pickup', 'courier']);
        $is_recipient_address_knowing = $this->faker->boolean();
        $city = !$is_recipient_address_knowing || $delivery_type === 'local_pickup' ? null : $this->faker->randomElement(['Kyiv', 'Kyiv region']);
        $delivery_address = !$is_recipient_address_knowing || $delivery_type === 'local_pickup' ? null : $this->faker->address();

        return [
            'status' => $this->faker->randomElement(['pending_payment', 'processing', 'completed', 'canceled']),
            'total' => $this->faker->randomFloat(2, 100, 9999),
            'email' => $this->faker->unique()->safeEmail(),
            'delivery_type' => $delivery_type,
            'city' => $city,
            'customer_name' => $this->faker->name(),
            'customer_phone' => $this->faker->phoneNumber(),
            'recipient_name' => $this->faker->name(),
            'recipient_phone' => $this->faker->phoneNumber(),
            'delivery_date' => Carbon::parse($this->faker->date()),
            'delivery_time' => $this->faker->time(),
            'delivery_address' => $delivery_address,
            'is_recipient_address_knowing' => $is_recipient_address_knowing,
            'text_in_postcard' => $this->faker->text(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Order $order) {
            $products = Product::inRandomOrder()->take(rand(1, 5))->get();

            foreach ($products as $product) {
                OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'price' => $product->price,
                ]);
            }

            $order->update([
                'total' => $order->items->sum(fn($i) => $i->price * $i->quantity),
            ]);
        });
    }
}
