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
            'price' => '100',
            'description' => 'Basic membership package'
        ]);

        Membership::create([
            'name' => 'Medium',
            'price' => '200',
            'description' => 'Medium membership package'
        ]);

        Membership::create([
            'name' => 'Premium',
            'price' => '100',
            'description' => 'Premium membership package'
        ]);
    }
}
