<?php

namespace App\Http\Controllers\API\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\Student\StoreRequest;
use App\Models\Student;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private function generator(){
        $login = "fake-";
        $login .= (string)random_int(10 , 99);
        $login .= substr(md5(microtime()),rand(0,26),3); // generate 3 chars:
        $password = (string)substr(md5(microtime()),rand(0,26),5);
        if(Student::query()->where('login' , $login)->exists()){
            return $this->generator();
        }
        return [
            'login' => $login,
            'password' => $password
        ];
    }
    public function fake_generated()
    {
        return response()->json($this->generator());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($grade_id)
    {
        $students = Student::query()->where('grade_id' , $grade_id)->get();
        return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data =  $request->validated();
        try{
            $student = Student::query()->create($data);
            return response()->json([
                'title' => 'Student success created',
                'message' => "Student`s ID: {$student->id}"
            ]);
        }catch(Exception $ex){
            return response()->json($ex->getMessage(), 422);
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        //
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
