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
        $request->validate
        ([
            'restriccion' => 
            [
                'required',
                'string',
                'max:100',
                'unique:correos_dominios_restringidos,restriccion',
            ],
        ]);

        CorreoDominioRestringido::create($request->all());

        return redirect()->route('listarRestricciones');
    }

    public function editarRestriccionCorreo($id)
    {
        $correo = CorreoDominioRestringido::find($id);
        return view('restricciones.correos.edit', compact('correo'));
    }

    public function editarRestriccionCorreoPost(Request $request, $id)
    {
        $request->validate
        ([
            'restriccion' => 
            [
                'required',
                'string',
                'max:100',
                'unique:correos_dominios_restringidos,restriccion,' . $id . ',id',
            ],
        ]);

        $correo = CorreoDominioRestringido::find($id);
        $correo->restriccion = $request['restriccion'];
        $correo->save();

        return redirect()->route('listarRestricciones');
    }

    public function eliminarRestriccionCorreoPost($id)
    {
        $correo = CorreoDominioRestringido::find($id);
        $correo->delete();

        return redirect()->route('listarRestricciones');
    }
}
