<?php

use App\Http\Controllers\API\Teacher\Auth\AuthController;
use App\Http\Controllers\API\Teacher\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware'=> 'headers'], function(){
    Route::post('/account/student/login' , []);
    Route::post('/account/teacher/login' , [AuthController::class , 'login']);
    Route::group(['middleware'=> 'auth:teacher-api'] , function(){
        Route::get("/account" , [TeacherController::class , 'show']);
        Route::patch("/account" , [TeacherController::class , 'update']);

        Route::get('/lessons', []);
        Route::get('/lessons/{id}' , []);
        
        Route::get("/grades" , []);
        Route::get("/grades/{id}" , []);

        Route::get("/grades/{grade_id}/students" , []);
        Route::get("students/{student_id}" , []);

        Route::middleware(['role:admin|super-admin'])->group(function(){
            Route::patch('/account/{teacher_id}/lessons' , []);

            Route::post('/lessons' , []);
            Route::patch('lessons/{id}' , []);
            Route::delete('/lessons/{id}', []);

            Route::post('/grades' , []);
            Route::patch('grades/{id}' , []);
            Route::delete('/grades/{id}', []);
            
            Route::post('/account/teacher/register' , []);
            Route::post('/account/student/register' , []);
            
            Route::middleware(['role:super-admin'])->group(function(){
                Route::get("teacher/{id}/roles" , []);                
                Route::patch("teacher/{id}/roles" , []);
            });
        });
        
    });
});