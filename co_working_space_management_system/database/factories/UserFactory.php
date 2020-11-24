<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'roles' => 2,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    public function
    default()
    {
        return $this->state([
            'name' => 'customer',
            'email' => 'customer@gmail.com'
        ]);
    }

    public function admin()
    {
        return $this->state([
            'name' => "Administrator",
            'email' => "admin@gmail.com",
            'roles' => 0,
            'password' => bcrypt('admin')
        ]);
    }

    public function employee()
    {
        return $this->state([
            'name' => "Employee",
            'email' => "employee@gmail.com",
            'roles' => 1,
            'password' => bcrypt('employee')
        ]);
    }
}
