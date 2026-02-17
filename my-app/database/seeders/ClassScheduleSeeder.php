<?php

namespace Database\Seeders;

use App\Models\ClassSchedule;
use App\Models\Classes;
use Illuminate\Database\Seeder;

class ClassScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = Classes::all();
        
        foreach ($classes as $class) {
            ClassSchedule::factory()->count(3)->create([
                'class_id' => $class->id,
            ]);
        }
    }
}
