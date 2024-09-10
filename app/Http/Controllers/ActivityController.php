<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

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
        $roleId = session('role_id');
        if ($roleId == 1) {
            // Si el role_id es 1, obten todas las actividades
            $activities = Activity::all();
        } else if ($roleId == 2) {
            $teacherId = session('id');
            // Si el role_id es 2, obten solo las actividades para los módulos creados por el profesor en la sesión
            $activities = Activity::whereHas('module', function ($query) use ($teacherId) {
                $query->where('teacherId', $teacherId);
            })->get();
        } else {
            $activities = collect(); // Retorna una colección vacía si no se cumple ninguna de las condiciones anteriores
        }

        return view('activity.viewActivity')->with('activities', $activities);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roleId = session('role_id');
        $roles = Role::whereIn('id', [3, 4])->get();

        if ($roleId == 1) {
            // Si el role_id es 1, obten todos los módulos
            $modules = Module::all();
        } else if ($roleId == 2) {
            $teacherId = session('id');
            // Si el role_id es 2, obten solo los módulos creados por el profesor en la sesión
            $modules = Module::where('teacherId', $teacherId)->get();
        } else {
            $modules = collect(); // Retorna una colección vacía si no se cumple ninguna de las condiciones anteriores
        }

        return view('activity.createActivity', compact('roles', 'modules'));
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
        $activity = Activity::find($id);
        $responses = $activity->responses;
        return view('activity.showActivity', compact('responses'))->with('activity', $activity);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $activity = Activity::find($id);
        $roles = Role::whereIn('id', [3, 4])->get();
        $modules = Module::all();
        $responses = old('responses', $activity->responses->pluck('content')->toArray());
        
        return view('activity.editActivity', compact('roles', 'modules', 'responses'))->with('activity', $activity);
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

        if ($questionType == 'abierta') {
            // Get all responses associated with the activity
            $responses = Response::where('activity_id', $activity->activityId)->get();

            // Delete each response
            foreach ($responses as $response) {
                $response->delete();
            }
        } elseif ($questionType == 'cerrada') {
            // Get all responses associated with the activity
            $responses = Response::where('activity_id', $activity->activityId)->get();

            // Delete each response
            foreach ($responses as $response) {
                $response->delete();
            }

            // Recreate responses
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
        $activity = Activity::find($id);

        // Get the names of the image and audio files
        $imageName = $activity->image;
        $audioName = $activity->voice_file;

        // Construct the full paths of the image and audio files
        $imagePath = "images/{$imageName}";
        $audioPath = "voices/{$audioName}";

        // Delete the image and audio files if they exist
        if ($imageName && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
        if ($audioName && Storage::disk('public')->exists($audioPath)) {
            Storage::disk('public')->delete($audioPath);
        }

        // Delete the activity
        $activity->delete();

        return redirect()->route('activities.index');
    }
}
