<?php

namespace Database\Seeders;

use App\Models\Membership;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Membership::create([
            'name' => 'Basic',
            'price' => '99',
            'description' => 'Full Access to Pantry,Full Access Free Seating Area, Acccess to One Location Only'
        ]);

        Membership::create([
            'name' => 'Medium',
            'price' => '199',
            'description' => 'Full Access to Pantry, Full Access Free Seating Area, Entitled for ONE Personal Desk, Acccess to One Location Only'
        ]);

        Membership::create([
            'name' => 'Premium',
            'price' => '299',
            'description' => 'Full Access to Pantry, Full Access Free Seating Area, Entitled for ONE Personal Desk, Access to All Sharespace Locations'
        ]);
    }
}
