<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte de Portales Cautivos</title>
    <style>
        /* Configuraciones de página */
        @page {
            margin: 100px 50px;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px; /* Reducimos un poco el tamaño para que quepa más información */
            color: #333;
            line-height: 1.4;
        }

        /* Encabezado */
        .header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            color: #bc2a29;
            font-size: 20px;
        }

        /* Contenedor de cada estadística */
        .section {
            margin-bottom: 30px;
            page-break-inside: avoid; /* IMPORTANTE: Evita que la sección se parta en dos páginas */
        }

        .section-title {
            background-color: #f8f9fa;
            border-left: 5px solid #bc2a29;
            padding: 8px 15px;
            margin-bottom: 5px;
            font-size: 16px;
            color: #333;
            text-transform: uppercase;
        }

        .section-description {
            margin-bottom: 15px;
            font-style: italic;
            color: #666;
            font-size: 11px;
        }

        /* Tablas */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            table-layout: fixed; /* Ayuda a mantener proporciones */
        }

        th {
            background-color: #bc2a29;
            color: white;
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 11px;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
            word-wrap: break-word; /* Evita que el texto largo rompa la tabla */
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Pie de página */
        .footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .page-number:before {
            content: "Página " counter(page);
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Reporte Detallado de Estadísticas</h1>
        <span>Fecha de generación: {{ date('d/m/Y H:i:s') }}</span>
    </div>

    <div class="footer">
        <span>Este documento es un reporte automático generado por el sistema. | </span>
        <span class="page-number"></span>
    </div>

    <div class="section">
        <div class="section-title">1. Sesiones por Portales Cautivos</div>
        <div class="section-description">
            Datos de los portales que hasta la fecha han tenido mayor número de conexiones registradas.
        </div>
        <table>
            <thead>
                <tr>
                    <th style="width: 50%;">Portal Cautivo</th>
                    <th>Sesiones</th>
                    <th>Usuarios</th>
                </tr>
            </thead>
            <tbody>
                @foreach($portales_por_sesiones as $item)
                <tr>
                    <td>{{ $item->portal_cautivo }}</td>
                    <td>{{ number_format($item->numero_sesiones) }}</td>
                    <td>{{ number_format($item->numero_usuarios) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">2. Navegadores más usados</div>
        <div class="section-description">
            Navegadores más usados para conectarse a la red.
        </div>
        <table>
            <thead>
                <tr>
                    <th>Navegador</th>
                    <th>Sesiones</th>
                    <th>Usuarios</th>
                </tr>
            </thead>
            <tbody>
                @foreach($navegadores_mas_usados as $navegador_mas_usado)
                <tr>
                    <td>{{ $navegador_mas_usado->criterio }}</td>
                    <td>{{ $navegador_mas_usado->numero_sesiones }}</td>
                    <td>{{ $navegador_mas_usado->numero_usuarios }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">3. Sistemas operativos más usados</div>
        <div class="section-description">
            Sistemas operativos con más sesiones registradas.
        </div>
        <table>
            <thead>
                <tr>
                    <th>Sistema operativo</th>
                    <th>Sesiones</th>
                    <th>Usuarios</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sistemas_operativos_mas_usados as $sistema_operativo_mas_usado)
                <tr>
                    <td>{{ $sistema_operativo_mas_usado->criterio }}</td>
                    <td>{{ $sistema_operativo_mas_usado->numero_sesiones }}</td>
                    <td>{{ $sistema_operativo_mas_usado->numero_usuarios }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">4. Dispositivos más usados</div>
        <div class="section-description">Dispositivos que usan más los usuarios para conectarse.</div>
        <table>
            <thead>
                <tr>
                    <th>Tipo de dispositivo</th>
                    <th>Sesiones</th>
                    <th>Usuarios</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dispositivos_mas_usados as $dispositivo_mas_usado)
                <tr>
                    <td>{{ $dispositivo_mas_usado->criterio }}</td>
                    <td>{{ $dispositivo_mas_usado->numero_sesiones }}</td>
                    <td>{{ $dispositivo_mas_usado->numero_usuarios }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">5. Idiomas más comunes</div>
        <div class="section-description">Idiomas del navegador usado más comunes para conectarse.</div>
        <table>
            <thead>
                <tr>
                    <th style="width: 50%;">Idioma(s)</th>
                    <th>Sesiones</th>
                    <th>Usuarios</th>
                </tr>
            </thead>
            <tbody>
                @foreach($idiomas_mas_usados as $idioma_mas_usado)
                <tr>
                    <td>{{ $idioma_mas_usado->criterio }}</td>
                    <td>{{ $idioma_mas_usado->numero_sesiones }}</td>
                    <td>{{ $idioma_mas_usado->numero_usuarios }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">6. Tipos de usuarios (de acuerdo al dispositivo)</div>
        <div class="section-description">Tipos de dispositivos por los cuales se conectan los usuarios.</div>
        <table>
            <thead>
                <tr>
                    <th>Tipo de usuario</th>
                    <th>Sesiones</th>
                    <th>Usuarios</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tipos_usuarios as $tipo_usuario)
                <tr>
                    <td>{{ $tipo_usuario->tipo_dispositivo }}</td>
                    <td>{{ $tipo_usuario->numero_sesiones }}</td>
                    <td>{{ $tipo_usuario->numero_usuarios }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">7. Sesiones promedio</div>
        <div class="section-description">Sesiones promedio que se hacen por año, mes, semana y día.</div>
        <table>
            <thead>
                <tr>
                    <th>Promedio por:</th>
                    <th>Año</th>
                    <th>Mes</th>
                    <th>Semana</th>
                    <th>Día</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sesiones</td>
                    <td>{{ $sesiones_promedio_anio[0]->promedio_sesiones }}</td>
                    <td>{{ $sesiones_promedio_mes[0]->promedio_sesiones }}</td>
                    <td>{{ $sesiones_promedio_semana[0]->promedio_sesiones }}</td>
                    <td>{{ $sesiones_promedio_dia[0]->promedio_sesiones }}</td>
                </tr>
                <tr>
                    <td>Usuarios</td>
                    <td>{{ $sesiones_promedio_anio[0]->promedio_usuarios }}</td>
                    <td>{{ $sesiones_promedio_mes[0]->promedio_usuarios }}</td>
                    <td>{{ $sesiones_promedio_semana[0]->promedio_usuarios }}</td>
                    <td>{{ $sesiones_promedio_dia[0]->promedio_usuarios }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">8. Nuevos usuarios registrados</div>
        <div class="section-description">Usuarios que se han registrado por primera vez en el año, mes, semana y día.</div>
        <table>
            <thead>
                <tr>
                    <th>Registro por:</th>
                    <th>Año (desde {{ $registros_anio[0]->periodo }})</th>
                    <th>Mes (desde {{ $registros_mes[0]->periodo }})</th>
                    <th>Semana (desde {{ $registros_semana[0]->periodo }})</th>
                    <th>Día (desde {{ $registros_dia[0]->periodo }})</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Usuarios registrados</td>
                    <td>{{ $registros_anio[0]->numero_registros }}</td>
                    <td>{{ $registros_mes[0]->numero_registros }}</td>
                    <td>{{ $registros_semana[0]->numero_registros }}</td>
                    <td>{{ $registros_dia[0]->numero_registros }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">9. Dominios más usados</div>
        <div class="section-description">Dominios más usados en los correos de los usuarios.</div>
        <table>
            <thead>
                <tr>
                    <th>Dominio</th>
                    <th>Usuarios</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dominios_mas_usados as $dominio_mas_usado)
                <tr>
                    <td>{{ $dominio_mas_usado->dominio }}</td>
                    <td>{{ $dominio_mas_usado->numero_usuarios }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>