<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Maintenance;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaintenanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Maintenance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'room_id' => Room::factory(),
            'employee_id' => Employee::factory(),
            'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'status' => $this->faker->numberBetween(0, 1)
        ];
    }
}
