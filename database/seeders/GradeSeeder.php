<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grade::truncate();
        
        for ($i=0; $i < 12; $i++) { 
            $data = [
                'teacher_id' => Teacher::inRandomOrder()->first()->id,
                'number' => $i + 1,
                'sign' => 'A',
                'created' => Carbon::now()->format('Y-m-d'),
            ];
            Grade::query()->create($data);
        }
        for ($i=0; $i < 12; $i++) { 
            $data = [
                'teacher_id' => Teacher::inRandomOrder()->first()->id,
                'number' => $i + 1,
                'sign' => 'B',
                'created' => Carbon::now()->format('Y-m-d'),
            ];
            Grade::query()->create($data);
        }
        for ($i=0; $i < 12; $i++) { 
            $data = [
                'teacher_id' => Teacher::inRandomOrder()->first()->id,
                'number' => $i + 1,
                'sign' => 'C',
                'created' => Carbon::now()->format('Y-m-d'),
            ];
            Grade::query()->create($data);
        }
    }
}
