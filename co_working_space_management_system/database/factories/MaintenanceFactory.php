<?php

namespace Database\Factories;

use App\Models\Maintenance;
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
            // 'room_id' => $roomID,
            // 'employee_id' => $employeeID,
            'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'status' => $this->faker->numberBetween(0, 1)
        ];
    }
}
