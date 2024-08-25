<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\EducationalInstitution;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\Student;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function myinfo(){
        $admin = Admin::all();
        return view('myinformation.myinformationadmin')->with('admin', $admin);
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
    public function edit(string $id)
    {

        $userId = session('id');
        if($userId == $id){
            $admin = Admin::find($id);
            return view('myinformation.editAdmin')->with('admin', $admin);
        }
        else{
            //Vista para el administrador
        }
        
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Se hace el Update en la base de datos
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->password != ""){
            $admin->password = bcrypt($request->password);
        }
        $admin->save();
        return redirect()->route('admin.myinfo',['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Check if the email already exists in the database.
     */
    public function checkEmail(Request $request, $adminId = null)
    {
        $query = Admin::where('email', $request->email);
        if ($adminId) {
            $query->where('adminId', '!=', $adminId);
            $emailExists = User::where('email', $request->email)->exists()
            || Teacher::where('email', $request->email)->exists()
            || $query->exists();
        } else {
            $emailExists = User::where('email', $request->email)->exists()
            || Teacher::where('email', $request->email)->exists()
            || Admin::where('email', $request->email)->exists();
        }
        //$emailExists = $query->exists();
        return response()->json(['emailExists' => $emailExists]);
    }
}
