<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TelefonoRestringido;

class TelefonoRestringidoController extends Controller
{
    public function registroRestriccionTelefono()
    {
        return view('restricciones.telefonos.create');
    }

    public function registroRestriccionTelefonoPost(Request $request)
    {
        $datos_validados = $request->validate
        ([
            'restriccion' => ['required', 'min:10', 'max:10', 'regex:/^[0-9]+$/', 'unique:telefonos_restringidos,restriccion']
        ],
        [
            'restriccion.required' => 'La restriccion es obigatoria',
            'restriccion.min' => 'El teléfono debe tener al menos 10 caracteres',
            'restriccion.max' => 'El teléfono no puede exceder los 10 caracteres',
            'restriccion.regex' => 'El teléfono solo puede contener números del 0 al 9 sin espacios',
            'restriccion.unique' => 'Este teléfono restringido ya ha sido resgistrado',
        ]);

        $telefono = TelefonoRestringido::create
        ([
            'restriccion' => $datos_validados['restriccion'],
        ]);

        return redirect()->route('listarRestricciones');
    }

    public function editarRestriccionTelefono($id_telefono_restringido)
    {
        $telefono = TelefonoRestringido::find($id_telefono_restringido);
        return view('restricciones.telefonos.edit', compact('telefono'));
    }

    public function editarRestriccionTelefonoPost(Request $request, $id_telefono_restringido)
    {
        $datos_validados = $request->validate
        ([
            'restriccion' => ['required', 'min:10', 'max:10', 'regex:/^[0-9]+$/', 'unique:telefonos_restringidos,restriccion,' . $id_telefono_restringido . ',id',]
        ],
        [
            'restriccion.required' => 'La restriccion es obigatoria',
            'restriccion.min' => 'El teléfono debe tener al menos 10 caracteres',
            'restriccion.max' => 'El teléfono no puede exceder los 10 caracteres',
            'restriccion.regex' => 'El teléfono solo puede contener números del 0 al 9 sin espacios',
            'restriccion.unique' => 'Este teléfono restringido ya ha sido resgistrado',
        ]);

        $telefono = TelefonoRestringido::find($id_telefono_restringido);
        $telefono->restriccion = $datos_validados['restriccion'];
        $telefono->save();

        return redirect()->route('listarRestricciones');
    }

    public function eliminarRestriccionTelefonoPost($id_telefono_restringido)
    {
        $telefono = TelefonoRestringido::find($id_telefono_restringido);
        $telefono->delete();

        return redirect()->route('listarRestricciones');
    }
}
