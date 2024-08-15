<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\EducationalInstitutionController;

Route::get('/', function () {
    return view('welcome');
});
// Administrar profesores - Solo administradores
Route::resource('teachers', TeacherController::class);
Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
Auth::routes();

//Administrar instituciones educativas - Solo administradores
Route::resource('EducationalInstitution', EducationalInstitutionController::class);
Route::get('/educationalinstitutions', [EducationalInstitutionController::class, 'index'])->name('EducationalInstitution.index');
Route::post('/educationalinstitutions', [EducationalInstitutionController::class, 'store'])->name('EducationalInstitution.store');

//Login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');