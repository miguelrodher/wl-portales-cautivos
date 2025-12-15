@extends('layouts.app')

@section('title', 'Dashboard — Administrador')

@section('content') 

  <div class="row mb-4 mt-4">
    <div class="col-12">
      <h2 class="mb-0">Estadísticas</h2>
      </div>
    </div>

    <div class="row g-3 mb-4">
      <div class="col">
        <div class="card shadow-sm">
          <div class="card-body">
            <h6 class="card-title">Sesiones</h6>
            <h3 class="card-text">{{ $estadisticas_generales[0]->numero_sesiones }}</h3>
            <small class="text-muted">Número de sesiones registradas</small>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card shadow-sm">
          <div class="card-body">
            <h6 class="card-title">Usuarios</h6>
            <h3 class="card-text">{{ $estadisticas_generales[0]->numero_usuarios }}</h3>
            <small class="text-muted">Número de usuarios diferentes registrados</small>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card shadow-sm">
          <div class="card-body">
            <h6 class="card-title">Portales cautivos</h6>
            <h3 class="card-text">{{ $estadisticas_generales[0]->numero_portales }}</h3>
            <small class="text-muted">Número de portales cautivos activos</small>
          </div>
        </div>
      </div>

      @if(auth()->user()->roles_id === 1)
      <div class="col">
        <div class="card shadow-sm">
          <div class="card-body">
            <h6 class="card-title">Administradores</h6>
            <h3 class="card-text">{{ $estadisticas_administradores[0]->numero_administradores }}</h3>
            <small class="text-muted">Administradores registrados</small>
          </div>
        </div>
      </div>
      @endif
    </div>

    <div class="row mb-4">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Portales Cautivos más usados</h5>

            <div class="table-responsive" style="position: relative; height:40vh">
              <table class="table">
                <thead>
                  <tr>
                    <th>Portal Cautivo</th>
                    <th>Número de sesiones</th>
                    <th>Número de usuarios</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($portales_por_sesiones as $portal_por_sesion)
                    <tr>
                      <td>{{ $portal_por_sesion->portal_cautivo }}</td>
                      <td>{{ $portal_por_sesion->numero_sesiones }}</td>
                      <td>{{ $portal_por_sesion->numero_usuarios }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="7" class="text-center py-4">
                        No hay usuarios registrados.
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>

      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <h5 class="col card-title">Portales Cautivos más usados por: </h5>

              <div class="col">
                <select name="unidad_tiempo" id="unidad_tiempo" class="form-select w-auto">
                  <option value="day" {{ $unidad_tiempo_seleccionada == 'day' ? 'selected' : '' }}>Día</option>
                  <option value="week" {{ $unidad_tiempo_seleccionada == 'week' ? 'selected' : '' }}>Semana</option>
                  <option selected value="month" {{ $unidad_tiempo_seleccionada == 'month' ? 'selected' : '' }}>Mes</option>
                  <option value="year" {{ $unidad_tiempo_seleccionada == 'year' ? 'selected' : '' }}>Año</option>
                </select>
              </div>
            </div>

            <div style="position: relative; height:40vh">
              <canvas id="grafica_sesiones_fechas"></canvas>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Entornos de conexión más usados</h5>

            <div style="position: relative; height:40vh">
              <div class="mb-4 d-flex align-items-center gap-2">
                <label for="criterio" class="form-label mb-0">Ordenar por:</label>

                <select name="criterio" id="criterio" class="form-select w-auto">
                  <option selected value="navegador" {{ $criterio_seleccionado == 'navegador' ? 'selected' : '' }}>Navegadores</option>
                  <option value="sistema_operativo" {{ $criterio_seleccionado == 'sistema_operativo' ? 'selected' : '' }}>Sistemas Operativos</option>
                  <option value="dispositivo" {{ $criterio_seleccionado == 'dispositivo' ? 'selected' : '' }}>Dispositivos</option>
                  <option value="idioma" {{ $criterio_seleccionado == 'idioma' ? 'selected' : '' }}>Idiomas</option>
                </select>
              </div>

              <div class="table-responsive" id="tabla_criterios">
                @include('layouts.estadisticas.tabla_estadisticas_criterios', ['estadisticas_criterios' => $estadisticas_criterios, 'criterio_seleccionado' => $criterio_seleccionado])
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Entornos de conexión más usados - Gráfica</h5>

            <div style="position: relative; height:40vh">
              <canvas id="grafica_criterios"></canvas>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- ESTADISTICAS DE LOS TIPOS DE USUARIOS -->
    <div class="row mb-4">

      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Tipos de dispositivos con más sesiones</h5>

            <div style="position: relative; height:30vh">
              <canvas id="grafica_dispositivos_sesiones"></canvas>
            </div>

          </div>
        </div>
      </div>

      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Datos de usuarios</h5>

            <div class="table-responsive" style="position: relative; height:30vh">
              <table class="table">
                <thead>
                  <tr>
                    <th>Tipo de dispositivo</th>
                    <th>Número de sesiones</th>
                    <th>Número de usuarios</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($estadisticas_tipos_usuarios as $estadistica_tipo_usuario)
                    <tr>
                      <td>{{ $estadistica_tipo_usuario->tipo_dispositivo }}</td>
                      <td>{{ $estadistica_tipo_usuario->numero_sesiones }}</td>
                      <td>{{ $estadistica_tipo_usuario->numero_usuarios }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="7" class="text-center py-4">
                        No hay usuarios registrados.
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card">
          <div class="card-body">
              <h5 class="card-title">Tipos de dispositivos con más usuarios</h5>

            <div style="position: relative; height:30vh">
              <canvas id="grafica_dispositivos_usuarios"></canvas>
            </div>

          </div>
        </div>
      </div>

    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () 
    {
      // Obtener valores de los select para tablas y graficas dinamicas //
      const select_sesiones_fechas = document.getElementById('unidad_tiempo');
      const select_criterio = document.getElementById('criterio');

      // Obtener la tabla dinamica //
      const tabla_criterios = document.getElementById('tabla_criterios');

      // Obtener los elementos de graficas //
      const ctx_sesiones_fechas = document.getElementById('grafica_sesiones_fechas').getContext('2d');
      const ctx_criterios = document.getElementById('grafica_criterios').getContext('2d');
      const ctx_dispositivos_sesiones = document.getElementById('grafica_dispositivos_sesiones').getContext('2d');
      const ctx_dispositivos_usuarios = document.getElementById('grafica_dispositivos_usuarios').getContext('2d');

      let datos_criterios = @json($estadisticas_criterios);
      let datos_sesiones_fechas = @json($estadisticas_sesiones_fechas);
      let datos_tipos_usuarios = @json($estadisticas_tipos_usuarios);

      // Grafica de sesiones por fechas //
      let grafica_sesiones_fechas = new Chart(ctx_sesiones_fechas, {
        type: 'line',
        data: {
          labels: datos_sesiones_fechas.map(dato_sesion_fecha => dato_sesion_fecha.unidad_tiempo),
          datasets: [{
            label: 'Número de sesiones',
            data: datos_sesiones_fechas.map(dato_sesion_fecha => dato_sesion_fecha.numero_sesiones),
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 2,
            tension: 0.3, 
            fill: true,   
            pointRadius: 3, 
            pointHoverRadius: 7
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true, // Importante para que el eje Y empiece en 0
              title: {
                display: true,
                text: 'Cantidad de Sesiones'
              }
            },
            x: {
              title: {
                display: true,
                text: 'Meses'
              }
            }
          },
          plugins: {
            tooltip: {
              mode: 'index',
              intersect: false,
            },
            legend: {
              position: 'top',
            }
          }
        }
      });


      // Grafica de entornos de conexion //
      let grafica_criterios = new Chart(ctx_criterios, {
        type: 'bar',
        data: {
                // Mapeamos los datos iniciales
          labels: datos_criterios.map(dato_criterio => dato_criterio.criterio), 
          datasets: [{
            label: 'Número de Sesiones',
            data: datos_criterios.map(dato_criterio => dato_criterio.numero_sesiones),
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: { beginAtZero: true }
          }
        }
      });


      // Grafica de tipos de usuarios por sesiones //
      let grafica_tipos_usuarios_sesiones = new Chart(ctx_dispositivos_sesiones, {
        type: 'pie',
        data: {
          labels: datos_tipos_usuarios.map(dato_tipo_usuario => dato_tipo_usuario.tipo_dispositivo),
          datasets: [{
            label: 'Numero de sesiones',
            data: datos_tipos_usuarios.map(dato_tipo_usuario => dato_tipo_usuario.numero_sesiones),
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            hoverOffset: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'right', // Coloca la leyenda a la derecha
            },
            tooltip: {
              callbacks: {
                // Muestra el porcentaje en el tooltip
                label: function(context) {
                  let label = context.label || '';
                  if (label) {
                    label += ': ';
                  }
                  if (context.parsed !== null) {
                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                    const valor = context.parsed;
                    const porcentaje = Math.round((valor / total) * 100);
                    label += `${valor.toLocaleString()} sesiones (${porcentaje}%)`;
                  }
                  return label;
                }
              }
            },
            title: {
              display: true,
              text: 'Distribución por sesiones'
            }
          }
        }
      });


      // Grafica de tipos de usuarios por usuarios //
      let grafica_tipos_usuarios_usuarios = new Chart(ctx_dispositivos_usuarios, {
        type: 'pie',
        data: {
          labels: datos_tipos_usuarios.map(dato_tipo_usuario => dato_tipo_usuario.tipo_dispositivo),
          datasets: [{
            label: 'Numero de usuarios',
            data: datos_tipos_usuarios.map(dato_tipo_usuario => dato_tipo_usuario.numero_usuarios),
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            hoverOffset: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'right', // Coloca la leyenda a la derecha
            },
            tooltip: {
              callbacks: {
                // Muestra el porcentaje en el tooltip
                label: function(context) {
                  let label = context.label || '';
                  if (label) {
                    label += ': ';
                  }
                  if (context.parsed !== null) {
                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                    const valor = context.parsed;
                    const porcentaje = Math.round((valor / total) * 100);
                    label += `${valor.toLocaleString()} usuarios (${porcentaje}%)`;
                  }
                  return label;
                }
              }
            },
            title: {
              display: true,
              text: 'Distribución por usuario registrado'
            }
          }
        }
      });

      // FUncion que escucha el cambio en el selector para cambiaar los datos de la grafica de sesiones por fechas //
      select_sesiones_fechas.addEventListener('change', function()
      {
        const unidad_tiempo_nueva = this.value;

        const url = '{{ route('inicio') }}?unidad_tiempo=' + unidad_tiempo_nueva;

        fetch(url, 
        {
          headers: { 'X-Requested-With': 'XMLHttpRequest' } 
        })
        .then(response => response.json()) 
        .then(data => {
          actualizarGraficaSesionesFechas(grafica_sesiones_fechas, data.estadisticas_sesiones_fechas);
        })
        .catch(error => {
          console.error('Error al cargar datos:', error);
        });
      });

      // Función que escucha el cambio en el selector para cambiar los datos mostrados por las tablas y graficas //
      select_criterio.addEventListener('change', function() 
      {
        const criterio_nuevo = this.value;

        const url = '{{ route('inicio') }}?criterio=' + criterio_nuevo;

        fetch(url, 
        {
          headers: { 'X-Requested-With': 'XMLHttpRequest' } 
        })
        .then(response => response.json()) 
        .then(data => {
          const nueva_tabla = generarTablaCriterios(data.estadisticas_criterios);
          tabla_criterios.innerHTML = nueva_tabla;

          actualizarGraficaCriterios(grafica_criterios, data.estadisticas_criterios);
        })
        .catch(error => {
          console.error('Error al cargar datos:', error);
        });
      });

    });

    function actualizarGraficaSesionesFechas(chart, nuevosDatos) 
    {
      chart.data.labels = nuevosDatos.map(item => item.unidad_tiempo);

      chart.data.datasets[0].data = nuevosDatos.map(item => item.numero_sesiones);

      chart.update();
    }

    function actualizarGraficaCriterios(chart, nuevosDatos) 
    {
      chart.data.labels = nuevosDatos.map(item => item.criterio);

      chart.data.datasets[0].data = nuevosDatos.map(item => item.numero_sesiones);

      chart.update(); 
    }

    function generarTablaCriterios(estadisticas_criterios) 
    {
      let tabla_criterios = `
            <table class="table">
                <thead>
                    <tr>
                        <th>Criterio</th>
                        <th>Número de sesiones</th>
                        <th>Número de usuarios</th>
                    </tr>
                </thead>
                <tbody>
      `;

      if (estadisticas_criterios.length === 0) 
      {
        tabla_criterios += `
                <tr>
                    <td colspan="3" class="text-center py-4">
                        No hay datos registrados.
                    </td>
                </tr>
        `;
      } 
      else 
      {
        estadisticas_criterios.forEach(estadistica_criterio => 
        {
          tabla_criterios += `
                    <tr>
                        <td>${estadistica_criterio.criterio}</td>
                        <td>${estadistica_criterio.numero_sesiones}</td>
                        <td>${estadistica_criterio.numero_usuarios}</td>
                    </tr>
          `;
        });
      }

      tabla_criterios += `</tbody></table>`;
      return tabla_criterios;
    }
  </script>
@endsection
