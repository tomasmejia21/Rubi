<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Teacher;
use App\Models\ModuleFile;
use App\Models\Activity;
use App\Models\ModuleProgress;
use App\Models\UserActivity;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roleId = session('role_id');
        $modules = collect();

        if ($roleId == 1) {
            $modules = Module::all();
        } else if ($roleId == 2) {
            $teacherId = session('id');
            $modules = Module::where('teacherId', $teacherId)->get();
        } else if ($roleId == 3 || $roleId == 4) {
            $userId = session('id');
            $moduleIds = ModuleProgress::where('userId', $userId)->pluck('moduleId');
            $modules = Module::whereIn('moduleId', $moduleIds)->get();
            $user = User::find(session('id'));

            foreach ($modules as $module) {
                $totalActivities = $module->activities()->count();
                $completedActivitiesQuery = UserActivity::where('userId', $user->userId)
                    ->whereIn('activityId', $module->activities()->pluck('activityId'));

                // Define $completedActivities aquí
                $completedActivities = $completedActivitiesQuery->count();

                $progress = $totalActivities > 0 ? ($completedActivities / $totalActivities) * 100 : 0;

                // Encuentra o crea un ModuleProgress para el módulo y usuario actual
                $moduleProgress = ModuleProgress::firstOrCreate(
                    ['moduleId' => $module->moduleId, 'userId' => $user->userId],
                    ['progress' => $progress]
                );

                // Actualiza el progreso
                $moduleProgress->progress = $progress;
                $moduleProgress->save();
            }
        }

        if ($roleId == 3 || $roleId == 4) {
            $progresses = ModuleProgress::where('userId', $userId)->pluck('progress', 'moduleId');
            return view('modules', compact('modules', 'progresses'));
        } else {
            return view('modules')->with('modules', $modules);
        }
    }

    public function indexEnroll()
    {
        $userId = session('id');
        $roleId = session('role_id');

        // Obtiene los moduleId de los módulos en los que el usuario ya está inscrito
        $subscribedModuleIds = ModuleProgress::where('userId', $userId)->pluck('moduleId');

        // Obtiene los módulos en los que el usuario no está inscrito
        if ($roleId == 3 || $roleId == 4) {
            $modules = Module::whereNotIn('moduleId', $subscribedModuleIds)->where('role_id', $roleId)->get();
        } else {
            $modules = Module::whereNotIn('moduleId', $subscribedModuleIds)->get();
        }

        return view('user.enrollModule', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roleId = session('role_id');
        $roles = Role::whereIn('id', [3, 4])->get();

        if ($roleId == 1) {
            // Si el role_id es 1, obten todos los profesores
            $teachers = Teacher::all();
        } else if ($roleId == 2) {
            $teacherId = session('id');
            // Si el role_id es 2, obten solo el profesor en la sesión
            $teachers = Teacher::where('teacherId', $teacherId)->get();
        } else {
            abort(403, 'Acceso no autorizado');
        }

        if(session('role_name') === 'Administrator'){
            return view('modules.createModuleAdmin', compact('teachers', 'roles'));
        }
        else if(session('role_name') === 'Teacher'){
            return view('modules.createModuleTeacher', compact('teachers', 'roles'));
        }
        else {
            abort(403, 'Acceso no autorizado');
        }
    }  

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $module = new Module();
        $module -> title = $request -> title;
        $module -> description = $request -> description;
        $module -> role_id = $request->role_id;
        if(session('role_name') === 'Administrator'){
            $module -> teacherId = $request -> teacher;
        }
        else if(session('role_name') === 'Teacher'){
            $module -> teacherId = session('id');
        }
        $module -> save();
        return redirect()->route('modules.index');
    }

    public function storeFile(Request $request, $moduleId)
    {   
        $file = new ModuleFile();
        $file -> name = $request -> name;
        if ($request->hasFile('file')) {
            $filerqst = $request->file('file');
            $path = Storage::putFile('public/module_files', $filerqst); // Guarda el archivo en el directorio 'module_files'
            $new_path = str_replace('public/', '', $path); // Elimina el prefijo 'public/' del path para almacenarlo en la base de datos
            $file -> file_url = $new_path;
        }
        $file -> moduleId = $moduleId;
        $file -> save();
        return redirect()->route('modules.show',$moduleId);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $module = Module::find($id);
        $files = ModuleFile::where('moduleId', $id)->get(); // Obtener los archivos asociados al módulo
        $activities = Activity::where('moduleId', $id)->get(); // Obtener las actividades asociadas al módulo

        return view('modules.content', compact('module', 'files', 'activities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roleId = session('role_id');
        $teacherId = session('id'); // Asume que tienes el teacher_id en la sesión
        $roles = Role::whereIn('id', [3, 4])->get();
        $module = Module::find($id);

        if ($roleId == 1) {
            // Si el role_id es 1, obten todos los profesores
            $teachers = Teacher::all();
        } else if ($roleId == 2) {
            // Si el role_id es 2, obten solo el profesor en la sesión
            $teachers = Teacher::where('teacherId', $teacherId)->get();
        } else {
            abort(403, 'Acceso no autorizado');
        }

        if ($roleId == 1) {
            // Si el role_id es 1, obten todos los profesores
            $teachers = Teacher::all();
            return view('modules.editModuleAdmin', compact('roles','teachers'))->with('module', $module);
        } else if ($roleId == 2) {
            // Si el role_id es 2, obten solo el profesor en la sesión
            $teachers = Teacher::where('teacherId', $teacherId)->get();
            return view('modules.editModuleTeacher', compact('roles','teachers'))->with('module', $module);
        } else {
            abort(403, 'Acceso no autorizado');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $module = Module::find($id);
        $module -> title = $request -> title;
        $module -> description = $request -> description;
        $module -> role_id = $request->role_id;

        if(session('role_name') === 'Administrator'){
            $module -> teacherId = $request -> teacher;
        }
        $module -> save();
        return redirect()->route('modules.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $module = Module::find($id);
        $files = ModuleFile::where('moduleId', $id)->get();
        foreach ($files as $file) {
            Storage::delete('public/' . $file->file_url);
            $file -> delete();
        }

        // Agrega esta línea para eliminar las actividades asociadas al módulo
        $module->activities()->delete();

        $module -> delete();
        return redirect()->route('modules.index');
    }

    public function destroyFile(string $id)
    {
        $file = ModuleFIle::find($id);
        $moduleId = $file ->moduleId;
        $file -> delete();
        return redirect()->route('modules.show',$moduleId);
        
    }

    public function subscribe(Module $module)
    {
        $userId = session('id');

        // Crea un nuevo moduleProgress
        $moduleProgress = new ModuleProgress;
        $moduleProgress->moduleId = $module->moduleId;
        $moduleProgress->userId = $userId;
        $moduleProgress->progress = 0; // Asume que el progreso inicial es 0
        $moduleProgress->save(); // Llama al método save en la instancia de ModuleProgress
    
        // Redirige al usuario a la página de módulos con un mensaje de éxito
        return redirect()->route('modules.index')->with('success', 'Te has inscrito al módulo con éxito');
    }

    public function unsubscribe(Module $module)
    {
        $userId = session('id');

        // Encuentra y elimina el moduleProgress
        $moduleProgress = ModuleProgress::where(['moduleId' => $module->moduleId, 'userId' => $userId])->first();
        $moduleProgress->delete();

        // Redirige al usuario a la página de módulos con un mensaje de éxito
        return redirect()->route('modules.index')->with('success', 'Te has salido del módulo con éxito');
    }
}
