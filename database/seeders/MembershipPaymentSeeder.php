<?php

namespace Database\Seeders;

use App\Models\Membership;
use App\Models\MembershipPayment as ModelsMembershipPayment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MembershipPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('ms_MY');
        $user = User::where('roles', 2)->pluck('id');
        $membership = Membership::pluck('id');

        foreach (range(1, 4) as $index) {

            $year  = rand(2020, 2021);
            $month = rand(1, 12);
            $day = rand(1, 28);


            $date = Carbon::create($year, $month, $day);

            ModelsMembershipPayment::create([
                'created_at' => $date,
                'updated_at' => $date,
                'membership_id' => $faker->randomElement($membership),
                'user_id' => $faker->unique()->randomElement($user),
                'expired_on' => $date->addDay(30),
            ]);
        }
    }
}
