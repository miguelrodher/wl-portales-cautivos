<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Agregar restricción — Administrador</title>

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

    <!-- CONTENIDO: formulario para agregar correo restringido -->
    <main class="col-12 col-md-9 col-lg-10 py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm">
              <div class="card-header bg-light">
                <h4 class="mb-0">Agregar Restricción de Correo</h4>
              </div>

              <div class="card-body">
                @if(session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('registroRestriccionCorreoPost') }}" method="POST">
                  @csrf

                  <div class="mb-3">
                    <label for="restriccion" class="form-label">Restricción</label>
                    <input type="text" name="restriccion" id="restriccion"
                      class="form-control @error('restriccion') is-invalid @enderror"
                      placeholder="Ingrese el nuevo correo o dominio restringido"
                      value="{{ old('restriccion') }}">

                    @error('restriccion')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="d-flex justify-content-end">
                    <a href="{{ route('listarRestricciones') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
