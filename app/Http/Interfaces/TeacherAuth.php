<?php

namespace App\Http\Interfaces;

use App\Http\Requests\API\Teacher\Auth\LoginRequest;
use App\Http\Requests\API\Teacher\Auth\RegisterRequest;
use Illuminate\Http\Request;

interface TeacherAuth{
    public function register(RegisterRequest $request);
    public function login(LoginRequest $request);
    public function logout(Request $request);
}