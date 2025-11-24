<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\NombreRestringido;

class NombreRestringidoController extends Controller
{
    public function registroRestriccionNombre()
    {
        return view('restricciones.nombres.create');
    }

    public function registroRestriccionNombrePost(Request $request)
    {
        $datos_validados = $request->validate
        ([
            'restriccion' => ['required', 'min:3', 'max:50',
            'regex:/^[A-Za-zñÑáéíóúÁÉÍÓÚ\p{Han}\p{Hiragana}\p{Katakana}\x{30FB}\x{30FC}\.\s]+$/u',
            'unique:nombres_restringidos,restriccion']
        ],
        [
            'restriccion.required' => 'La restriccion es obigatoria',
            'restriccion.min' => 'El nombre debe tener al menos 3 caracteres',
            'restriccion.max' => 'El nombre no puede exceder los 50 caracteres',
            'restriccion.regex' => 'El nombre solo puede contener mayúsculas, minúsculas, puntos, acentos en vocales y caracteres del idioma japonés y chino',
            'restriccion.unique' => 'Este nombre restringido ya ha sido resgistrado',
        ]);

        //NORMALIZAR LOS DATOS

        $datos_normalizados = $datos_validados;

        $datos_validados['restriccion'] = mb_strtoupper($datos_normalizados['restriccion'], 'UTF-8');

        $datos_validados['restriccion'] = trim(preg_replace('/\s+/u', ' ', $datos_validados['restriccion']));

        $nombre = NombreRestringido::create
        ([
            'restriccion' => $datos_validados['restriccion'],
        ]);

        return redirect()->route('listarRestricciones');
    }

    public function editarRestriccionNombre($id_nombre_restringido)
    {
        $nombre = NombreRestringido::find($id_nombre_restringido);
        return view('restricciones.nombres.edit', compact('nombre'));
    }

    public function editarRestriccionNombrePost(Request $request, $id_nombre_restringido)
    {
        $datos_validados = $request->validate
        ([
            'restriccion' => ['required', 'min:3', 'max:50',
            'regex:/^[A-Za-zñÑáéíóúÁÉÍÓÚ\p{Han}\p{Hiragana}\p{Katakana}\x{30FB}\x{30FC}\.\s]+$/u',
            'unique:nombres_restringidos,restriccion,' . $id_nombre_restringido . ',id',]
        ],
        [
            'restriccion.required' => 'La restriccion es obigatoria',
            'restriccion.min' => 'El nombre debe tener al menos 3 caracteres',
            'restriccion.max' => 'El nombre no puede exceder los 50 caracteres',
            'restriccion.regex' => 'El nombre solo puede contener mayúsculas, minúsculas, puntos, acentos en vocales y caracteres del idioma japonés y chino',
            'restriccion.unique' => 'Este nombre restringido ya ha sido resgistrado',
        ]);

        //NORMALIZAR LOS DATOS

        $datos_normalizados = $datos_validados;

        $datos_validados['restriccion'] = mb_strtoupper($datos_normalizados['restriccion'], 'UTF-8');

        $datos_validados['restriccion'] = trim(preg_replace('/\s+/u', ' ', $datos_validados['restriccion']));  
        

        $nombre = NombreRestringido::find($id_nombre_restringido);
        $nombre->restriccion = $datos_validados['restriccion'];
        $nombre->save();

        return redirect()->route('listarRestricciones');
    }

    public function eliminarRestriccionNombrePost($id_nombre_restringido)
    {
        $nombre = NombreRestringido::find($id_nombre_restringido);
        $nombre->delete();

        return redirect()->route('listarRestricciones');
    }
}
