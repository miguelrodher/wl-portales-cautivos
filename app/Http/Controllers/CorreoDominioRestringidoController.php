<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CorreoDominioRestringido;

class CorreoDominioRestringidoController extends Controller
{
    public function registroRestriccionCorreo()
    {
        return view('restricciones.correos.create');
    }

    public function registroRestriccionCorreoPost(Request $request)
    {
        $datos_validados = $request->validate
        ([
            'restriccion' => ['required', 'min:3', 'max:100',
            "regex:/^[A-Za-z0-9!#$%&'*\+\/=?^_`{|}~\.-]+$/",
            'unique:correos_dominios_restringidos,restriccion']
        ],
        [
            'restriccion.required' => 'La restriccion es obigatoria',
            'restriccion.min' => 'El correo/dominio debe tener al menos 3 caracteres',
            'restriccion.max' => 'El correo/dominio no puede exceder los 100 caracteres',
            'restriccion.regex' => 'El correo/dominio solo puede contener los caracteres permitidos en el protocolo RFC',
            'restriccion.unique' => 'Este correo/dominio restringido ya ha sido resgistrado',
        ]);

        //NORMALIZAR LOS DATOS

        $datos_normalizados = $datos_validados;

        $datos_validados['restriccion'] = mb_strtoupper($datos_normalizados['restriccion'], 'UTF-8');

        $datos_validados['restriccion'] = trim(preg_replace('/\s+/u', ' ', $datos_validados['restriccion']));

        $correo = CorreoDominioRestringido::create
        ([
            'restriccion' => $datos_validados['restriccion'],
        ]);

        return redirect()->route('listarRestricciones');
    }

    public function editarRestriccionCorreo($id_correo_restringido)
    {
        $correo = CorreoDominioRestringido::find($id_correo_restringido);
        return view('restricciones.correos.edit', compact('correo'));
    }

    public function editarRestriccionCorreoPost(Request $request, $id_correo_restringido)
    {
        $datos_validados = $request->validate
        ([
            'restriccion' => ['required', 'min:3', 'max:100',
            "regex:/^[A-Za-z0-9!#$%&'*\+\/=?^_`{|}~\.-]+$/",
            'unique:correos_dominios_restringidos,restriccion,' . $id_correo_restringido . ',id',]
        ],
        [
            'restriccion.required' => 'La restriccion es obigatoria',
            'restriccion.min' => 'El correo/dominio debe tener al menos 3 caracteres',
            'restriccion.max' => 'El correo/dominio no puede exceder los 100 caracteres',
            'restriccion.regex' => 'El correo/dominio solo puede contener los caracteres permitidos en el protocolo RFC',
            'restriccion.unique' => 'Este correo/dominio restringido ya ha sido resgistrado',
        ]);

        //NORMALIZAR LOS DATOS

        $datos_normalizados = $datos_validados;

        $datos_validados['restriccion'] = mb_strtoupper($datos_normalizados['restriccion'], 'UTF-8');

        $datos_validados['restriccion'] = trim(preg_replace('/\s+/u', ' ', $datos_validados['restriccion']));


        $correo = CorreoDominioRestringido::find($id_correo_restringido);
        $correo->restriccion = $datos_validados['restriccion'];
        $correo->save();

        return redirect()->route('listarRestricciones');
    }

    public function eliminarRestriccionCorreoPost($id_correo_restringido)
    {
        $correo = CorreoDominioRestringido::find($id_correo_restringido);
        $correo->delete();

        return redirect()->route('listarRestricciones');
    }
}
