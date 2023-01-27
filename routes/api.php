<?php

use App\Http\Controllers\API\Admin\GradeStudentController;
use App\Http\Controllers\API\Admin\ScheduleController;
use App\Http\Controllers\API\GradeController;
use App\Http\Controllers\API\LessonController;
use App\Http\Controllers\API\Teacher\Auth\AuthController;
use App\Http\Controllers\API\Teacher\StudentController;
use App\Http\Controllers\API\Teacher\TeacherController;
use App\Http\Controllers\API\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\API\Admin\YearController;
use App\Http\Controllers\API\DaysController;
use App\Http\Controllers\API\Optioncontroller;
use App\Http\Controllers\API\Student\Auth\AuthController as StudentAuthController;
use App\Http\Controllers\NotenGradeController;
use App\Models\Student;
use App\Models\Teacher;
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
    Route::post('/account/student/login' , [StudentAuthController::class , 'register']);
    Route::post('/account/teacher/login' , [AuthController::class , 'login']);
    
    Route::get('days' , [DaysController::class , 'index']);

    Route::group(['middleware'=> 'auth:teacher-api'] , function(){
        Route::get("account" , [TeacherController::class , 'show']);
        Route::patch("/account" , [TeacherController::class , 'update']);
        Route::get('account/noten/option' , [Optioncontroller::class , 'index']);
        Route::post('account/noten/option' , [Optioncontroller::class , 'store']);
        
        Route::get('/lessons', [LessonController::class , 'index']);
        Route::get('/lessons/{id}' , [LessonController::class , 'show']);
        
        Route::get("f-grades" , [GradeController::class , 'index_fast']);
        Route::get("/grades" , [GradeController::class , 'index']);
        Route::get("/grades/{id}" , [GradeController::class , 'show']);

        Route::get("students/{student_id}" , [StudentController::class, 'show']);



        Route::middleware(['role:admin|super-admin'])->group(function(){
            
            Route::post("schedules/{grade_id}/schedule/{day_id}" , [ScheduleController::class , 'store']);

            Route::patch('/account/teacher/{teacher_id}/lessons' , [AdminTeacherController::class , 'update']);
            Route::post("teachers" , [AdminTeacherController::class , 'store']);
            Route::get('/subjects-teacher/{teacher_id}', [AdminTeacherController::class , 'get_subjects']);
            Route::get("/teachers" , [AdminTeacherController::class , 'index']);
            Route::get("main-teacher/{id}" , [AdminTeacherController::class, 'show_main']);
            
            Route::post('/lessons' , [LessonController::class , 'store']);
            Route::patch('lessons/{id}' , [LessonController::class , 'update']);

            Route::get('/grades-teachers' ,[GradeController::class , 'gradesTeachers']);
            Route::post('/grades' , [GradeController::class , 'store']);
            Route::patch('grades/{id}' , [GradeController::class , 'update']);
            
            Route::get('fake-generator/teacher', [TeacherController::class, 'fake_generated']);
            Route::get('fake-generate/students', [StudentController::class, 'fake_generated']);
            Route::post('students' , [StudentController::class , 'store']);

            Route::get('test/{grade_id}/schedule' , [ScheduleController::class, 'test_index']);
            Route::get('test/{grade_id}/schedule/{day_id}' , [ScheduleController::class, 'test_show']);
            
            Route::get('grade/{grade_id}/schedule' , [ScheduleController::class, 'index']);
            Route::get("grades/{grade_id}/students" , [StudentController::class, 'index']);
            Route::patch('grades/{grade_id}/students' , [GradeStudentController::class , 'update']);
            Route::delete('grades/{grade_id}/students' , [GradeStudentController::class , 'destroy']);

            Route::post('/account/teacher/register' , []);
            Route::post('/account/student/register' , []);

            Route::get("noten/{grade_id}" , [NotenGradeController::class, 'index']);
            Route::patch("noten/{id}", [NotenGradeController::class , 'update']);
            
            Route::get('years' , [YearController::class , 'index']);
            
            Route::middleware(['role:super-admin'])->group(function(){
                Route::post('years' , []);
                Route::patch('years/{id}' , []);
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