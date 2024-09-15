<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\UserActivity;
use App\Models\User;


class UserActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtiene todas las actividades de usuario con una puntuación nula
        $userActivities = UserActivity::whereNull('score')->get();

        // Retorna una vista con las actividades
        return view('teacher.grades', ['userActivities' => $userActivities]);
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
        //
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
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $userId, $activityId)
    {
        $request->validate([
            'grade' => 'required|numeric|between:0,5',
        ]);

        $updated = UserActivity::where('userId', $userId)
                                ->where('activityId', $activityId)
                                ->update(['score' => $request->grade]);

        if (!$updated) {
            return redirect()->back()->with('error', 'No se pudo calificar la actividad');
        }

        return redirect()->back()->with('success', 'Se calificó correctamente la actividad');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function submitAnswer(Request $request, $id)
    {
        $activity = Activity::find($id);
        $answer = $request->input('answer');
        
        if ($activity->question_type == 'abierta') {
            $score = Null;
        }
        if ($activity->question_type == 'cerrada') {
            $score = 0;
            if ($answer == $activity->correct_answer) {
                $score = 5;
            }
        }

        // Guarda la relación entre el usuario y la actividad
        $user = auth()->user();
        $user->activities()->sync([$id => ['score' => $score, 'answer' => $answer]], false);
        
        // Redirige al usuario a la página de actividades con un mensaje de éxito
        return redirect()->route('modules.index')->with('success', 'Respuesta enviada con éxito');
    }
}
