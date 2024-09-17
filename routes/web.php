<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Middleware\Role;
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
use App\Http\Controllers\UserActivityController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

// Login
Route::middleware(['role:administrator|teacher|in-learning-teacher|in-learning-developer'])->group(function () {
    Route::get('/inicio', function () {
        return view('inicio');
    });
});

// Administrar profesores - Solo administradores
Route::middleware(['role:administrator'])->group(function () {
    Route::resource('teachers', TeacherController::class);
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
});

Route::get('/check-email', [TeacherController::class, 'checkEmail']);

// Administrar instituciones educativas - Solo administradores
Route::middleware(['role:administrator'])->group(function () {
    Route::resource('EducationalInstitution', EducationalInstitutionController::class);
    Route::get('/educationalinstitutions', [EducationalInstitutionController::class, 'index'])->name('EducationalInstitution.index');
    Route::post('/educationalinstitutions', [EducationalInstitutionController::class, 'store'])->name('EducationalInstitution.store');
});

// Administrar estudiantes - Solo administradores
Route::middleware(['role:administrator'])->group(function () {
    Route::resource('students',StudentController::class);
    Route::get('/students',[StudentController::class,'index'])->name('students.index');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
});

Route::get('/check-email', [StudentController::class, 'checkEmail']);

// Administrar actividades - Administradores y profesores
Route::middleware(['role:administrator|teacher'])->group(function () {
    Route::resource('activities',ActivityController::class);
    Route::get('/activities',[ActivityController::class,'index'])->name('activities.index');
    Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
});

// Inscribir módulo - Estudiantes (ILD y ILT)
Route::middleware(['role:in-learning-teacher|in-learning-developer'])->group(function () {
    Route::get('/enrollModules', [ModuleController::class, 'indexEnroll'])->name('modules.indexEnroll');
    Route::post('/enrollModules/{module}/subscribe', [ModuleController::class, 'subscribe'])->name('modules.subscribe');
    Route::delete('/modules/{module}/unsubscribe/{userId}', [ModuleProgressController::class, 'destroy'])->name('modules.unsubscribe');
});

// Ver progreso - Estudiantes (ILD y ILT)
Route::middleware(['role:in-learning-teacher|in-learning-developer'])->group(function () {
    Route::resource('moduleProgress', ModuleProgressController::class); 
    Route::get('/moduleProgress', [ModuleProgressController::class, 'index'])->name('moduleProgress.index');
});

// Progreso en actividades
Route::middleware(['role:administrator|teacher|in-learning-teacher|in-learning-developer'])->group(function () {
    Route::post('/user_activities/submitAnswer/{id}', [UserActivityController::class, 'submitAnswer'])->name('user_activities.submitAnswer');
});


// Mi información - Administradores
Route::middleware(['role:administrator'])->group(function () {
    Route::resource('admin', AdminController::class);
    Route::get('a/myinformation/{id}', [AdminController::class, 'myinfo'])->name('admin.myinfo');
});

// Mi información - Profesores
Route::middleware(['role:teacher'])->group(function () {
    // Route::resource('teachers', TeacherController::class);
    Route::get('t/myinformation/{id}', [TeacherController::class, 'myinfo'])->name('teachers.myinfo');
    Route::get('t/myinformation/{id}/edit', [TeacherController::class, 'myinfoedit'])->name('teachers.myinfoedit');
    Route::put('t/myinformation/{id}/edit/update', [TeacherController::class, 'myinfoupdate'])->name('teachers.myinfoupdate');
});

// Mi información - Estudiantes (ILD y ILT)
Route::middleware(['role:in-learning-teacher|in-learning-developer'])->group(function () {
    // Route::resource('students', StudentController::class);
    Route::get('s/myinformation/{id}', [StudentController::class, 'myinfo'])->name('students.myinfo');
    Route::get('s/myinformation/{id}/edit', [StudentController::class, 'myinfoedit'])->name('students.myinfoedit');
    Route::put('s/myinformation/{id}/edit/update', [StudentController::class, 'myinfoupdate'])->name('students.myinfoupdate');
});

// Blog
Route::middleware(['role:administrator|teacher|in-learning-teacher|in-learning-developer'])->group(function () {
    Route::get('/blog', function () {
        return view('allPosts',['posts' => Post::where('active',true)->get()]);
    });
});

Route::middleware(['role:administrator|teacher'])->group(function () {
    Route::resource('posts',PostController::class);
    Route::get('/blog/create', [PostController::class, 'index'])->name('posts.index');
    Route::post('/blog/create', [PostController::class, 'store'])->name('posts.store');
});

// Modulos - Administradores y profesores
Route::middleware(['role:administrator|teacher'])->group(function () {
    Route::post('/modules/{id}/files', [ModuleController::class, 'storeFile'])->name('modules.storeFile');
    Route::delete('/modules/{file}/destroy', [ModuleController::class, 'destroyFile'])->name('modules.destroyFile');
});

// Modulos (Vista general) - Todos

Route::middleware(['role:administrator|teacher|in-learning-teacher|in-learning-developer'])->group(function () {
    Route::resource('modules', ModuleController::class);
    Route::get('/modules', [ModuleController::class, 'index'])->name('modules.index');
    Route::get('/modules/{id}', [ModuleController::class, 'show'])->name('modules.show');
});

// Modulos - Actividad
Route::middleware(['role:administrator|teacher|in-learning-teacher|in-learning-developer'])->group(function () {
    Route::get('/modules/activity/{id}', [ActivityController::class, 'show'])->name('activity.show');
});

// Calificaciones - Profesores
Route::middleware(['role:administrator|teacher'])->group(function () {
    Route::resource('grades', UserActivityController::class);
    Route::get('/grades', [UserActivityController::class, 'index'])->name('grades.index');
    Route::post('/grades/{userId}/{activityId}/edit', [UserActivityController::class, 'update'])->name('grades.update');
});

//Reportes
Route::get('a/reports/{id}', [StudentController::class,'pdf'])->name('user.pdf');
Route::get('t/reports/{id}', [TeacherController::class, 'pdf'])->name('teachers.pdf');
Route::get('s/reports/{id}', [StudentController::class, 'pdfNotes'])->name('user.pdfNotes');

//Graficas
Route::middleware(['role:administrator'])->group(function () {
    Route::get('/graphstudents', [StudentController::class, 'getUserRegistrationData'])->name('students.getUserRegistrationData');
});

// Login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Register
Route::post('/register', [RegisterController::class, 'register'])->name('register');