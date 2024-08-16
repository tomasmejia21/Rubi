<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;

Route::get('/', function () {
    return view('welcome');
});
// Administrar profesores - Solo administradores
Route::resource('teachers', TeacherController::class);
Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
Auth::routes();

//Login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');