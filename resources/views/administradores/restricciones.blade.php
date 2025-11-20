<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Restricciones — Administrador</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container-fluid">
  <div class="row">

    <!-- Barra lateral -->
    <nav class="col-12 col-md-3 col-lg-2 bg-dark vh-100 text-white p-3">
      <div class="d-flex flex-column h-100">

        <div class="mb-3 border-bottom border-secondary ps-3">
          <h3 class="h5 text-white mb-3">Administrador</h3>
        </div>

        <!--Acciones supervisores-->
        <div class="accordion flex-grow-0 border-bottom border-secondary" id="sidebarAccordion">

          <!-- DATOS ADMINISTRATIVOS -->
          <div class="accordion-item bg-dark border-0 mt-1">
            <h2 class="accordion-header" id="headingAdmin">
              <button class="accordion-button collapsed bg-dark text-white ps-0 ps-3" type="button"
                      data-bs-toggle="collapse" data-bs-target="#collapseAdmin"
                      aria-expanded="false" aria-controls="collapseAdmin">
                Datos administrativos
              </button>
            </h2>
            <div id="collapseAdmin" class="accordion-collapse collapse"
                 aria-labelledby="headingAdmin" data-bs-parent="#sidebarAccordion">
              <div class="accordion-body p-0">
                <div class="list-group list-group-flush ps-4">
                  <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0 px-0">Gestión de usuarios</a>
                  <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0 px-0">Roles y permisos</a>
                  <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0 px-0">Configuración</a>
                </div>
              </div>
            </div>
          </div>

          <!-- CATÁLOGOS -->
          <div class="accordion-item bg-dark border-0">
            <h2 class="accordion-header" id="headingCatalogos">
              <button class="accordion-button collapsed bg-dark text-white ps-0 ps-3" type="button"
                      data-bs-toggle="collapse" data-bs-target="#collapseCatalogos"
                      aria-expanded="false" aria-controls="collapseCatalogos">
                Catálogos
              </button>
            </h2>
            <div id="collapseCatalogos" class="accordion-collapse collapse"
                 aria-labelledby="headingCatalogos" data-bs-parent="#sidebarAccordion">
              <div class="accordion-body p-0">
                <div class="list-group list-group-flush ps-4">
                  <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0 px-0">Correos restringidos</a>
                  <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0 px-0">Dominios</a>
                  <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0 px-0">Teléfonos restringidos</a>
                </div>
              </div>
            </div>
          </div>

          <!-- ANALÍTICAS -->
          <div class="accordion-item bg-dark border-0 mb-3">
            <h2 class="accordion-header" id="headingAnaliticas">
              <button class="accordion-button collapsed bg-dark text-white ps-0 ps-3" type="button"
                      data-bs-toggle="collapse" data-bs-target="#collapseAnaliticas"
                      aria-expanded="false" aria-controls="collapseAnaliticas">
                Analíticas
              </button>
            </h2>
            <div id="collapseAnaliticas" class="accordion-collapse collapse"
                 aria-labelledby="headingAnaliticas" data-bs-parent="#sidebarAccordion">
              <div class="accordion-body p-0">
                <div class="list-group list-group-flush ps-4">
                  <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0 px-0">Visitas por día</a>
                  <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0 px-0">Tasa de conversión</a>
                  <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0 px-0">Sesiones por dispositivo</a>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- Acciones administradores y supervisores -->
        <div class="mt-3">
          @if(auth()->user()->roles_id === 1)
            <a href="{{ route('registro') }}" class="btn btn-dark w-100 mb-3 text-start">Registrar administrador</a>
          @endif

          <a href="{{ route('listarRestricciones') }}" class="btn btn-dark w-100 mb-3 text-start">Restricciones</a>
          <a href="#" class="btn btn-dark w-100 mb-3 text-start">Descargar métricas</a>
        </div>

        <!-- logout abajo -->
        <div class="mt-auto">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger w-100">Cerrar sesión</button>
          </form>
        </div>
      </div>
    </nav>

    <!-- CONTENIDO -->
    <main class="col-12 col-md-9 col-lg-10 py-4">
      <div class="container">

        <div class="row mb-4 mt-4">
          <div class="col-12">
            <h2 class="mb-0">Restricciones</h3>
          </div>
        </div>

          <!-- CARDS: Correos/Dominios | Nombres | Teléfonos restringidos -->
          <div class="row gy-4">

            <!-- CORREOS / DOMINIOS -->
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card h-100">
                <div class="card-body d-flex flex-column">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Correos / Dominios restringidos</h5>
                    <a href="{{ route('registroRestriccionCorreo') }}" class="btn btn-sm btn-outline-primary" title="Agregar correo/dominio">+</a>
                  </div>

                  <div class="table-responsive mb-3">
                    <table class="table table-borderless table-striped align-middle mb-0">
                      <thead class="table-secondary">
                        <tr>
                          <th>Restricción</th>
                          <th class="text-end" style="width:110px">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($correos as $correo)
                          <tr>
                            <td>{{ $correo->restriccion }}</td>
                            <td class="text-end">
                              <a href="{{ route('editarRestriccionCorreo', $correo->id) }}" class="btn btn-sm btn-outline-secondary" title="Editar">
                                <!-- icono lápiz -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                              </a>

                              <form action="{{ route('eliminarRestriccionCorreoPost', $correo->id) }}" method="POST" class="d-inline-block ms-2" onsubmit="return confirm('¿Eliminar esta restricción de correo/dominio?');">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                  <!-- icono papelera -->
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                  </svg>
                                </button>
                              </form>
                            </td>
                          </tr>
                        @empty
                          <tr><td colspan="2" class="text-muted">No hay restricciones de correos/dominios.</td></tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>

                  <div class="mt-auto">
                    @if(method_exists($correos, 'links'))
                      {{ $correos->links() }}
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <!-- NOMBRES RESTRINGIDOS -->
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card h-100">
                <div class="card-body d-flex flex-column">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Nombres restringidos</h5>
                    <a href="{{ route('registroRestriccionNombre') }}" class="btn btn-sm btn-outline-primary" title="Agregar nombre">+</a>
                  </div>

                  <div class="table-responsive mb-3">
                    <table class="table table-borderless table-striped align-middle mb-0">
                      <thead class="table-secondary">
                        <tr>
                          <th>Nombre</th>
                          <th class="text-end" style="width:110px">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($nombres as $nombre)
                          <tr>
                            <td>{{ $nombre->restriccion }}</td>
                            <td class="text-end">
                              <a href="{{ route('editarRestriccionNombre', $nombre->id) }}" class="btn btn-sm btn-outline-secondary" title="Editar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                              </a>

                              <form action="{{ route('eliminarRestriccionNombrePost', $nombre->id) }}" method="POST" class="d-inline-block ms-2" onsubmit="return confirm('¿Eliminar este nombre restringido?');">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                  </svg>
                                </button>
                              </form>
                            </td>
                          </tr>
                        @empty
                          <tr><td colspan="2" class="text-muted">No hay nombres restringidos.</td></tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>

                  <div class="mt-auto">
                    @if(method_exists($nombres, 'links'))
                      {{ $nombres->links() }}
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <!-- TELÉFONOS RESTRINGIDOS -->
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card h-100">
                <div class="card-body d-flex flex-column">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Teléfonos restringidos</h5>
                    <a href="{{ route('registroRestriccionTelefono') }}" class="btn btn-sm btn-outline-primary" title="Agregar teléfono">+</a>
                  </div>

                  <div class="table-responsive mb-3">
                    <table class="table table-borderless table-striped align-middle mb-0">
                      <thead class="table-secondary">
                        <tr>
                          <th>Teléfono</th>
                          <th class="text-end" style="width:110px">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($telefonos as $telefono)
                          <tr>
                            <td>{{ $telefono->restriccion }}</td>
                            <td class="text-end">
                              <a href="{{ route('editarRestriccionTelefono', $telefono->id) }}" class="btn btn-sm btn-outline-secondary" title="Editar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                              </a>

                              <form action="{{ route('eliminarRestriccionTelefonoPost', $telefono->id) }}" method="POST" class="d-inline-block ms-2" onsubmit="return confirm('¿Eliminar este teléfono restringido?');">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                  </svg>
                                </button>
                              </form>
                            </td>
                          </tr>
                        @empty
                          <tr><td colspan="2" class="text-muted">No hay teléfonos restringidos.</td></tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>

                  <div class="mt-auto">
                    @if(method_exists($telefonos, 'links'))
                      {{ $telefonos->links() }}
                    @endif
                  </div>
                </div>
              </div>
            </div>

          </div>


          {{-- Puedes clonar más tarjetas aquí para otros catálogos (dominios, teléfonos, etc.) --}}
        </div>

      </div>
    </main>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
