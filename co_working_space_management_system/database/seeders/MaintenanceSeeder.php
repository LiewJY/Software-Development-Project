<?php

namespace Database\Seeders;

use App\Models\Maintenance;
use Illuminate\Database\Seeder;

class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Maintenance::factory()->count(3)->forRoom()->create();
        Maintenance::factory()->count(3)->forEmployee()->create();
        Maintenance::factory()->count(3)->forRoom()->create();
    }
}
