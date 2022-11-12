<?php

use App\Http\Controllers\API\Teacher\Auth\AuthController;
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

Route::post('/account/teacher/register' , [AuthController::class , 'register']);
Route::post('/account/teacher/login' , [AuthController::class , 'login']);


Route::group(['middleware'=> 'auth:api'], function(){

});