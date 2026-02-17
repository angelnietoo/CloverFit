<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\members;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        $methods = ['Tarjeta', 'Transferencia', 'Efectivo', 'PayPal'];
        $statuses = ['completed', 'pending', 'failed'];

        return [
            'member_id' => members::factory(),
            'amount' => $this->faker->randomFloat(2, 30, 200),
            'payment_method' => $this->faker->randomElement($methods),
            'status' => $this->faker->randomElement($statuses),
            'transaction_id' => 'TXN-' . $this->faker->unique()->numerify('##########'),
            'notes' => $this->faker->optional()->sentence(),
            'payment_date' => $this->faker->dateTimeBetween('-3 months'),
        ];
    }
}
