<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\members;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition(): array
    {
        $types = ['Clase', 'Entrenamiento Personal', 'Evento'];
        $statuses = ['scheduled', 'completed', 'cancelled'];

        return [
            'member_id' => members::factory(),
            'type' => $this->faker->randomElement($types),
            'description' => $this->faker->paragraph(),
            'activity_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'status' => $this->faker->randomElement($statuses),
            'duration_minutes' => $this->faker->randomElement([30, 45, 60, 90]),
        ];
    }
}
