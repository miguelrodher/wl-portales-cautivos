<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Usuario;
use Carbon\Carbon;

class PortalController extends Controller
{
    public function accesoPortal()
    {
        return view('portales.login');
    }

    public function accesoPortalPost(Request $request)
    {
        $datos_validados = $request->validate
        ([
            'nombre' => ['required', 'min:3', 'max:50', 'regex:/^[A-Za-zñÑáéíóúÁÉÍÓÚ\p{Han}\p{Hiragana}\p{Katakana}\x{30FB}\x{30FC}\.\s]+$/u'],
            'correo_electronico' => ['required', 'min:5', 'max:150', 'email:rfc,dns'],
            'telefono' => ['required', 'size:10', 'regex:/^[0-9]+$/'],
        ],
        [
            // mensajes para "nombre"
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'nombre.max' => 'El nombre no puede exceder 50 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener mayúsculas, minúsculas, puntos, acentos en vocales y caracteres del idioma japonés y chino',

            // mensajes para "correo_electronico"
            'correo_electronico.required' => 'El correo electrónico es obligatorio.',
            'correo_electronico.min' => 'El correo electrónico debe tener al menos 5 caracteres.',
            'correo_electronico.max' => 'El correo electrónico no puede exceder 150 caracteres.',
            'correo_electronico.email' => 'El correo electrónico debe ser una dirección válida (formato RFC).',

            // mensajes para "telefono"
            'telefono.required' => 'El teléfono es obligatorio',
            'telefono.size' => 'El télefono debe ser de 10 digitos sin espacios',
            'telefono.regex' => 'El teléfono solo puede contener números del 0 al 9'
        ]);

        // Transaccion para insertar al usuario si no es su primera visita o registrarlo en caso contrario

        return DB::transaction(function () use ($datos_validados)
        {
            # Buscar o crear usuario
            $usuario = Usuario::firstOrCreate(
                ['correo_electronico' => $datos_validados['correo_electronico']],
                [
                    'nombre' => $datos_validados['nombre'],
                    'telefono' => $datos_validados['telefono'],
                    'fecha_creacion' => Carbon::now()->format('Y-m-d')
                ]
            );

            dd($usuario);

            return redirect('/portal/inicio');
        });
    }

    public function inicioPortal()
    {
        return view('portales.index');
    }
}
