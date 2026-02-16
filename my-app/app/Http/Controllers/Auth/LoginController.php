<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Este controlador se encarga de autenticar a los usuarios para la aplicación
    | y redirigirlos a la pantalla de inicio o a una página personalizada después
    | de iniciar sesión. El controlador usa un trait para proporcionar convenientemente
    | su funcionalidad a las aplicaciones.
    |
    */

    use AuthenticatesUsers;

    /**
     * A dónde redirigir a los usuarios después de iniciar sesión.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Crea una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        // Middleware 'guest' permite que solo los usuarios no autenticados accedan a estas rutas
        $this->middleware('guest')->except('logout');
        // Middleware 'auth' asegura que solo los usuarios autenticados puedan hacer logout
        $this->middleware('auth')->only('logout');
    }

    /**
     * Maneja la autenticación del usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Validación de los campos del formulario
        $this->validateLogin($request);

        // Si las credenciales son correctas, se redirige al usuario
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // Si las credenciales no son correctas, se devuelve un error de validación
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Acción después de la autenticación exitosa.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    protected function authenticated(Request $request, $user)
    {
        // Aquí puedes agregar lógica adicional después de que el usuario se haya autenticado
        // Por ejemplo, almacenar algo en la base de datos, registrar eventos, etc.
        // Ejemplo: Log de un evento cuando el usuario se autentique
        \Log::info('Usuario autenticado: ' . $user->name);
    }
}
