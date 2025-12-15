<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;

#libreria para agente de usuario
use Jenssegers\Agent\Agent;

use Carbon\Carbon;

use App\Models\Usuario;
use App\Models\SesionNavegador;
use App\Models\TipoDispositivo;

class PortalController extends Controller
{
    public function __construct()
    {
        $this->middleware('api.key');
    }

    public function validarDatosPortal(LoginRequest $request)
    {
        # Buscar o crear usuario #
        $usuario = Usuario::firstOrCreate
        (
            ['correo_electronico' => $request->correo_electronico],
            [
                'nombre' => $request->nombre,
                'telefono' => $request->telefono,
                'fecha_creacion' => Carbon::now()->format('Y-m-d')
            ]
        );

        # Se guarda el agente de usuario en la variable #
        $agente = new Agent();

        # Obtener la lista completa de idiomas (es un array)
        $idiomas = $agente->languages(); 

        # Unir el array en una cadena separada por coma y espacio
        $lista_idiomas = implode(', ', $idiomas);


        # Determinar el tipo de dispositivo de la conexion #
        $tipo_dispositivo = 'Otro';

            if ($agente->isTablet()) {
                $tipo_dispositivo = 'Tablet';
            } elseif ($agente->isMobile()) {
                $tipo_dispositivo = 'Móvil';
            } elseif ($agente->isDesktop()) {
                $tipo_dispositivo = 'Escritorio';
            } elseif ($agente->isRobot()) {
                $tipo_dispositivo = 'Robot';
            }

        # obtener el id de los catalogos de la base de datos #
        $tipos_dispositivos = TipoDispositivo::firstWhere('tipo_dispositivo', $tipo_dispositivo);

        # Mapeo de las columnas para la base de datos #
        $sesion = SesionNavegador::create
        ([
            'fecha_inicio' => Carbon::now(),
            'ip'           => $request->ip(),
            
            # Extracción de datos con la librería Agent #
            'dispositivo'               => $agente->device() ?: '',
            'sistema_operativo'         => $agente->platform() ?: '',
            'version_sistema_operativo' => $agente->version($agente->platform()) ?: '',
            'navegador'                 => $agente->browser() ?: '',
            'version_navegador'         => $agente->version($agente->browser()) ?: '',
            'idioma'                    => $lista_idiomas ?? 'es',
            
            'usuarios_id'  => $usuario->id,
            'portales_cautivos_id'      => $request->portales_cautivos_id,
            'tipos_dispositivos_id' => $tipos_dispositivos->id,
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Usuario validado, acceso permitido'
        ], 200);
    }
}
