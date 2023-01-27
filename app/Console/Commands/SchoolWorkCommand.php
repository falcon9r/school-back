<?php

namespace App\Console\Commands;

use App\Models\Days;
use App\Models\DaysInSchool;
use App\Models\Grade;
use App\Models\Schedule;
use App\Models\Schoolwork;
use App\Models\SchoolworkStatus;
use App\Models\SchoolworkStudent;
use App\Models\SchoolworkStudentStatus;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SchoolWorkCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schoolwork:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now()->format('Y-m-d');
        $today = Carbon::now()->dayName;
        $today = Days::query()->where('name' , $today)->first();
        $daysInSchool = DaysInSchool::query()->where('date' , $date)->get();
        foreach ($daysInSchool as $dayInSchool) {
           $students = Student::query()->where('grade_id' , $dayInSchool->grade_id)->get();
            $schedules = Schedule::query()
                                    ->where('grade_id' , $dayInSchool->grade_id)
                                    ->where('day_id' , $today->id)->first();
            foreach ($schedules as $schedule) {
                $schoolwork = Schoolwork::query()->create([
                    'days_in_school_id' => $dayInSchool->id,
                    'lesson_id' => $schedule->lesson_id,
                    'place' => $schedule->place,
                    'schoolwork_status_id' => SchoolworkStatus::DEFAULT
                    ]);
                foreach ($students as $student) {
                    SchoolworkStudent::query()->create([
                        'schoolworks_id' => $schoolwork->id,
                        'schoolwork_student_status_id' => SchoolworkStudentStatus::DEFAULT,
                        'student_id' => $student->id
                    ]);
                }
            }
            
        }
        return Command::SUCCESS;
    }
}
