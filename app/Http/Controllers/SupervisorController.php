<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;


use App\Models\CuentaAdministrativa;
use App\Models\Rol;

class SupervisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rol');
        $this->middleware('estatus');
    }

    public function registro()
    {
        $roles = Rol::all();
        return view('auth.register', compact('roles'));
    }

    public function registroPost(Request $request)
    {
        $datos_validados = $request->validate
        ([
            'nombre' => ['required', 'min:3', 'max:50', 'regex:/^[A-Za-zñÑáéíóúÁÉÍÓÚ.\s]+$/u'],
            'apellido_paterno' => ['required', 'min:3', 'max:50', 'regex:/^[A-Za-zñÑáéíóúÁÉÍÓÚ.\s]+$/u'],
            'apellido_materno' => ['required', 'min:3', 'max:50', 'regex:/^[A-Za-zñÑáéíóúÁÉÍÓÚ.\s]+$/u'],
            'password' => ['required', 'string', 'min:12', 'max:72', 'confirmed'],
            'email' => ['required', 'email:rfc,dns', 'min:5', 'max:150', 'unique:cuentas_administrativas,email'],
            'roles_id' => ['required'],
        ], 
        [
            // mensajes para "nombre"
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'nombre.max' => 'El nombre no puede exceder 50 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras, acentos en vocales, puntos y espacios.',

            // mensajes para "apellido_paterno"
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'apellido_paterno.min' => 'El apellido paterno debe tener al menos 3 caracteres.',
            'apellido_paterno.max' => 'El apellido paterno no puede exceder 50 caracteres.',
            'apellido_paterno.regex' => 'El apellido paterno solo puede contener letras, acentos en vocales, puntos y espacios.',

            // mensajes para "apellido_materno"
            'apellido_materno.required' => 'El apellido materno es obligatorio.',
            'apellido_materno.min' => 'El apellido materno debe tener al menos 3 caracteres.',
            'apellido_materno.max' => 'El apellido materno no puede exceder 50 caracteres.',
            'apellido_materno.regex' => 'El apellido materno solo puede contener letras, acentos en vocales, puntos y espacios.',

            // mensajes para "contrasena"
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser un texto válido.',
            'password.min' => 'La contraseña debe tener al menos 12 caracteres.',
            'password.max' => 'La contraseña no puede tener más de 72 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',

            // mensajes para "email"
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida (formato RFC).',
            'email.min' => 'El correo electrónico debe tener al menos 5 caracteres.',
            'email.max' => 'El correo electrónico no puede exceder 150 caracteres.',
            'email.unique' => 'El correo electrónico ya está registrado en el sistema.',
        ]);

        $campos = ['nombre', 'apellido_paterno', 'apellido_materno'];

        //NORMALIZACION DE DATOS (QUITAR ESPACIOS EXTRAS Y CONVERTIR A CAMEL CASE EL NOMBRE DEL USUARIO)

        foreach ($campos as $campo)
        {
            $datos_normalizados = $datos_validados;

            $datos_validados[$campo] = mb_strtolower($datos_normalizados[$campo], 'UTF-8');

            $datos_validados[$campo] = mb_convert_case($datos_validados[$campo], MB_CASE_TITLE, 'UTF-8');

            $datos_validados[$campo] = trim(preg_replace('/\s+/u', ' ', $datos_validados[$campo]));

        }
        
        $cuenta = CuentaAdministrativa::create
        ([
            'nombre' => $datos_validados['nombre'],
            'apellido_paterno' => $datos_validados['apellido_paterno'],
            'apellido_materno' => $datos_validados['apellido_materno'],
            'password' => Hash::make($datos_validados['password']),
            'email' => $datos_validados['email'],
            'roles_id' => $datos_validados['roles_id'],
            'estatus' => true,
        ]);

        event(new Registered($cuenta));

        return redirect('/wl');
    }
}
