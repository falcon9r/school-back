<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Days;
use App\Models\Schedule;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function test_index($grade_id){
        if(!is_numeric((int)$grade_id)){
            return response()->json([
                'message' => 'No readable params'
            ] , 422);
        }
        $days = Days::query()->where('id' , '!=' , Days::SUNDAY)->get();
        $collection = collect();
        foreach ($days as $key => $day) {
            $schedule = DB::select("SELECT schedules.id  , schedules.lesson_id as subject_id , lessons.name , schedules.place FROM schedules
            INNER JOIN lessons ON schedules.lesson_id = lessons.id 
                WHERE 
                    schedules.grade_id = {$grade_id} and 
                    schedules.day_id = {$day->id}
            order by schedules.place;");

            $collection[$key] =
                 ['day' => $day, 'schedule' =>  $schedule];
        }

        return response()->json($collection);
    }

    public function test_show($grade_id , $day_id){
        if(!is_numeric((int)$grade_id) and !is_numeric((int)$day_id)){
            return response()->json([
                'message' => 'No readable params'
            ] , 422);
        }
        
        $collection = collect();
        $schedule = DB::select("SELECT schedules.id  , lessons.name ,  schedules.lesson_id as subject_id , schedules.place FROM schedules
            INNER JOIN lessons ON schedules.lesson_id = lessons.id 
                WHERE 
                    schedules.grade_id = {$grade_id} and 
                    schedules.day_id = {$day_id}
            order by schedules.place;");
        $day = Days::query()->find($day_id);
        $collection = ['day' => $day , 'schedule' => $schedule];
        return response()->json($collection);
    }

    public function index($grade_id)
    {
        try{
            $schedules = DB::select("SELECT schedules.id, 
                                    schedules.place ,  
                                    days.id as day_id ,  
                                    days.name as week_day , 
                                    concat(grades.number, grades.sign) as grade , 
                                    lessons.name as subject FROM school.schedules
                                        INNER JOIN grades ON schedules.grade_id = grades.id
                                        INNER JOIN days ON schedules.day_id = days.id
                                        INNER JOIN lessons ON lessons.id = schedules.lesson_id
                                    WHERE grades.id = {$grade_id}
                                    ORDER BY day_id , 
                                    schedules.place ASC;");
        if($schedules == null)
        {
            return response()->json([
                'message' => "No Found"
            ] , 422);
        }
        return response()->json($schedules);
        }
        catch(Exception $ex)
        {
            return response()->json([
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function store(Request $request , $grade_id , $day_id)
    {
        if(!is_numeric((int)$grade_id) and !is_numeric((int)$day_id)){
            return response()->json([
                'message' => 'No readable params'
            ] , 422);
        }

        $data = $request->all();
        Schedule::query()->where('grade_id' , $grade_id)->where('day_id' , $day_id)->delete();
        $temps = collect();
        $places = collect();
        $ids = collect();
            foreach ($data as $key => $value) {
                if(isset($value->place))
                {
                    $places[$value->place] = true;    
                    $ids[$key] = $value->place;
                }
                if(isset($value['subject_id'])){
                    $temps[] = [
                        'grade_id' => $grade_id,
                        'day_id' => $day_id,
                        'lesson_id' => $value['subject_id'],
                    ];
                }
        }
        
        $i = 1;
        foreach ($temps as $key => $temp) {
            if($places[$i] == false)
            {
                $temp['place'] = $ids[$key];
            }
            else
            {
                $temp['place'] = $i;
            }
            $i++;
            Schedule::query()->create($temp);
        }
        return response()->json([
            'title' => "Success",
            "message" => "Schedule success updated for grade by ID: {$grade_id}"
        ]);
    }
}
