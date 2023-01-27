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
            'login' => $this->generator(),
            'password' => bcrypt('password'),
            'first_name' => fake()->name,
            'last_name' => fake()->lastName,
            'grade_id' => Grade::inRandomOrder()->first()->id
        ];
    }
    private function generator(){
        $login = "fake-";
        $login .= (string)random_int(10 , 99);
        $login .= substr(md5(microtime()),rand(0,26),7); // generate 3 chars:
        $password = (string)substr(md5(microtime()),rand(0,26),5);
        if(Student::query()->where('login' , $login)->exists()){
            return $this->generator();
        }
        return $login;
    }
}
