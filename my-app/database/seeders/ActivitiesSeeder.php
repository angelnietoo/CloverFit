<?php

namespace Database\Seeders;

use App\Models\activities;
use App\Models\members;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = members::all();

        if ($members->isEmpty()) {
            $this->call(MembersSeeder::class);
            $members = members::all();
        }

        // Crear 100 actividades
        $members->each(function($member) {
            activities::factory()
                ->count(2)
                ->create(['member_id' => $member->id]);
        });
    }
}
