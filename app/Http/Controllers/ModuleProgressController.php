<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModuleProgress;

class ModuleProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $moduleProgress = ModuleProgress::all();
        return view('moduleProgress.viewProgress')->with('moduleProgress', $moduleProgress);
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
        $moduleProgress = new ModuleProgress;
        $moduleProgress->moduleId = $request->moduleId;
        $moduleProgress->userId = $request->userId;
        $moduleProgress->progress = $request->progress;
        $moduleProgress->grade = $request->grade;
        $moduleProgress->save();

        return redirect()->route('module.index');
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
    public function destroy($moduleId, $userId)
    {
        ModuleProgress::where('moduleId', $moduleId)->where('userId', $userId)->delete();

        return redirect()->route('modules.index')->with('success', 'Te has salido del módulo con éxito');
    }
}
