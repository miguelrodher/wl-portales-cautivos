@extends('layouts.app')

@section('title', 'Restricciones')

@section('content')

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
</div>

@endsection