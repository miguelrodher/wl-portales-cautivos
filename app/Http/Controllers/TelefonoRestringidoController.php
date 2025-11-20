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
        $request->validate
        ([
            'restriccion' => 
            [
                'required',
                'string',
                'max:10',
                'unique:telefonos_restringidos,restriccion',
            ],
        ]);

        TelefonoRestringido::create($request->all());

        return redirect()->route('listarRestricciones');
    }

    public function editarRestriccionTelefono($id)
    {
        $telefono = TelefonoRestringido::find($id);
        return view('restricciones.telefonos.edit', compact('telefono'));
    }

    public function editarRestriccionTelefonoPost(Request $request, $id)
    {
        $request->validate
        ([
            'restriccion' => 
            [
                'required',
                'string',
                'max:10',
                'unique:telefonos_restringidos,restriccion,' . $id . ',id',
            ],
        ]);

        $telefono = TelefonoRestringido::find($id);
        $telefono->restriccion = $request['restriccion'];
        $telefono->save();

        return redirect()->route('listarRestricciones');
    }

    public function eliminarRestriccionTelefonoPost($id)
    {
        $telefono = TelefonoRestringido::find($id);
        $telefono->delete();

        return redirect()->route('listarRestricciones');
    }
}
