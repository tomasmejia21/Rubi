<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\EducationalInstitution;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\Admin;
use App\Models\UserActivity;
use Carbon\Carbon;

class StudentController extends Controller
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

    public function myinfo()
    {
        $students = User::whereHas('role', function($query){
            $query->whereIn('id',[3, 4]);
        })->get();

        return view('myinformation.myinformationstudent')->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $educational_institutions = EducationalInstitution::all();
        $roles = Role::whereIn('id', [3, 4])->get();

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
        $username = strtolower(substr($words[0], 0, 1) . $words[1]);

        $originalUsername = $username;
        $counter = 1;
        while (User::where('username', $username)->exists() || 
           Admin::where('adminUser', $username)->exists() || 
           Teacher::where('teacherUser', $username)->exists()) {
            $username = $originalUsername . $counter;
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
        $educational_institutions = EducationalInstitution::all();
        $roles = Role::all();
        // Se utiliza para consultar los datos a editar
        $student = User::find($id);
        return view('admin.editStudent', compact('educational_institutions', 'roles'))->with('student', $student);
    }

    public function myinfoedit(string $id)
    {
        $student = User::find($id);
        return view('myinformation.editStudent')->with('student', $student);
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

    public function myinfoupdate(Request $request, string $id)
    {
        $student = User::find($id);
        $student -> name = $request->name;
        $student -> email = $request->email;
        if ($request->password != ""){
            $student->password = bcrypt($request->password);
        }
        $student -> save();
        return redirect()->route('students.myinfo',['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = User::find($id);
        $student->status = false;
        $student->save();
        return redirect()->route('students.index');
    }

    // Activar usuario

    public function activate (string $id){
        $student = User::find($id);
        $student->status = true;
        $student->save();
        return redirect()->route('students.index');

    }

    /**
     * Check if the email already exists in the database.
     */
    public function checkEmail(Request $request, $userId = null)
    {
        $query = User::where('email', $request->email);
        if ($userId) {
            $query->where('userId', '!=', $userId);
            $emailExists = Admin::where('email', $request->email)->exists()
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

    public function pdf($id)
    {
        $students = User::where('created_at', '>=', Carbon::now()->subDays(30))->get();
        $pdf = \PDF::loadView('reports.adminReports',compact('students'));
        return $pdf->download('usuarios_recientes.pdf');
    }

    public function pdfNotes()
    {
        // Obtener el ID del usuario autenticado (estudiante)
        $userId = session('id');
    
        // Consultar las actividades resueltas y sus notas desde la tabla user_activities
        $actividades = DB::table('user_activities')
        ->join('activities', 'user_activities.activityId', '=', 'activities.activityId')
        ->where('user_activities.userId', $userId)
        ->select('activities.activityId', 'activities.title', 'activities.question_type', 
                 'user_activities.answer', 'activities.correct_answer', 'user_activities.score')
        ->get();
    
        // Generar el PDF con los datos de las actividades y notas
        $pdf = \PDF::loadView('reports.studentReports', compact('actividades'));
    
        // Descargar el archivo PDF
        return $pdf->download('notas_actividades.pdf');
    }

    public function getUserRegistrationData()
    {
        // Consulta que agrupa los usuarios por mes y cuenta cuántos se registraron en cada mes
        $usersByMonth = User::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Formatear el resultado para que sea más fácil de usar en la vista
        $monthlyData = array_fill(1, 12, 0); // Inicializa el array con 12 meses en 0
        foreach ($usersByMonth as $data) {
            $monthlyData[$data->month] = $data->count;
        }

        return view('admin.adminGraphic')->with('monthlyData', $monthlyData);
        // return view('admin.adminGraphic', compact('monthlyData'));
    }   
   
}