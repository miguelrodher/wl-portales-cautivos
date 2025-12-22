<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

#Consultas a la base de datos #
use App\Services\EstadisticasService;

# Libreria para hacer los PDF #
use Barryvdh\DomPDF\Facade\Pdf;

# Libreria para hacer los archivos excel #
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('estatus');
    }

    public function generarReportePdf(EstadisticasService $estadisticas)
    {
        # Traer los datos de las consultas del servicio #
        $generales = $estadisticas->estadisticasGenerales();
        $portales_por_sesiones = $estadisticas->portalesPorSesiones();

        # Datos de entornos de conexion mas usados #
        $navegadores_mas_usados = $estadisticas->criteriosMasUsados('navegador');
        $sistemas_operativos_mas_usados = $estadisticas->criteriosMasUsados('sistema_operativo');
        $dispositivos_mas_usados = $estadisticas->criteriosMasUsados('dispositivo');
        $idiomas_mas_usados = $estadisticas->criteriosMasUsados('idioma');

        # Datos de los dispositivos de conexion de usuarios y sesiones #
        $tipos_usuarios = $estadisticas->tiposDispositivosMasUsados();

        # Datos de numero de sesiones promedio por año, mes, semana y dia #
        $sesiones_promedio_anio = $estadisticas->sesionesPromedio('year');
        $sesiones_promedio_mes = $estadisticas->sesionesPromedio('month');
        $sesiones_promedio_semana = $estadisticas->sesionesPromedio('week');
        $sesiones_promedio_dia = $estadisticas->sesionesPromedio('day');

        # Numero de registros el ultimo año, mes, semana y dia #
        $registros_anio = $estadisticas->nuevosRegistros('year');
        $registros_mes = $estadisticas->nuevosRegistros('month');
        $registros_semana = $estadisticas->nuevosRegistros('week');
        $registros_dia = $estadisticas->nuevosRegistros('day');

        # Datos de dominios mas usados #
        $dominios_mas_usados = $estadisticas->dominiosMasUsados();

        $pdf = PDF::loadView('reportes.reporte_pdf', compact
            (
                'generales',
                'portales_por_sesiones',
                'navegadores_mas_usados',
                'sistemas_operativos_mas_usados',
                'dispositivos_mas_usados',
                'idiomas_mas_usados',
                'tipos_usuarios',
                'sesiones_promedio_anio',
                'sesiones_promedio_mes',
                'sesiones_promedio_semana',
                'sesiones_promedio_dia',
                'registros_anio',
                'registros_mes',
                'registros_semana',
                'registros_dia',
                'dominios_mas_usados'
            ));

        return $pdf->download('reporte-portales-cautivos.pdf');
    }

    public function generarReporteExcel(EstadisticasService $estadisticas)
    {
        # Traer los datos de las consultas del servicio #
        $generales = collect($estadisticas->estadisticasGenerales());
        $portales_por_sesiones = collect($estadisticas->portalesPorSesiones());

        # Datos de entornos de conexion mas usados #
        $navegadores_mas_usados = collect($estadisticas->criteriosMasUsados('navegador'));
        $sistemas_operativos_mas_usados = collect($estadisticas->criteriosMasUsados('sistema_operativo'));
        $dispositivos_mas_usados = collect($estadisticas->criteriosMasUsados('dispositivo'));
        $idiomas_mas_usados = collect($estadisticas->criteriosMasUsados('idioma'));

        # Datos de los dispositivos de conexion de usuarios y sesiones #
        $tipos_usuarios = collect($estadisticas->tiposDispositivosMasUsados());


        # 1. Datos de numero de sesiones promedio por año, mes, semana y dia #
        $sesiones_promedio_anio = collect($estadisticas->sesionesPromedio('year'));
        $sesiones_promedio_mes = collect($estadisticas->sesionesPromedio('month'));
        $sesiones_promedio_semana = collect($estadisticas->sesionesPromedio('week'));
        $sesiones_promedio_dia = collect($estadisticas->sesionesPromedio('day'));

        # 2. Crear una colección vacía para "armar" la hoja
        $sesiones_promedio_resumen = collect();

        # 3. Función auxiliar para agregar tablas con títulos
        $agregar_sesiones_promedio = function($titulo, $datos) use (&$sesiones_promedio_resumen) {
            // Añadimos el título de la sección
            $sesiones_promedio_resumen->push(['PROMEDIO POR...' => '', 'PROMEDIO SESIONES' => '', 'PROMEDIO USUARIOS' => '']);
            
            // Añadimos los datos
            foreach ($datos as $dato) 
            {
                $sesiones_promedio_resumen->push([
                    'REPORTE' => $titulo, 
                    'PROMEDIO SESIONES' => $dato->promedio_sesiones,
                    'PROMEDIO USUARIOS' => $dato->promedio_usuarios
                ]);
            }
            
            // Añadimos una fila vacía de separación
            $sesiones_promedio_resumen->push(['REPORTE' => '', 'PROMEDIO SESIONES' => '', 'PROMEDIO USUARIOS' => '']);
        };

        # 4. Ejecutamos la unión para cada variable
        $agregar_sesiones_promedio('AÑO', $sesiones_promedio_anio);
        $agregar_sesiones_promedio('MES', $sesiones_promedio_mes);
        $agregar_sesiones_promedio('SEMANA', $sesiones_promedio_semana);
        $agregar_sesiones_promedio('DÍA', $sesiones_promedio_dia);


        # Numero de registros el ultimo año, mes, semana y dia #
        $registros_anio = collect($estadisticas->nuevosRegistros('year'));
        $registros_mes = collect($estadisticas->nuevosRegistros('month'));
        $registros_semana = collect($estadisticas->nuevosRegistros('week'));
        $registros_dia = collect($estadisticas->nuevosRegistros('day'));

        $registros_resumen = collect();

        $agregar_nuevos_registros = function($datos) use (&$registros_resumen) {
            $registros_resumen->push(['NUEVOS REGISTROS DESDE...' => '', 'NUMERO DE REGISTROS' => '']);

            foreach ($datos as $dato) 
            {
                $registros_resumen->push([
                    'NUEVOS REGISTROS DESDE...' => $dato->periodo, 
                    'NUMERO DE REGISTROS' => $dato->numero_registros,
                ]);
            }
            
            $registros_resumen->push(['NUEVOS REGISTROS DESDE...' => '', 'NÚMERO DE REGISTROS' => '']);
        };

        $agregar_nuevos_registros($registros_anio);
        $agregar_nuevos_registros($registros_mes);
        $agregar_nuevos_registros($registros_semana);
        $agregar_nuevos_registros($registros_dia);

        # Datos de dominios mas usados #
        $dominios_mas_usados = collect($estadisticas->dominiosMasUsados());

        # Crear la coleccion de hojas #
        $hojas = new SheetCollection
        ([
            'Generales' => $generales,
            'Portales' => $portales_por_sesiones,
            'Navegadores' => $navegadores_mas_usados,
            'Sistemas Operativos' => $sistemas_operativos_mas_usados,
            'Dispositivos' => $dispositivos_mas_usados,
            'Idiomas' => $idiomas_mas_usados,
            'Tipos de usuarios' => $tipos_usuarios,
            'Sesiones promedio' => $sesiones_promedio_resumen,
            'Nuevos registros' => $registros_resumen,
            'Dominios' => $dominios_mas_usados,
        ]);

        # Descargar el archivo
        return (new FastExcel($hojas))->download('reporte-portales-cautivos.xlsx');
    }
}
