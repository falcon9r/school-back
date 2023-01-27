<?php

namespace Database\Seeders;

use App\Models\Days;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::truncate();
        $days = Days::all();

        $grades = Grade::all();
        foreach ($grades as $grade) {
            foreach ($days as $day) {
                if($day->id != 7)
                {
                    for ($i=0; $i < 4; $i++) { 
                        Schedule::query()->create([
                            'grade_id' => $grade->id,
                            'day_id' => $day->id,
                            'lesson_id' => Lesson::inRandomOrder()->first()->id,
                            'place' => $i + 1
                        ]);
                    }
                }
            }
        }
    }
}
