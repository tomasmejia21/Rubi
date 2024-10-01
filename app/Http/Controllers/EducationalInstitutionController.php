<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationalInstitution;

class EducationalInstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $institution = EducationalInstitution::all();
        return view('admin.adminEducationalInstitution')->with('institution', $institution);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.createEducationalInstitution');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Se crea una instancia
        $institution = new EducationalInstitution();

        // Se genera el ID de la institucion educativa
        $date = date('Ymd'); // Obtiene la fecha actual en formato YYYYMMDD
        $count = EducationalInstitution::where('institutionalId', 'like', $date.'%')->count(); // Cuenta los profesores creados hoy
        $institutionalId = $date . str_pad($count, 1, '0', STR_PAD_LEFT); // Añade el contador al final de la fecha

        // Verifica si el ID ya existe en la base de datos
        while (EducationalInstitution::where('institutionalId', $institutionalId)->exists()) {
            // Si el ID ya existe, incrementa el contador y genera un nuevo ID
            $count++;
            $institutionalId = $date . str_pad($count, 1, '0', STR_PAD_LEFT);
        }

        // Se asigna como si fuese un constructor
        // Base de datos = los datos del formulario
        $institution->institutionalId = $institutionalId;
        $institution->name = $request->name;
        $institution->address = $request->address;
        $institution->city = $request->city;
        $institution->country = $request->country;
        $institution->save();
        return redirect()->route('EducationalInstitution.index');

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
        $institution = EducationalInstitution::find($id);
        return view('admin.editEducationalInstitution')->with('institution', $institution);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Se hace el Update en la base de datos
        $institution = EducationalInstitution::find($id);
        $institution->name = $request->name;
        $institution->address = $request->address;
        $institution->city = $request->city;
        $institution->country = $request->country;
        $institution->save();
        return redirect()->route('EducationalInstitution.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $EducationalInstitution = EducationalInstitution::find($id);
        $EducationalInstitution->delete();
        return redirect()->route('EducationalInstitution.index');
    }
}
