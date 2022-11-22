<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use App\Models\DaysInSchoolStatus;
use App\Models\DaysInSchool;
use Illuminate\Support\Facades\Artisan;

class DaysInSchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $year = DB::table('years')->orderByDesc('id')->first();
        $quarter = DB::table('quarters')
            ->where('year_id', $year->id)
            ->where('start', '<=', Carbon::now()->format("Y-m-d"))
            ->where('end', '>=' , Carbon::now()->format("Y-m-d"))->first();

        $grades = DB::table('grades')->whereBetween('number' , [1 , 11])->get();

        $day = Carbon::now();
        $today = $day->dayName;
        if($day->dayName == "Sunday"){
            Artisan::call('days:create');
        }else{
            DaysInSchool::truncate();
            foreach ($grades as $grade) {
                while($day->dayName != "Sunday"){
                    DaysInSchool::query()->create([
                        'quarter_id' => $quarter->id,
                        'grade_id' => $grade->id,
                        'days_in_school_status_id' => DaysInSchoolStatus::DEFAULT,
                        'date' => $day->format("Y-m-d")
                    ]);
                    
                    $day = $day->addDay();
                } 
                $day = Carbon::now();
            }
        }

    }
}
