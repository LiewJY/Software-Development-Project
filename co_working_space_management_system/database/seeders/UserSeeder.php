<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Maintenance;
use App\Models\Room;
use App\Models\User;
use Database\Factories\CustomerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'roles' => 0,
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'username' => 'employee',
            'email' => 'employee@gmail.com',
            'email_verified_at' => now(),
            'roles' => 1,
            'password' => bcrypt('employee'),
            'remember_token' => Str::random(10),
        ]);

        $defaultCustomer = new User([
            'username' => 'customer',
            'email' => 'customer@gmail.com',
            'email_verified_at' => now(),
            'roles' => 2,
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);

        $defaultCustomer->save();
        $details = Customer::factory()->default()->make();

        $defaultCustomer->customer()->save(
            $details
        );

        // User::create([]);

        User::factory(3)->customer()->hasCustomer()->create();
    }
}
