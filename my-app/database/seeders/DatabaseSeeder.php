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
        // Crear 10 usuarios con el rol 'user'
        User::factory(10)->create()->each(function ($user) {
            $user->role = 'user'; // Asignar el rol 'user' a cada usuario
            $user->save();
        });
    }
}
