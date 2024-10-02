<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationalInstitution;

class ReactEducationalInstitutionController extends Controller
{
    public function index()
    {
        return EducationalInstitution::all();
    }

    public function store(Request $request)
    {
        $institution = new EducationalInstitution();

        $date = date('Ymd');
        $count = EducationalInstitution::where('institutionalId', 'like', $date.'%')->count();
        $institutionalId = $date . str_pad($count, 1, '0', STR_PAD_LEFT);

        while (EducationalInstitution::where('institutionalId', $institutionalId)->exists()) {
            $count++;
            $institutionalId = $date . str_pad($count, 1, '0', STR_PAD_LEFT);
        }

        $institution->institutionalId = $institutionalId;
        $institution->fill($request->all());
        $institution->save();

        return response()->json($institution, 201);
    }

    public function show($institutionalId)
    {
        $institution = EducationalInstitution::findOrFail($institutionalId);
        return $institution;
    }

    public function update(Request $request, $institutionalId)
    {
        $institution = EducationalInstitution::findOrFail($institutionalId);
        $institution->update($request->all());
        return $institution;
    }

    public function destroy($institutionalId)
    {
        $institution = EducationalInstitution::findOrFail($institutionalId);
        $institution->status = false;
        $institution->save();
        return response()->json(['message' => 'The institution status has been set to false'], 200);
    }
}
