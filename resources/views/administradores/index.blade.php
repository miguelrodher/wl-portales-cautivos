<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard — Administrador</title>

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
      <div class="container-fluid">
        <div class="row mb-4">
          <div class="col-12">
            <h2 class="mb-0">Dashboard</h3>
          </div>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm">
              <div class="card-body">
                <h6 class="card-title">Usuarios (analíticos)</h6>
                <h3 class="card-text">30</h3>
                <small class="text-muted">Registros en tabla usuarios</small>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm">
              <div class="card-body">
                <h6 class="card-title">Sesiones de navegador</h6>
                <h3 class="card-text">150</h3>
                <small class="text-muted">Registros en sesiones_navegadores</small>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm">
              <div class="card-body">
                <h6 class="card-title">Portales cautivos</h6>
                <h3 class="card-text">15</h3>
                <small class="text-muted">Registros en portales_cautivos</small>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm">
              <div class="card-body">
                <h6 class="card-title">Administradores</h6>
                <h3 class="card-text">14</h3>
                <small class="text-muted">Cuentas administrativas</small>
              </div>
            </div>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Últimas sesiones</h5>

                <div class="table-responsive">
                  <table class="table table-sm table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Fecha inicio</th>
                        <th>IP</th>
                        <th>Dispositivo</th>
                        <th>Navegador</th>
                        <th>Usuario</th>
                        <th>Portal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>10-12-2025</td>
                        <td>127.0.0.1</td>
                        <td>iPhone</td>
                        <td>Safari</td>
                        <td>iPhone de Carlos</td>
                        <td>Portal Ciudad de México</td>
                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="card border-primary">
              <div class="card-body">
                <h6>Acciones rápidas</h6>
                <p class="mb-2">En esta vista demo, los botones son ilustrativos.</p>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card border-secondary">
              <div class="card-body">
                <h6>Notas</h6>
                <p class="mb-0 text-muted">Esta interfaz es una maqueta; reemplaza datos por consultas reales cuando lo necesites.</p>
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
