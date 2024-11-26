<?php

use App\Http\Controllers\ClasseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('welcome');
});

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
