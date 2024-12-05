<?php

use App\Http\Controllers\ClasseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Login
Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.process');
Route::get('/logout', [LoginController::class, 'destroy'])->name('login.destroy');

Route::group(['middleware' => 'auth'], function() {

// Dashboard
Route::get('/index-dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Cursos
Route::get('/index-course', [CourseController:: class, 'index'])->name('courses.index');
Route::get('/show-course/{course}', [CourseController:: class, 'show'])->name('courses.show');
Route::get('/create-course', [CourseController:: class, 'create'])->name('courses.create');
Route::post('/store-course', [CourseController:: class, 'store'])->name('courses.store');
Route::get('/edit-course/{course}', [CourseController:: class, 'edit'])->name('courses.edit');
Route::put('/update-course/{course}', [CourseController:: class, 'update'])->name('courses.update');
Route::delete('/destroy-course/{course}', [CourseController:: class, 'destroy'])->name('courses.destroy');

// Aulas
Route::get('/index-classe/{course}', [ClasseController::class, 'index'])->name('classe.index');
Route::get('/show-classe/{classe}', [ClasseController::class, 'show'])->name('classe.show');
Route::get('/create-classe/{course}', [ClasseController::class, 'create'])->name('classe.create');
Route::post('/store-classe', [ClasseController::class, 'store'])->name('classe.store');
Route::get('/edit-classe/{classe}', [ClasseController::class, 'edit'])->name('classe.edit');
Route::put('/update-classe/{classe}', [ClasseController::class, 'update'])->name('classe.update');
Route::delete('/destroy-classe/{classe}', [ClasseController:: class, 'destroy'])->name('classe.destroy');

// Usuários
Route::get('/index-user', [UserController::class, 'index'])->name('user.index');
Route::get('/show-user/{user}', [UserController::class, 'show'])->name('user.show');
Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
Route::post('/store-user', [UserController::class, 'store'])->name('user.store');
Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user.update');
Route::get('/edit-user-password/{user}', [UserController::class, 'editPassword'])->name('user.edit-password');
Route::put('/update-user-password/{user}', [UserController::class, 'updatePassword'])->name('user.update-password');
Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

});
