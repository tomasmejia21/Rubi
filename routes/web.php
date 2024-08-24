<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EducationalInstitutionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ActivityController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inicio', function () {
    return view('inicio');
});
// Administrar profesores - Solo administradores
Route::resource('teachers', TeacherController::class);
Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/check-email', [TeacherController::class, 'checkEmail']);
Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
Auth::routes();

// Administrar instituciones educativas - Solo administradores
Route::resource('EducationalInstitution', EducationalInstitutionController::class);
Route::get('/educationalinstitutions', [EducationalInstitutionController::class, 'index'])->name('EducationalInstitution.index');
Route::post('/educationalinstitutions', [EducationalInstitutionController::class, 'store'])->name('EducationalInstitution.store');

// Administrar estudiantes - Solo administradores
Route::resource('students',StudentController::class);
Route::get('/students',[StudentController::class,'index'])->name('students.index');
Route::get('/check-email', [StudentController::class, 'checkEmail']);
Route::post('/students', [StudentController::class, 'store'])->name('students.store');

// Administrar actividades - Solo administradores
Route::resource('activities',ActivityController::class);
Route::get('/activities',[ActivityController::class,'index'])->name('activities.index');
Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');

// Login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Register
Route::post('/register', [RegisterController::class, 'register'])->name('register');