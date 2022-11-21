<?php

namespace Database\Factories;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'login' => fake()->freeEmail,
            'password' => bcrypt('password'),
            'first_name' => fake()->name,
            'last_name' => fake()->lastName,
            'grade_id' => Grade::inRandomOrder()->first()->id
        ];
    }
}
