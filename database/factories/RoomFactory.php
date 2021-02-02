<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'location_id' => Location::factory(),
            'name' => $this->faker->numerify('Room ###'),
            'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'price' => $this->faker->randomNumber(3),
            'size' => $this->faker->randomNumber(2)
        ];
    }
}
