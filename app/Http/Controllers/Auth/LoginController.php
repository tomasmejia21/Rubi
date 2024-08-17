<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';

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
            return $this->sendLoginResponse($request);
        }

        // Intenta autenticar al usuario en la tabla 'teachers'
        if (Auth::guard('teacher')->attempt(['teacherUser' => $request->username, 'password' => $request->password], $request->filled('remember'))) {
            return $this->sendLoginResponse($request);
        }

        // Intenta autenticar al usuario en la tabla 'admin'
        if (Auth::guard('admin')->attempt(['adminUser' => $request->username, 'password' => $request->password], $request->filled('remember'))) {
            return $this->sendLoginResponse($request);
        }

        // Si la autenticación falla, redirige al usuario de vuelta al formulario de login
        return $this->sendFailedLoginResponse($request);
    }

}
