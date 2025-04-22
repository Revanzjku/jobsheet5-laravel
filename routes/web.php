<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentParentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [StudentController::class, 'index']);

Route::resource('/student', StudentController::class)->except('show');
Route::resource('/kelas', ClassroomController::class)->except('show');
Route::resource('/wali', StudentParentController::class)->except('show');
Route::get('/search', [StudentController::class])->name('student.search');
