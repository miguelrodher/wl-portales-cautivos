<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\CorreoDominioRestringido;
use App\Models\NombreRestringido;
use App\Models\TelefonoRestringido;

#Consultas a la base de datos #
use App\Services\EstadisticasService;

class AdministradorController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('estatus');
    }

    public function inicio(EstadisticasService $estadisticas, Request $request)
    {
        $estadisticas_generales = $estadisticas->estadisticasGenerales();
        $estadisticas_administradores = null;

        if(Auth::id() == 1)
        {
            $estadisticas_administradores = $estadisticas->estadisticasAdministradores();
        }
    


        $portales_por_sesiones = $estadisticas->portalesPorSesiones();

        $unidad_tiempo_seleccionada = $request->input('unidad_tiempo', 'month');

        $estadisticas_sesiones_fechas = $estadisticas->estadisticasSEsionesFechas($unidad_tiempo_seleccionada);



        $criterio_seleccionado = $request->input('criterio', 'navegador');

        $estadisticas_criterios = $estadisticas->criteriosMasUsados($criterio_seleccionado);


        $estadisticas_tipos_usuarios = $estadisticas->tiposDispositivosMasUsados();


        if ($request->ajax()) 
        {
            return response()->json([
                'estadisticas_sesiones_fechas' => $estadisticas_sesiones_fechas,
                'estadisticas_criterios' => $estadisticas_criterios
            ]);
        }

        return view('administradores.index', compact(
            'estadisticas_generales', 
            'estadisticas_administradores',
            'unidad_tiempo_seleccionada',
            'portales_por_sesiones',
            'estadisticas_sesiones_fechas', 
            'estadisticas_criterios', 
            'criterio_seleccionado', 
            'estadisticas_tipos_usuarios'
        ));
    }

    public function listarRestricciones()
    {
        $nombres = NombreRestringido::all();
        $telefonos = TelefonoRestringido::all();
        $correos = CorreoDominioRestringido::all();
        return view('administradores.restricciones', compact('nombres', 'telefonos', 'correos'));
    }
}
