<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Grade\StoreRequest;
use App\Http\Requests\API\Grade\UpdateRequest;
use App\Models\Grade;
use App\Models\Teacher;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = DB::select("SELECT grades.id , grades.created , 
            concat(grades.number , grades.sign) as grade ,  
            teachers.id as teacher_id , teachers.login , 
            (select count(id) from students where grades.id = students.grade_id) as  students from grades
                        INNER JOIN teachers ON grades.teacher_id = teachers.id;");
        return response()->json($grades);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        if(!isset($data['created'])){
            $data['created'] = Carbon::now();
        }
        $grade = Grade::query()->create($data);
        return response()->json([
            'title' => "Success",
            'message' => 'Grade success created'
        ]);
    }

    public function index_fast()
    {
        $grades = DB::select("SELECT id , concat(number , sign)  as grade FROM grades;");
        return response()->json($grades);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $grade = DB::select("SELECT grades.id , grades.created , 
            grades.number , grades.sign , concat(grades.number , grades.sign) as grade,  
            teachers.id as teacher_id , teachers.login , 
            (select count(id) from students where grades.id = students.grade_id) as  students from grades
                        INNER JOIN teachers ON grades.teacher_id = teachers.id WHERE grades.id = {$id};");
            if($grade == null) throw new Exception();
            $grade = $grade[0];
            return response()->json($grade);
        }
        catch(Exception $ex){
            return response()->json([
                'message' => "ID NOT FIND !"
            ], HttpResponse::HTTP_NOT_FOUND);
        }   
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->validated();
        $check = Grade::query()
            ->where('sign' , $data['sign'])
            ->where('number' , $data['number'])
            ->whereNot('id' , $id)
            ->first();
        if($check != null){
            return response()->json([
                'message' => 'Grade already exist'
            ], 422);
        }
        if(!isset($data['created'])){
            $data['created'] = Carbon::now();
        }
        $grade = Grade::find($id);
        $grade->update($data);
        return response()->json([
            'message' => 'ok'
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
    public function gradesTeachers(){
        $teachers = Teacher::all(['id' , 'login' , 'first_name' , 'last_name']);
        return response()->json($teachers);
    }

}
