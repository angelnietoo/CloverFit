<?php

namespace Database\Factories;

use App\Models\activities;
use App\Models\members;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\activities>
 */
class ActivitiesFactory extends Factory
{
    protected $model = activities::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
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
