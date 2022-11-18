<?php

namespace App\Http\Controllers\API\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Teacher\Teacher\StoreRequest;
use App\Models\Teacher;
use Exception;
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

    public function update(StoreRequest $request)
    {
        $data = $request->validated();
        $teacher = auth('teacher-api')->user();
        try{
            DB::table('teachers')->where('id' , $teacher->id)->update($data);
        }catch(Exception $ex){
            // SQL query has syntix error
        }
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $teacher = auth()->user();
        return response()->json($teacher);
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
