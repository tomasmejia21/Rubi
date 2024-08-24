<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Response;
use App\Models\Activity;
use App\Models\Module;
use App\Models\Role;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::all();
        return view('admin.adminActivity')->with('activities', $activities);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::whereIn('id', [3, 4])->get();
        $modules = Module::all();
        return view('admin.createActivity', compact('roles', 'modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $activity = new Activity;

        $date = date('Ymd'); // Obtiene la fecha actual en formato YYYYMMDD
        $count = Activity::where('activityId', 'like', $date.'%')->count(); // Cuenta las actividades creadas hoy
        $activityId = $date . str_pad($count, 2, '0', STR_PAD_LEFT); // Añade el contador al final de la fecha

        while (Activity::where('activityId', $activityId)->exists()) {
            // Si el ID ya existe, incrementa el contador y genera un nuevo ID
            $count++;
            $activityId = $date . str_pad($count, 2, '0', STR_PAD_LEFT);
        }

        $activity->activityId = $activityId;
        $activity->moduleId = $request->moduleId;
        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->role_id = $request->role_id;
        $activity->voice = $request->voice ? true : false;
        $activity->question_type = $request->questionType;
        $activity->response_count = $request->responseCount;
        $activity->correct_answer = $request->response;

        // Handle file upload for image
        if ($request->hasFile('activityImage')) {
            $filename = $request->file('activityImage')->getClientOriginalName();
            $request->file('activityImage')->storeAs('public/images', $filename);
            $activity->image = $filename;
        }

        // Handle file upload for voice file
        if ($request->hasFile('voiceFile')) {
            $filename = $request->file('voiceFile')->getClientOriginalName();
            $request->file('voiceFile')->storeAs('public/voices', $filename);
            $activity->voice_file = $filename;
        }

        $activity->save();  // Asegúrate de guardar la actividad antes de agregar respuestas

        $questionType = $request->questionType;

        if ($questionType == 'cerrada') {
            
            $responses = $request->responses;
            foreach ($responses as $response) {
                $newResponse = new Response;
                $newResponse->activity_id = $activity->activityId;
                $newResponse->text = $response;
                $newResponse->save();
            }
        } 

        return redirect()->route('activities.index');
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
        $activity = Activity::find($id);
        $roles = Role::whereIn('id', [3, 4])->get();
        $modules = Module::all();
        return view('admin.editActivity', compact('roles', 'modules'))->with('activity', $activity);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $activity = Activity::find($id);
        $activity->moduleId = $request->moduleId;
        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->role_id = $request->role_id;
        $activity->voice = $request->voice ? true : false;
        $activity->question_type = $request->questionType;
        $activity->response_count = $request->responseCount;
        $activity->correct_answer = $request->response;

        // Handle file upload for image
        if ($request->hasFile('activityImage')) {
            $filename = $request->file('activityImage')->getClientOriginalName();
            $request->file('activityImage')->storeAs('public/images', $filename);
            $activity->image = $filename;
        }

        // Handle file upload for voice file
        if ($request->hasFile('voiceFile')) {
            $filename = $request->file('voiceFile')->getClientOriginalName();
            $request->file('voiceFile')->storeAs('public/voices', $filename);
            $activity->voice_file = $filename;
        }

        $activity->save();  // Make sure to save the activity before adding responses

        $questionType = $request->questionType;

        if ($questionType == 'cerrada') {
            $responses = $request->responses;
            foreach ($responses as $response) {
                $newResponse = new Response;
                $newResponse->activity_id = $activity->activityId;
                $newResponse->text = $response;
                $newResponse->save();
            }
        } 

        return redirect()->route('activities.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Para eliminar un registro de la Base de datos
        $activity = Activity::find($id);
        $activity->delete();
        return redirect()->route('activities.index');
    }
}
