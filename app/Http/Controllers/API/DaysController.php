<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Days;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaysController extends Controller
{
    public function index()
    {
        $days = DB::select("SELECT `id`, 
                                    `name` 
                                        from days 
                            WHERE id != 7
                            order by id;");
        return response()->json($days);
    }
}
