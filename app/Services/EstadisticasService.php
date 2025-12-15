<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class EstadisticasService
{
    public function estadisticasGenerales()
    {
        return DB::select
        (
            "SELECT COUNT(sesiones_navegadores.id) AS numero_sesiones,
                COUNT(DISTINCT (usuarios.id)) AS numero_usuarios,
                COUNT(DISTINCT (portales_cautivos.id)) AS numero_portales
                FROM sesiones_navegadores INNER JOIN usuarios ON sesiones_navegadores.usuarios_id = usuarios.id
                INNER JOIN portales_cautivos ON sesiones_navegadores.portales_cautivos_id = portales_cautivos.id
                LIMIT 10;"
        );
    }

    public function estadisticasAdministradores()
    {
        return DB::select
        (
            "SELECT COUNT(cuentas_administrativas.id) AS numero_administradores
                FROM cuentas_administrativas WHERE cuentas_administrativas.id != 1;"
        );
    }

    public function portalesPorSesiones()
    {
        return DB::select
        (
            "SELECT portales_cautivos.nombre AS portal_cautivo, 
                COUNT(sesiones_navegadores.portales_cautivos_id) AS numero_sesiones,
                COUNT(DISTINCT(sesiones_navegadores.usuarios_id)) AS numero_usuarios
                FROM portales_cautivos INNER JOIN sesiones_navegadores ON portales_cautivos.id = sesiones_navegadores.portales_cautivos_id
                GROUP BY portal_cautivo
                ORDER BY numero_sesiones DESC
                LIMIT 10;"
        );
    }

    public function estadisticasSesionesFechas(string $unidad_tiempo)
    {
        $unidad_tiempo_bd = $unidad_tiempo;

        return DB::select
        (
            "SELECT DATE_TRUNC('$unidad_tiempo_bd', created_at)::DATE AS unidad_tiempo,
                COUNT(*) AS numero_sesiones,
                COUNT(DISTINCT (sesiones_navegadores.usuarios_id)) AS numero_usuarios
                FROM sesiones_navegadores
                WHERE created_at >= '2025-01-01' AND created_at < '2027-01-01'
                GROUP BY unidad_tiempo
                ORDER BY unidad_tiempo ASC
            LIMIT 100;"
        );
    }

    public function criteriosMasUsados(string $criterio)
    {
        $criterio_bd = $criterio;

        return DB::select
        (
            "SELECT sesiones_navegadores.$criterio_bd AS criterio, 
                COUNT(sesiones_navegadores.id) AS numero_sesiones,
                COUNT(DISTINCT(sesiones_navegadores.usuarios_id)) AS numero_usuarios
                FROM sesiones_navegadores
                GROUP BY sesiones_navegadores.$criterio_bd
                ORDER BY numero_sesiones DESC
            LIMIT 10;"
        );
    }

    public function tiposDispositivosMasUsados()
    {
        return DB::select
        (
            "SELECT tipos_dispositivos.tipo_dispositivo AS tipo_dispositivo,
               COUNT(sesiones_navegadores.id) AS numero_sesiones,
               COUNT(DISTINCT(sesiones_navegadores.usuarios_id)) AS numero_usuarios
            FROM sesiones_navegadores INNER JOIN tipos_dispositivos ON sesiones_navegadores.tipos_dispositivos_id = tipos_dispositivos.id
            GROUP BY tipo_dispositivo
            ORDER BY numero_sesiones DESC;"
        );
    }

}