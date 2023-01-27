<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\SchoolworkStudent;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NotenGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($grade_id)
    {
        $option = Option::query()->find(auth(Teacher::AUTH)->id());

        $validator = Validator::make(['grade_id' => $grade_id], [
            'grade_id' => 'required|integer|exists:grades,id'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors() , 422);
        }
        $students = DB::select("SELECT  
                distinct ss.student_id ,
                concat(students.login , ' ( ', ifnull(students.first_name , '') , ifnull(students.last_name , '') , ' )') as login 
                FROM school.schoolwork_students as ss
                INNER JOIN students ON students.id = ss.student_id
                INNER JOIN schoolworks as s ON s.id = ss.schoolworks_id
                INNER JOIN days_in_schools as dis on dis.id = s.days_in_school_id
            WHERE 
                students.grade_id = {$grade_id} AND 
                dis.date = '{$option->date}'
            order by 
                ss.student_id , 
                s.place;");
        $noten = [];
        $note = [];
        
        foreach ($students as $student) {
            $note['login'] = $student->login;
            
            $note['noten'] = DB::select("SELECT 
                    ss.id , 
                    ifnull(ss.note , 0) as note , 
                    lessons.name AS subject , 
                    s.place , 
                    dis.date 
                FROM school.schoolwork_students as ss
                INNER JOIN students ON students.id = ss.student_id
                INNER JOIN schoolworks as s ON s.id = ss.schoolworks_id
                INNER JOIN lessons on lessons.id  = s.lesson_id
                INNER JOIN days_in_schools as dis on dis.id = s.days_in_school_id
            WHERE 
                students.grade_id = {$grade_id} AND 
                dis.date = '{$option->date}' AND
                students.id = {$student->student_id}
        order by 
            ss.student_id , 
            s.place;");
            $noten[] = $note;
            $note = [];
        }    

        $subjects = DB::select("SELECT 
            l.name
        FROM school.schoolworks as s
        INNER join days_in_schools  as dis on dis.id = s.days_in_school_id
        INNER JOIN lessons as l on s.lesson_id = l.id
            where 
                dis.grade_id = {$grade_id} and 
                dis.date = '{$option->date}'
        order by 
            s.place;");
        return response()->json([
            'noten' => $noten,
            'subjects' => $subjects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all() , [
            'note' => 'required|nullable|integer|between:2,5'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors() , 422);
        }

        $data = $validator->validated();
        $note = SchoolworkStudent::query()->find($id);
        $note->update([
            'note' => $data['note']
        ]);
        
        return response()->json([
            'title' => 'success',
            'message' => 'note added'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
