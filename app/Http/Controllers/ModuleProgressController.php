<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModuleProgress;
use App\Models\Module;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\Activity;

class ModuleProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = session('id');
        $moduleProgress = ModuleProgress::where('userId', $userId)->get();
        $moduleIds = $moduleProgress->pluck('moduleId');
        $modules = Module::whereIn('moduleId', $moduleIds)->get();

        $completedModulesCount = $moduleProgress->where('progress', 100)->count();
        $totalModulesCount = $moduleProgress->count();
        $generalProgress = $completedModulesCount / $totalModulesCount * 100;
    
        $totalActivitiesCount = 0;
        $resolvedActivitiesCount = 0;
        $totalScore = 0;
        $allModulesScored = true;
        foreach ($modules as $module) {
            $activitiesCount = UserActivity::where('userId', $userId)
                ->where('score', '>', 3)
                ->whereIn('activityId', Activity::where('moduleId', $module->moduleId)->pluck('activityId'))
                ->count();

            $totalModuleActivitiesCount = Activity::where('moduleId', $module->moduleId)->count();

            $userActivitiesCount = UserActivity::where('userId', $userId)
                ->whereIn('activityId', Activity::where('moduleId', $module->moduleId)->pluck('activityId'))
                ->count();

            if ($userActivitiesCount < $totalModuleActivitiesCount) {
                $averageScore = "No ha realizado todas las actividades";
            } else {
                $nullScoreExists = UserActivity::where('userId', $userId)
                    ->whereIn('activityId', Activity::where('moduleId', $module->moduleId)->pluck('activityId'))
                    ->whereNull('score')
                    ->exists();

                if ($nullScoreExists) {
                    $averageScore = "Pendiente de calificación";
                } else {
                    $averageScore = round(UserActivity::where('userId', $userId)
                        ->whereIn('activityId', Activity::where('moduleId', $module->moduleId)->pluck('activityId'))
                        ->average('score'), 2);
                }
            }

            $module->activitiesCount = $activitiesCount;
            $module->totalActivitiesCount = $totalModuleActivitiesCount;
            $module->averageScore = $averageScore;

            $totalActivitiesCount += $totalModuleActivitiesCount;
            $resolvedActivitiesCount += $activitiesCount;
            if (is_numeric($averageScore)) {
                $totalScore += $averageScore;
            }

            if (!is_numeric($module->averageScore)) {
                $allModulesScored = false;
            } else {
                $totalScore += $module->averageScore;
            }
        }
        
        $averageScore = $allModulesScored ? $totalScore / $totalModulesCount : "Faltan módulos por completar";

        return view('moduleProgress.viewProgress')->with([
            'moduleProgress' => $moduleProgress,
            'modules' => $modules,
            'generalProgress' => $generalProgress,
            'resolvedActivitiesCount' => $resolvedActivitiesCount,
            'totalActivitiesCount' => $totalActivitiesCount,
            'averageScore' => $averageScore,
        ]);
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
