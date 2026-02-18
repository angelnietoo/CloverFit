<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\members;
use App\Models\Classes;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = members::all();
        $classes = Classes::all();

        if ($members->isEmpty()) {
            $this->call(MembersSeeder::class);
            $members = members::all();
        }

        if ($classes->isEmpty()) {
            $this->call(ClassesSeeder::class);
            $classes = Classes::all();
        }

        // Crear reseñas únicas (un miembro solo puede dejar una reseña por clase)
        $created = 0;
        $attempts = 0;
        $max_attempts = 500;

        while ($created < 50 && $attempts < $max_attempts) {
            $member = $members->random();
            $class = $classes->random();

            // Verificar si ya existe reseña de este miembro para esta clase
            $exists = Review::where('member_id', $member->id)
                ->where('class_id', $class->id)
                ->exists();

            if (!$exists) {
                Review::create([
                    'member_id' => $member->id,
                    'class_id' => $class->id,
                    'rating' => rand(1, 5),
                    'comment' => rand(0, 1) ? fake()->paragraph() : null,
                ]);
                $created++;
            }

            $attempts++;
        }
    }
}
