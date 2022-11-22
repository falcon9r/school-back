<?php

namespace Database\Seeders;

use App\Models\Days;
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
        foreach ($days as $value) {
            if($value->id == 7){
                break;
            }else{
                Schedule::query()->create([
                    'grade_id' => 1,
                    'day_id' => $value->id,
                    'lesson_id' => Lesson::inRandomOrder()->first()->id,
                ]);
                Schedule::query()->create([
                    'grade_id' => 1,
                    'day_id' => $value->id,
                    'lesson_id' => Lesson::inRandomOrder()->first()->id,
                ]);
                Schedule::query()->create([
                    'grade_id' => 1,
                    'day_id' => $value->id,
                    'lesson_id' => Lesson::inRandomOrder()->first()->id,
                ]);
                Schedule::query()->create([
                    'grade_id' => 1,
                    'day_id' => $value->id,
                    'lesson_id' => Lesson::inRandomOrder()->first()->id,
                ]);

                Schedule::query()->create([
                    'grade_id' => 2,
                    'day_id' => $value->id,
                    'lesson_id' => Lesson::inRandomOrder()->first()->id,
                ]);
                Schedule::query()->create([
                    'grade_id' => 2,
                    'day_id' => $value->id,
                    'lesson_id' => Lesson::inRandomOrder()->first()->id,
                ]);
                Schedule::query()->create([
                    'grade_id' => 2,
                    'day_id' => $value->id,
                    'lesson_id' => Lesson::inRandomOrder()->first()->id,
                ]);
                Schedule::query()->create([
                    'grade_id' => 2,
                    'day_id' => $value->id,
                    'lesson_id' => Lesson::inRandomOrder()->first()->id,
                ]);
            }
        }
    }
}
