<?php

namespace Database\Seeders;

use App\Models\members;
use App\Models\User;
use App\Models\Membership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener o crear membresías
        $memberships = Membership::all();
        
        if ($memberships->isEmpty()) {
            $this->call(MembershipSeeder::class);
            $memberships = Membership::all();
        }

        // Crear 50 miembros
        members::factory()
            ->count(50)
            ->make()
            ->each(function($member) use ($memberships) {
                $member->membership_id = $memberships->random()->id;
                $member->save();
            });
    }
}
