<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('students', [\App\Http\Controllers\StudentController::class, 'getAllStudents']);
Route::get('students/{id}', [\App\Http\Controllers\StudentController::class, 'getStudent']);
Route::post('students', [\App\Http\Controllers\StudentController::class, 'createStudent']);
Route::put('students/{id}', [\App\Http\Controllers\StudentController::class, 'updateStudent']);
Route::delete('students/{id}', [\App\Http\Controllers\StudentController::class, 'deleteStudent']);