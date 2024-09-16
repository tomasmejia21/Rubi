<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EducationalInstitutionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ModuleProgressController;

Route::get('/', function () {
    return redirect('/login');
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

// Administrar actividades - Administradores y profesores
Route::resource('activities',ActivityController::class);
Route::get('/activities',[ActivityController::class,'index'])->name('activities.index');
Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');

// Inscribir módulo - Estudiantes
Route::get('/enrollModules', [ModuleController::class, 'indexEnroll'])->name('modules.indexEnroll');
Route::post('/enrollModules/{module}/subscribe', [ModuleController::class, 'subscribe'])->name('modules.subscribe');
Route::delete('/modules/{module}/unsubscribe/{userId}', [ModuleProgressController::class, 'destroy'])->name('modules.unsubscribe');

// Mi informacion (header) - Admin
Route::resource('admin', AdminController::class);
Route::get('a/myinformation/{id}', [AdminController::class, 'myinfo'])->name('admin.myinfo');

//Mi informacion (header) - Student
// Route::resource('students', StudentController::class);
Route::get('s/myinformation/{id}', [StudentController::class, 'myinfo'])->name('students.myinfo');
Route::get('s/myinformation/{id}/edit', [StudentController::class, 'myinfoedit'])->name('students.myinfoedit');
Route::put('s/myinformation/{id}/edit/update', [StudentController::class, 'myinfoupdate'])->name('students.myinfoupdate');


//Mi informacion (header) - Teacher
// Route::resource('teachers', TeacherController::class);
Route::get('t/myinformation/{id}', [TeacherController::class, 'myinfo'])->name('teachers.myinfo');
Route::get('t/myinformation/{id}/edit', [TeacherController::class, 'myinfoedit'])->name('teachers.myinfoedit');
Route::put('t/myinformation/{id}/edit/update', [TeacherController::class, 'myinfoupdate'])->name('teachers.myinfoupdate');

// Login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Register
Route::post('/register', [RegisterController::class, 'register'])->name('register');

//Blog
Route::get('/blog', function () {
    return view('allPosts',['posts' => Post::where('active',true)->get()]);
});
Route::resource('posts',PostController::class);
Route::get('/blog/create', [PostController::class, 'index'])->name('posts.index');
Route::post('/blog/create', [PostController::class, 'store'])->name('posts.store');

//Modulos - Admin
Route::resource('modules', ModuleController::class);
Route::get('/modules', [ModuleController::class, 'index'])->name('modules.index');
Route::get('/modules/{id}', [ModuleController::class, 'show'])->name('modules.show');
Route::post('/modules/{id}/files', [ModuleController::class, 'storeFile'])->name('modules.storeFile');
Route::delete('/modules/{file}/destroy', [ModuleController::class, 'destroyFile'])->name('modules.destroyFile');
//Modulos - Actividad
Route::get('/modules/activity/{id}', [ActivityController::class, 'show'])->name('activity.show');