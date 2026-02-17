<?php

namespace Database\Factories;

use App\Models\members;
use App\Models\User;
use App\Models\Membership;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\members>
 */
class MembersFactory extends Factory
{
    protected $model = members::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'membership_id' => Membership::factory(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'notes' => $this->faker->optional()->paragraph(),
            'membership_start_date' => $this->faker->dateTimeBetween('-6 months'),
            'membership_end_date' => $this->faker->dateTimeBetween('now', '+6 months'),
            'is_active' => true,
        ];
    }
}
