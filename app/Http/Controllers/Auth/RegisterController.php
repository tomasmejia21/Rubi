<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use App\Models\EducationalInstitution;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\Admin;

use Session;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password' => ['required', 'string', 'min:5', 'confirmed'],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
            'institution' => ['required', 'integer', 'exists:educational_institutions,institutionalId'],
            'g-recaptcha-response' => function($attribute, $value, $fail) {
                $secretKey = env('NOCAPTCHA_SECRET');
                $response = $value;
                $userIP = $_SERVER['REMOTE_ADDR'];
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                $response = \file_get_contents($url);
                $responseKeys = json_decode($response, true);
                if(!$responseKeys["success"]) {
                    Session::flash('g-recaptcha-response', 'Por favor, marca el captcha.');
                    Session::flash('alert-class', 'alert-danger');
                    $fail($attribute.'google reCAPTCHA failed');
                }
            }
        ]);
    }

    public function checkEmail(Request $request)
    {
        $emailExists = User::where('email', $request->email)->exists()
            || Teacher::where('email', $request->email)->exists()
            || Admin::where('email', $request->email)->exists();

        return response()->json(['emailExists' => $emailExists]);
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

        // Redirige al usuario a la página de inicio de sesión y muestra un mensaje con su nombre de usuario
        return redirect('/login')->with('username', $user->username);
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
     * Show the application registration form.
     */

    public function showRegistrationForm()
    {
        $educational_institutions = EducationalInstitution::all();
        $roles = Role::whereIn('id', [3, 4])->get();
        return view('auth.register', ['educational_institutions' => $educational_institutions, 'roles' => $roles]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // Agrega un valor 'registered' a la sesión
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath())->with('username', $user->username)->with('registered', true);
    }
}