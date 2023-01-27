<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\SpecialtiesTeacher;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtiesTeachers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = Teacher::query()->get();
        foreach ($teachers as $teacher) {
            $data = [
                'teacher_id' => Teacher::inRandomOrder()->first()->id,
                'lesson_id' => Lesson::inRandomOrder()->first()->id
            ];
            SpecialtiesTeacher::query()->create($data);
        }
    }
}
