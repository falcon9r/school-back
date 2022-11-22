<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DaysInSchoolStatus;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
           RolesSeeder::class,
            TeacherSeeder::class,
            GradeSeeder::class,
            StudentSeeder::class,
            LessonsSeeder::class,
            SpecialtiesTeachers::class,
            DaysSeeder::class,
            DaysInSchoolStatusSeeder::class,
            SchedulesSeeder::class,
            YearQuarterSeeder::class,
            DaysInSchoolSeeder::class,
            SchoolworkStatusSeeder::class,
            SchoolworkSeeder::class
            
        ]);   
    }
}
