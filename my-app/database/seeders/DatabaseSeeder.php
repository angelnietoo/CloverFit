<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuarios de prueba
        User::factory(10)->create();
        
        User::factory()->create([
            'name' => 'Admin CloverFit',
            'email' => 'admin@cloverfit.com',
            'role' => 'admin',
        ]);

        // Ejecutar seeders en orden
        $this->call([
            TrainerSeeder::class,
            MembershipSeeder::class,
            ClassesSeeder::class,
            ClassScheduleSeeder::class,
            MembersSeeder::class,
            ActivitiesSeeder::class,
            PaymentSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
