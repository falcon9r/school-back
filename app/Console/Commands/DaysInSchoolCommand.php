<?php

namespace App\Console\Commands;

use App\Models\DaysInSchool;
use App\Models\DaysInSchoolStatus;
use App\Models\Grade;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;

class DaysInSchoolCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'days:create';

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
        
        $year = DB::table('years')->orderByDesc('id')->first();
        $quarter = DB::table('quarters')
            ->where('year_id', $year->id)
            ->where('start', '<=', Carbon::now()->format("Y-m-d"))
            ->where('end', '>=' , Carbon::now()->format("Y-m-d"))->first();

        $is_true = Carbon::now()->dayName;
        if($is_true != 'Sunday'){
            return Command::FAILURE;
        }
        
        $grades = DB::table('grades')->whereBetween('number' , [1 , 11])->get();
        foreach ($grades as $grade) {
            for ($i = 1; $i < 7; $i++) { 
                DaysInSchool::query()->create([
                    'quarter_id' => $quarter->id,
                    'grade_id' => $grade->id,
                    'days_in_school_status_id' => DaysInSchoolStatus::DEFAULT,
                    'date' => Carbon::now()->addDays($i)->format('Y-m-d')
                ]);
            }
        }
        return Command::SUCCESS;
    }
}
