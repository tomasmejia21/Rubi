<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EducationalInstitution;
use App\Models\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$students = User::all();
        $students = User::whereHas('role', function($query) {
            $query->whereIn('id', [3, 4]);
        })->get();

        return view('admin.adminStudent')->with('students',$students);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $educational_institutions = EducationalInstitution::all();
        $roles = Role::all();

        return view('admin.createStudent', compact('educational_institutions', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student = new User();

        $date = date('Ymd'); // Obtiene la fecha actual en formato YYYYMMDD
        $count = User::where('userId', 'like', $date.'%')->count(); // Cuenta los profesores creados hoy
        $userId = $date . str_pad($count, 1, '0', STR_PAD_LEFT); // Añade el contador al final de la fecha

        while (User::where('userId', $userId)->exists()) {
            // Si el ID ya existe, incrementa el contador y genera un nuevo ID
            $count++;
            $userId = $date . str_pad($count, 1, '0', STR_PAD_LEFT);
        }

        // Se genera el nombre de usuario
        $studentUsername = $this->generateUsername($request->name);

        // Se asigna como si fuese un constructor
        // Base de datos = los datos del formulario
        $student->userId = $userId;
        $student->name = $request->name;
        $student->username = $studentUsername;
        $student->email = $request->email;
        $student->role_id = $request->role_id;
        $student->institutionalId = $request->institution;
        $student->password = bcrypt($request->password);
        $student->save();
        return redirect()->route('students.index');
    }

    private function generateUsername($fullName)
    {
        $words = explode(' ', $fullName);
        $Username = strtolower(substr($words[0], 0, 1) . $words[1]);

        $originalUsername = $Username;
        $counter = 1;
        while (User::where('username', $Username)->exists()) {
            $Username = $originalUsername . $counter;
            $counter++;
        }

        return $Username;
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
        $educational_institutions = EducationalInstitution::all();
        $roles = Role::all();
        // Se utiliza para consultar los datos a editar
        $student = User::find($id);
        return view('admin.editStudent', compact('educational_institutions', 'roles'))->with('student', $student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Se hace el Update en la base de datos
        $student = User::find($id);
        $student->email = $request->email;
        $student->save();
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = User::find($id);
        $student->delete();
        return redirect()->route('students.index');
    }
}
