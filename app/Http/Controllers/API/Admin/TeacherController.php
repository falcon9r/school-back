<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\Teacher\StoreRequest;
use App\Http\Requests\API\Admin\Teacher\UpdateRequest;
use App\Http\Resources\API\Admin\Teacher\IndexResource;
use App\Http\Resources\API\Admin\TeacherLesson\IndexResource as AnderIndexResource;
use App\Models\Lesson;
use App\Models\SpecialtiesTeacher;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{

    public function get_subjects($teacher_id)
    {
        if(!is_integer((int)$teacher_id)) return response()->json([
            'message' => "Unreadable params"
        ] , 422);
        $res = DB::select("SELECT * , 
        case when 
            exists(
                select id from specialties_teachers where specialties_teachers.teacher_id = {$teacher_id} and specialties_teachers.lesson_id = lessons.id
                )
            then true
        else false 
        END  as teach
        from lessons;");
        return response()->json(AnderIndexResource::collection($res));
    }
    public function show_main($id){
        $teacher = Teacher::query()->findOrFail($id);
        return response()->json($teacher);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::with(['grades' , 'roles' , 'subjects'])->get();
        return response()->json(IndexResource::collection($teachers));
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
        $teacher = Teacher::query()->create($data);
        return response()->json([
            'title' => "Success stored",
            'message' => "Teacher created by  ID:{$teacher->id}"
        ]);
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
     * @param  int  $teacher_id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $teacher_id)
    {
        $data = $request->validated()['subjects'];
        SpecialtiesTeacher::query()->where('teacher_id' , $teacher_id)->delete();
        foreach ($data as $key => $value) {
            if($value['teach'] == true){
                SpecialtiesTeacher::query()->create([
                    'teacher_id' => $teacher_id,
                    'lesson_id' => $value['id']
                ]);
            }
        }
        return response()->json([
            'title' => "Success updated",
            'message' => "Updated Subjects. Teacher`s ID: {$teacher_id}"
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
