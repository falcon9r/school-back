<?php

namespace Database\Seeders;

use App\Models\DaysInSchoolStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaysInSchoolStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Уроки прошли',
            'Уроки отменены',
            'Отдых',
            'Праздник'
        ];

        DaysInSchoolStatus::truncate();
        foreach ($data as $value) {
            DaysInSchoolStatus::query()->create([
                'name' => $value
            ]);
        }
    }
}
