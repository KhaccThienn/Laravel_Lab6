<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SinhVienController;
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
// 1. Routing of Home Page
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// 2. Routing of Class Page
// show list
Route::get('/class', [ClassController::class, 'index'])->name('class.index');
// add class
Route::get('/class/add', [ClassController::class, 'add'])->name('class.add');
Route::post('/class/add', [ClassController::class, 'store'])->name('class.store');

// update class
Route::get('/class/edit/{id}', [ClassController::class, 'edit'])->name('class.edit');
Route::put('/class/{id}', [ClassController::class, 'update'])->name('class.update');

// delete class
Route::delete('/product/{id}', [ClassController::class, 'delete'])->name('class.delete');


// 3. Routing of Student Page
// show list
Route::get('/student', [SinhVienController::class, 'index'])->name('student.index');

// add student
Route::get('/student/add', [SinhVienController::class, 'add'])->name('student.add');
Route::post('/student/add', [SinhVienController::class, 'store'])->name('student.store');

// update student
Route::get('/student/edit/{id}', [SinhVienController::class, 'edit'])->name('student.edit');
Route::put('/student/{id}', [SinhVienController::class, 'update'])->name('student.update');

// delete student
Route::delete('/student/{id}', [SinhVienController::class, 'delete'])->name('student.delete');
