<?php

namespace Database\Seeders;

use App\Models\Grade;
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
        $data = [
            'teacher_id' => 1,
            'number' => 11,
            'sign' => 'A',
            'created' => Carbon::now()->format('Y-m-d'),
        ];
        Grade::query()->create($data);
        $data = [
            'teacher_id' => 2,
            'number' => 9,
            'sign' => 'B',
            'created' => Carbon::now()->format('Y-m-d'),
        ];
            Grade::query()->create($data);
    }
}
