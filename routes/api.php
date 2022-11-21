<?php

use App\Http\Controllers\API\Admin\GradeStudentController;
use App\Http\Controllers\API\GradeController;
use App\Http\Controllers\API\LessonController;
use App\Http\Controllers\API\Teacher\Auth\AuthController;
use App\Http\Controllers\API\Teacher\StudentController;
use App\Http\Controllers\API\Teacher\TeacherController;
use App\Http\Controllers\API\Admin\TeacherController as AdminTeacherController;
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
        Route::get("account" , [TeacherController::class , 'show']);
        Route::patch("/account" , [TeacherController::class , 'update']);

        Route::get('/lessons', [LessonController::class , 'index']);
        Route::get('/lessons/{id}' , [LessonController::class , 'show']);
        
        Route::get("/grades" , [GradeController::class , 'index']);
        Route::get("/grades/{id}" , [GradeController::class , 'show']);

        Route::get("/grades/{grade_id}/students" , [StudentController::class, 'index']);
        Route::get("students/{student_id}" , [StudentController::class, 'show']);

        Route::middleware(['role:admin|super-admin'])->group(function(){

            Route::patch('/account/teacher/{teacher_id}/lessons' , [AdminTeacherController::class , 'update']);

            Route::post('/lessons' , [LessonController::class , 'store']);
            Route::patch('lessons/{id}' , [LessonController::class , 'update']);

            Route::post('/grades' , [GradeController::class , 'store']);
            Route::patch('grades/{id}' , [GradeController::class , 'update']);

            Route::patch('grades/{grade_id}/students' , [GradeStudentController::class , 'update']);
            Route::delete('grades/{grade_id}/students' , [GradeStudentController::class , 'destroy']);

            Route::post('/account/teacher/register' , []);
            Route::post('/account/student/register' , []);
            
            Route::middleware(['role:super-admin'])->group(function(){
                Route::post('years' , []);
                Route::patch('years/{id}' , []);
                Route::get('years' , []);
                Route::get('years/{id}' , []);
                
                Route::get('quarters' , []);
                Route::get('quarters/{id}' , []);
                Route::patch('quarters/{id}' , []);
                Route::post('quarters' , []);
                
                Route::get("teacher/{id}/roles" , []);                
                Route::patch("teacher/{id}/roles" , []);
            });
        });
        
    });
});