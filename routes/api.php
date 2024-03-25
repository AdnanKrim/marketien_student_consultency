<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeedController;
use App\Http\Controllers\DocController;
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
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['middleware' => 'adminApi'], function () {
    });

    Route::group(['middleware' => 'leedApi'], function () {
        Route::get('leed-info', [LeedController::class, 'leedInfo'])->name('leed-info');
        Route::post('save-photo', [LeedController::class, 'savePhoto'])->name('save-photo');
        Route::post('save-docs', [DocController::class, 'docStore'])->name('save-docs');
        Route::get('edu-info', [DocController::class, 'eduInfo'])->name('edu-info');
        Route::get('doc-info', [DocController::class, 'docInfo'])->name('doc-info');
    });
});


Route::post('login', [UserController::class, 'index']);
Route::post('save-leed', [LeedController::class, 'SaveLeed'])->name('save-leed');
Route::post('student-reg', [LeedController::class, 'studentReg'])->name('student-reg');
Route::post('otp-generate', [LeedController::class, 'otpGenerate'])->name('otp-generate');
Route::post('otp-verify', [LeedController::class, 'otpVerify'])->name('otp-verify');
