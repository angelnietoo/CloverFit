<?php

namespace Database\Factories;

use App\Models\Classes;
use App\Models\Trainer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassesFactory extends Factory
{
    protected $model = Classes::class;

    public function definition(): array
    {
        $levels = ['Principiante', 'Intermedio', 'Avanzado'];

        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'trainer_id' => Trainer::factory(),
            'level' => $this->faker->randomElement($levels),
            'max_members' => $this->faker->numberBetween(5, 30),
            'image' => 'https://via.placeholder.com/400?text=' . urlencode('Class'),
            'is_active' => true,
        ];
    }
}
