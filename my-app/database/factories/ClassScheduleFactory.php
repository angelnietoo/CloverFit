<?php

namespace Database\Factories;

use App\Models\ClassSchedule;
use App\Models\Classes;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassScheduleFactory extends Factory
{
    protected $model = ClassSchedule::class;

    public function definition(): array
    {
        $days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        $locations = ['Sala 1', 'Sala 2', 'Sala 3', 'Exterior', 'Piscina'];

        $startHour = $this->faker->randomElement(['06', '09', '10', '14', '17', '18']);
        $startTime = sprintf('%s:%s:00', $startHour, $this->faker->randomElement(['00', '30']));
        $endHour = (int)$startHour + $this->faker->numberBetween(1, 2);
        $endTime = sprintf('%02d:%s:00', $endHour, $this->faker->randomElement(['00', '30']));

        return [
            'class_id' => Classes::factory(),
            'day_of_week' => $this->faker->randomElement($days),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'location' => $this->faker->randomElement($locations),
        ];
    }
}
