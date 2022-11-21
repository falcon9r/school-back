<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Grade\StoreRequest;
use App\Http\Requests\API\Grade\UpdateRequest;
use App\Models\Grade;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::with(['teacher'])->get(); 
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
            'message' => 'ok'
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
        $grade = Grade::with(['teacher'])->where('id', $id)->first();
        return response()->json($grade);
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
}
