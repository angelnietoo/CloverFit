<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\members;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
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

        // Crear 3-5 pagos por miembro
        $members->each(function($member) {
            Payment::factory()
                ->count(rand(3, 5))
                ->create(['member_id' => $member->id]);
        });
    }
}
