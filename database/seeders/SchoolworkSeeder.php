<?php

namespace Database\Seeders;

use App\Models\Days;
use App\Models\DaysInSchool;
use App\Models\Grade;
use App\Models\Schoolwork;
use App\Models\SchoolworkStatus;
use App\Models\SchoolworkStudent;
use App\Models\SchoolworkStudentStatus;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schoolwork::truncate();
        SchoolworkStudent::truncate();
        $dayInSchools = DaysInSchool::query()->where('date' , '=' , Carbon::now()->format('Y-m-d'))->get();
        foreach ($dayInSchools as $dayInSchool) {
            $grade = Grade::find($dayInSchool->grade_id);
            $today = Days::TUESDAY;
            $schedules = DB::table('schedules')->where('grade_id' , $grade->id)->where('day_id', $today)->get();
            foreach ($schedules as $schedule) {
                $Schoolwork = Schoolwork::query()->create([
                    'days_in_school_id' => $dayInSchool->id,
                    'lesson_id' => $schedule->lesson_id,
                    'schoolwork_status_id' => SchoolworkStatus::DEFAULT
                ]);

                $students = Student::query()->where('grade_id' , $grade->id)->get();

                foreach ($students as $student) {
                    SchoolworkStudent::query()->create([
                        'schoolworks_id' => $Schoolwork->id,
                        'student_id' => $student->id, 
                        'schoolwork_student_status_id' => SchoolworkStudentStatus::DEFAULT,
                    ]);
                }
            }
        }
    }
}
