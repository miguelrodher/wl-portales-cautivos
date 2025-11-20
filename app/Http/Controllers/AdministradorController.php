<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\CorreoDominioRestringido;
use App\Models\NombreRestringido;
use App\Models\TelefonoRestringido;

class AdministradorController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('estatus');
    }

    public function inicio()
    {
        return view('administradores.index');
    }

    public function listarRestricciones()
    {
        $nombres = NombreRestringido::all();
        $telefonos = TelefonoRestringido::all();
        $correos = CorreoDominioRestringido::all();
        return view('administradores.restricciones', compact('nombres', 'telefonos', 'correos'));
    }
}
