<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\GradeStudent\UpdateRequest;
use App\Models\GradeStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeStudentController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $grade_id)
    {
        $data = $request->validated()['students_ids'];
        foreach ($data as $key => $value) {
            $data[$key] = [
                'grade_id' => $grade_id,
                'student_id' => $value,
            ];
        }
        GradeStudent::query()->updateOrCreate($data, $data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UpdateRequest $request ,$grade_id)
    {
        $data = $request->validated()['students_ids'];
        
        DB::table('grade_students')
            ->whereIn('student_id' , $data)
            ->where('grade_id' , $grade_id)
            ->delete();
        
            return response()->json([
            'message' => 'ok'
        ]);
    }
}
