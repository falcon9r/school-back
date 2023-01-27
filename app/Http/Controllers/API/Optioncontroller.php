<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Year;
use App\Models\Option;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Option\StoreRequest;

class Optioncontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $option = Option::query()->where('teacher_id', auth('teacher-api')->id())->first();
        $years = Year::all();
        if ($option == null)
        {
            $option = Option::query()->create([
                'year_id' => $years[count($years) - 1]->id,
                'date' => Carbon::now()->format("Y-m-d"),
                'teacher_id' => auth('teacher-api')->id()
            ]);
        }
        return response()->json([
            'date' => $option->date , 'active' => $option->year_id , 'years' => $years
        ]);
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
        $option = Option::query()->where('teacher_id' , auth('teacher-api')->id())->first();
        $option->update($data);
        return response()->json([
            'title' => "Success",
            'message' => "Option updated"
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
