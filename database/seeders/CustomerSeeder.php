<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = User::where('roles', '2')->get();

        foreach ($customers as $customer) {
            $customer->customer()->save(Customer::factory()->make());
        }
    }
}
