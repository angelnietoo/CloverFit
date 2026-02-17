<?php

namespace Database\Factories;

use App\Models\Trainer;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainerFactory extends Factory
{
    protected $model = Trainer::class;

    public function definition(): array
    {
        $specializations = ['Cardio', 'Musculación', 'Flexibilidad', 'Pilates', 'CrossFit', 'Yoga'];

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'bio' => $this->faker->paragraph(),
            'specialization' => $this->faker->randomElement($specializations),
            'hourly_rate' => $this->faker->randomFloat(2, 20, 80),
            'image' => 'https://via.placeholder.com/200?text=' . urlencode('Trainer'),
            'is_active' => true,
        ];
    }
}
