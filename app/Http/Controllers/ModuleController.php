<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Teacher;
use App\Models\ModuleFile;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::all();
        return view('modules')->with('modules', $modules);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::all();
        if(session('role_name') === 'Administrator'){
            return view('modules.createModuleAdmin')->with('teachers', $teachers);
        }
        else if(session('role_name') === 'Teacher'){
            return view('modules.createModuleTeacher')->with('teachers', $teachers);
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
        $teachers = Teacher::all();
        $module = Module::find($id);
        return view('modules.editModuleAdmin', compact('teachers')) ->with('module', $module);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $module = Module::find($id);
        $module -> title = $request -> title;
        $module -> description = $request -> description;
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
}
