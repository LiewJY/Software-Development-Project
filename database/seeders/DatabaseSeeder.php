<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            EmployeeSeeder::class,
            CustomerSeeder::class,
            MembershipSeeder::class,
            LocationSeeder::class,
            SlotSeeder::class,
            MaintenanceSeeder::class,
            MembershipPaymentSeeder::class,
            ReservationSeeder::class
        ]);
    }
}
