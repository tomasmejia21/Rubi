<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/inicio';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function username()
    {
        return 'username';
    }
    
    protected function redirectTo()
    {
        return '/inicio';
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => ['El nombre de usuario y/o la contraseña son incorrectos.'],
        ]);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Intenta autenticar al usuario en la tabla 'users'
        if (Auth::guard('web')->attempt($this->credentials($request), $request->filled('remember'))) {
            // Almacena el tipo de usuario, el role_id y el userId en la sesión
            $request->session()->put('user_type', 'user');
            $request->session()->put('role_id', Auth::guard('web')->user()->role_id);
            $request->session()->put('username', Auth::guard('web')->user()->username);
            $request->session()->put('email', Auth::guard('web')->user()->email);
            $role = Role::find(Auth::guard('admin')->user()->role_id);
            $request->session()->put('role_name', $role->name);

            return $this->sendLoginResponse($request);
        }

        // Intenta autenticar al usuario en la tabla 'teachers'
        if (Auth::guard('teacher')->attempt(['teacherUser' => $request->username, 'password' => $request->password], $request->filled('remember'))) {
            // Almacena el tipo de usuario, el role_id y el teacherId en la sesión
            $request->session()->put('user_type', 'teacher');
            $request->session()->put('role_id', Auth::guard('teacher')->user()->role_id);
            $request->session()->put('username', Auth::guard('teacher')->user()->teacherUser);
            $request->session()->put('email', Auth::guard('teacher')->user()->email);
            $role = Role::find(Auth::guard('admin')->user()->role_id);
            $request->session()->put('role_name', $role->name);

            return $this->sendLoginResponse($request);
        }

        // Intenta autenticar al usuario en la tabla 'admin'
        if (Auth::guard('admin')->attempt(['adminUser' => $request->username, 'password' => $request->password], $request->filled('remember'))) {
            // Almacena el tipo de usuario, el role_id y el adminId en la sesión
            $request->session()->put('user_type', 'admin');
            $request->session()->put('role_id', Auth::guard('admin')->user()->role_id);
            $request->session()->put('username', Auth::guard('admin')->user()->adminUser);
            $request->session()->put('email', Auth::guard('admin')->user()->email);
            $role = Role::find(Auth::guard('admin')->user()->role_id);
            $request->session()->put('role_name', $role->name);

            return $this->sendLoginResponse($request);
        }

        // Si la autenticación falla, redirige al usuario de vuelta al formulario de login
        return $this->sendFailedLoginResponse($request);
    }

}
