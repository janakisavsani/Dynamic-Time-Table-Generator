<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeTableController;

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
 
Route::get('/index', [TimeTableController::class, 'index']);
Route::post('/subjects', [TimeTableController::class, 'subjects'])->name('subjects');
Route::post('/test', [TimeTableController::class, 'test'])->name('test');