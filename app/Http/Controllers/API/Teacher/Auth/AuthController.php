<?php

namespace App\Http\Controllers\API\Teacher\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Teacher\Auth\RegisterRequest;
use Illuminate\Http\Request;
use App\Http\Interfaces\TeacherAuth;
use App\Http\Requests\API\Teacher\Auth\LoginRequest;
use App\Models\Teacher;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Spatie\Permission\Exceptions\UnauthorizedException;

class AuthController extends Controller implements  TeacherAuth
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $teacher = Teacher::query()->create($data);
        return response()->json($teacher->createToken('teacher'));
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if(!auth()->attempt($data)){
            throw new UnauthorizedException(Response::HTTP_UNAUTHORIZED);
        }
        else{
            $teacher = auth()->user();
            return response()->json($teacher->createToken('teacher'));
        }
    }

    public function logout(Request $request)
    {
        
    }
}
