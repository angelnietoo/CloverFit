<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\members;
use App\Models\Classes;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'member_id' => members::factory(),
            'class_id' => Classes::factory(),
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->optional(70)->paragraph(),
        ];
    }
}
