<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Location;
use App\Models\Maintenance;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::factory(3)->hasRooms(3)->create();
    }
}
