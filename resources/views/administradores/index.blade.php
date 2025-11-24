@extends('layouts.app')

@section('title', 'Dashboard — Administrador')

@section('content') 

  <div class="row mb-4">
    <div class="col-12">
      <h2 class="mb-0">Dashboard</h2>
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
@endsection
