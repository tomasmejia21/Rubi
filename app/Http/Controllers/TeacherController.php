<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;


class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.adminTeacher')->with('teachers', $teachers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Va a la vista createTeacher
        return view('admin.createTeacher');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        // Se crea una instancia
        $teacher = new Teacher();

        // Se genera el ID del profesor
        $date = date('Ymd'); // Obtiene la fecha actual en formato YYYYMMDD
        $count = Teacher::where('teacherId', 'like', $date.'%')->count(); // Cuenta los profesores creados hoy
        $teacherId = $date . str_pad($count, 1, '0', STR_PAD_LEFT); // Añade el contador al final de la fecha

        // Verifica si el ID ya existe en la base de datos
        while (Teacher::where('teacherId', $teacherId)->exists()) {
            // Si el ID ya existe, incrementa el contador y genera un nuevo ID
            $count++;
            $teacherId = $date . str_pad($count, 1, '0', STR_PAD_LEFT);
        }

        // Id del profesor
        $teacher->teacherId = $teacherId;

        // Se genera el nombre de usuario
        $teacherUser = $this->generateteacherUser($request->name);

        // Se asigna como si fuese un constructor
        // Base de datos = los datos del formulario
        $teacher->name = $request->name;
        $teacher->teacherUser = $teacherUser;
        $teacher->email = $request->email;
        $teacher->password = bcrypt($request->password);;
        $teacher->save();
        return redirect()->route('teachers.index');
    }

    private function generateteacherUser($fullName)
    {
        $words = explode(' ', $fullName);
        $teacherUser = strtolower(substr($words[0], 0, 1) . $words[1]);

        $originalteacherUser = $teacherUser;
        $counter = 1;
        while (Teacher::where('teacherUser', $teacherUser)->exists()) {
            $teacherUser = $originalteacherUser . $counter;
            $counter++;
        }

        return $teacherUser;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Se utiliza para consultar los datos a editar
        $teacher = Teacher::find($id);
        return view('admin.editTeacher')->with('teacher', $teacher);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Se hace el Update en la base de datos
        $teacher = Teacher::find($id);
        $teacher->email = $request->email;
        $teacher->save();
        return redirect()->route('teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Para eliminar un registro de la Base de datos
        $teacher = Teacher::find($id);
        $teacher->delete();
        return redirect()->route('teachers.index');
    }
}
