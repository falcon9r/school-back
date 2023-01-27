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
    private function generator(){
        $login = "origin-";
        $login .= (string)random_int(10 , 99);
        $login .= substr(md5(microtime()),rand(0,26),3); // generate 3 chars:
        $password = (string)substr(md5(microtime()),rand(0,26),5);
        if(Teacher::query()->where('login' , $login)->exists()){
            return $this->generator();
        }
        return [
            'login' => $login,
            'password' => $password
        ];
    }
    public function fake_generated(){
        return response()->json($this->generator());
    }
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
