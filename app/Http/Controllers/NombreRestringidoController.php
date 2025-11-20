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
        $request->validate
        ([
            'restriccion' => 
            [
                'required',
                'string',
                'max:50',
                'unique:nombres_restringidos,restriccion',
            ],
        ]);

        NombreRestringido::create($request->all());

        return redirect()->route('listarRestricciones');
    }

    public function editarRestriccionNombre($id)
    {
        $nombre = NombreRestringido::find($id);
        return view('restricciones.nombres.edit', compact('nombre'));
    }

    public function editarRestriccionNombrePost(Request $request, $id)
    {
        $request->validate
        ([
            'restriccion' => 
            [
                'required',
                'string',
                'max:50',
                'unique:nombres_restringidos,restriccion,' . $id . ',id',
            ],
        ]);

        $nombre = NombreRestringido::find($id);
        $nombre->restriccion = $request['restriccion'];
        $nombre->save();

        return redirect()->route('listarRestricciones');
    }

    public function eliminarRestriccionNombrePost($id)
    {
        $nombre = NombreRestringido::find($id);
        $nombre->delete();

        return redirect()->route('listarRestricciones');
    }
}
