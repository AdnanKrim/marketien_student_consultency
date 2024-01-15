<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeedController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's

    });


Route::post("login",[UserController::class,'index']);
Route::post('student-reg',[LeedController::class,'studentLeedRegApi'])->name('student-reg');
Route::post('otp-generate',[LeedController::class,'otpGenerate'])->name('otp-generate');