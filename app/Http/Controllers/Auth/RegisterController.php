<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\EducationalInstitution;
use App\Models\Role;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
            'institution' => ['required', 'integer', 'exists:educational_institutions,institutionalId'],
        ]);
    }

    protected function create(array $data)
    {
        $username = $this->generateUsername($data['name']);
        $date = date('Ymd'); // Obtiene la fecha actual en formato YYYYMMDD
        $count = User::where('userId', 'like', $date.'%')->count(); // Cuenta los usuarios creados hoy
        $userId = $date . str_pad($count + 1, 1, '0', STR_PAD_LEFT); // Añade el contador al final de la fecha

        // Verifica si el ID ya existe en la base de datos
        while (User::where('userId', $userId)->exists()) {
            // Si el ID ya existe, incrementa el contador y genera un nuevo ID
            $count++;
            $userId = $date . str_pad($count + 1, 1, '0', STR_PAD_LEFT);
        }

        return User::create([
            'userId' => $userId,
            'username' => $username,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
            'institutionalId' => $data['institution'],
        ]);
    }

    private function generateUsername($fullName)
    {
        $words = explode(' ', $fullName);
        $username = strtolower(substr($words[0], 0, 1) . $words[1]);

        $originalUsername = $username;
        $counter = 1;
        while (User::where('username', $username)->exists()) {
            $username = $originalUsername . $counter;
            $counter++;
        }

        return $username;
    }

    /**
     * Show the application registration form.
     */

    public function showRegistrationForm()
    {
        $educational_institutions = EducationalInstitution::all();
        $roles = Role::whereIn('id', [3, 4])->get();
        return view('auth.register', ['educational_institutions' => $educational_institutions, 'roles' => $roles]);
    }
}