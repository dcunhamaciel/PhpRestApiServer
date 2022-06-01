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

Route::namespace('\App\Http\Controllers')->group(function()
{
    Route::get('students', 'StudentController@getAllStudents');
    Route::get('students/{id}', 'StudentController@getStudent');
    Route::post('students', 'StudentController@createStudent');
    Route::put('students/{id}', 'StudentController@updateStudent');
    Route::delete('students/{id}', 'StudentController@deleteStudent');
});
