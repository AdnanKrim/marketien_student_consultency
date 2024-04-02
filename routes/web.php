<?php

use App\Http\Controllers\LeedController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/sms',[LeedController::class, 'sms']);
Route::get('/contract-form',[LeedController::class,'contractForm']);
Route::get('/generate-pdf',[LeedController::class,'generatePdf']);

