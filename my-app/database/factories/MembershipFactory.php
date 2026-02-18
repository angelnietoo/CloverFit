<?php

namespace Database\Factories;

use App\Models\Membership;
use Illuminate\Database\Eloquent\Factories\Factory;

class MembershipFactory extends Factory
{
    protected $model = Membership::class;

    public function definition(): array
    {
        $names = ['Plan Básico', 'Plan Estándar', 'Plan Premium', 'Plan VIP'];

        return [
            'name' => $this->faker->randomElement($names),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 30, 150),
            'duration_months' => $this->faker->randomElement([1, 3, 6, 12]),
            'class_limit' => $this->faker->randomElement([4, 8, 16, null]),
            'includes_trainer' => $this->faker->boolean(30),
            'is_active' => true,
        ];
    }
}
