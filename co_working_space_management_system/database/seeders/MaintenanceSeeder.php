<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Maintenance;
use App\Models\Room;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $employees = Employee::pluck('id');
        $rooms = Room::pluck('id');

        foreach (range(1,20) as $index) {
            Maintenance::create([
                'room_id' => $faker->randomElement($rooms),
                'employee_id' => $faker->randomElement($employees),
                'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'status' => $faker->numberBetween(0, 1)
            ]);
        } 

    }
}
