<?php

namespace Database\Seeders;

use App\Models\Membership;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membresías predefinidas
        $memberships = [
            [
                'name' => 'Plan Básico',
                'description' => 'Acceso a gimnasio durante horarios limitados',
                'price' => 29.99,
                'duration_months' => 1,
                'class_limit' => 4,
                'includes_trainer' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Plan Estándar',
                'description' => 'Acceso ilimitado a gimnasio y 2 clases grupales por semana',
                'price' => 49.99,
                'duration_months' => 1,
                'class_limit' => 8,
                'includes_trainer' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Plan Premium',
                'description' => 'Acceso ilimitado a todo + 1 sesión entrenamiento personal/mes',
                'price' => 79.99,
                'duration_months' => 1,
                'class_limit' => null,
                'includes_trainer' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Plan VIP',
                'description' => 'Todo incluido + entrenador personal dedicado',
                'price' => 149.99,
                'duration_months' => 1,
                'class_limit' => null,
                'includes_trainer' => true,
                'is_active' => true,
            ],
        ];

        foreach ($memberships as $membership) {
            Membership::create($membership);
        }
    }
}
