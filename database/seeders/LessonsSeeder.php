<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'алгебра'
            ],
            [
                'name' => 'геометрия'
            ],
            [
                'name' => 'физика'
            ],
        ];

        Lesson::truncate();
        foreach ($data as $value) {
            Lesson::create($value);
        }
    }
}
