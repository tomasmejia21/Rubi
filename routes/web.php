<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/', function () {
    return view('welcome');
});
// Administrar profesores - Solo administradores
Route::resource('teachers', TeacherController::class);
Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
Auth::routes();

// Login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Register
Route::get('/register', [RoleController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');