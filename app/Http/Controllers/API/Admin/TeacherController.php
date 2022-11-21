<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\Teacher\UpdateRequest;
use App\Models\SpecialtiesTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int  $teacher_id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $teacher_id)
    {
        $data = $request->validated()['lesson_ids'];
        foreach ($data as $key => $value) {
            $data[$key] = [
                'teacher_id' => $teacher_id,
                'lesson_id' => $value,
            ];
        }
        SpecialtiesTeacher::query()->where('teacher_id' , $teacher_id)->delete();
        DB::table('specialties_teachers')->insert($data);
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
}
