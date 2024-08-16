<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();

        // Se genera el ID del profesor
        $date = date('Ymd'); // Obtiene la fecha actual en formato YYYYMMDD
        $count = User::where('userId', 'like', $date.'%')->count(); // Cuenta los profesores creados hoy
        $userId = $date . str_pad($count, 1, '0', STR_PAD_LEFT); // Añade el contador al final de la fecha

        // Verifica si el ID ya existe en la base de datos
        while (User::where('userId', $userId)->exists()) {
            // Si el ID ya existe, incrementa el contador y genera un nuevo ID
            $count++;
            $userId = $date . str_pad($count, 1, '0', STR_PAD_LEFT);
        }

        // Id del profesor
        $user->userId = $userId;

        // Se genera el nombre de usuario
        $username = $this->generateUserId($request->name);

        // Se asigna como si fuese un constructor
        // Base de datos = los datos del formulario
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Asegúrate de encriptar la contraseña
        $user->role_id = $request->role_id;
        $user->institutionalId = $request->institutionalId;
        $user->save();

        return redirect()->route('/');
    }

    private function generateUserId($fullName)
    {
        $words = explode(' ', $fullName);
        $username = strtolower(substr($words[0], 0, 1) . $words[1]);

        $originalusername = $username;
        $counter = 1;
        while (Teacher::where('username', $username)->exists()) {
            $username = $originalusername . $counter;
            $counter++;
        }

        return $username;
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
