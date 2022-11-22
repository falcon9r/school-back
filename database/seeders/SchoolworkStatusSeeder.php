<?php

namespace Database\Seeders;

use App\Models\SchoolworkStatus;
use App\Models\SchoolworkStudentStatus;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolworkStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SchoolworkStatus::truncate();
        SchoolworkStudentStatus::truncate();
        SchoolworkStatus::query()->create([
            'name' => 'Урок прощел'
        ]);
        
        SchoolworkStatus::query()->create([
            'name' => 'Учител не пришел'
        ]);
        
        SchoolworkStatus::query()->create([
            'name' => 'Урок состоялся'
        ]);

        SchoolworkStudentStatus::query()->create([
            'name' => 'присуствовал'
        ]);
        
        SchoolworkStudentStatus::query()->create([
            'name' => 'прогул'
        ]);
    }
}
