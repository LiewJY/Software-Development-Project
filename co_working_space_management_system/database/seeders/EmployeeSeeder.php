<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = User::where('roles', 0)
            ->orWhere('roles', 1)
            ->get();

        foreach ($employees as $employee) {
            $employee->employee()->save(Employee::factory()->make());
        }
    }
}
