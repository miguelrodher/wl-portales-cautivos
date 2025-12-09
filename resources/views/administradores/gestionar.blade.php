@extends('layouts.app')

@section('title', 'Usuarios — Administrador')

@section('content')
<div class="row mb-4 mt-4">
  <div class="col-12 d-flex justify-content-between align-items-center">
    <h2 class="mb-0">Usuarios</h2>
  </div>
</div>

<div class="row mb-3 mt-4">
  <div class="col-12">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
  </div>
</div>

<div class="row mb-4 mt-4">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>ID</th>
                <th>Nombre completo</th>
                <th>Correo</th>
                <th>Rol</th>
                <th class="text-center">Estatus</th>
                <th class="text-end">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @forelse($administradores as $administrador)
                <tr>
                  <td>{{ $administrador->id }}</td>
                  <td>{{ $administrador->nombre . ' ' . $administrador->apellido_paterno . ' ' . $administrador->apellido_materno}}</td>
                  <td>{{ $administrador->email }}</td>
                  <td>{{ $administrador->rol->rol }}</td>

                  {{-- Mostrar por estatus booleano y botón para togglear --}}
                  <td class="text-center">

                    @php
                      $activo = $administrador->estatus;
                    @endphp

                    {{-- Formulario simple que envía POST para togglear --}}
                    <form action="{{ route('cambiarEstatusAdministradorPost', $administrador->id) }}" 
                      method="POST" class="d-inline"
                      onsubmit="return confirm('{{ $activo ? '¿Esta seguro de querer suspender este usuario?' : '¿Desea activar este usuario?' }}');">
                      @csrf
                      <button type="submit" class="btn btn-sm {{ $activo ? 'btn-outline-success' : 'btn-outline-danger' }}" 
                              title="{{ $activo ? 'Seleccione para suspender usuario' : 'Seleccione para activar usuario' }}">
                        {{ $activo ? 'Activo' : 'Suspendido' }}
                      </button>
                    </form>
                  </td>

                  <td class="text-end">
                    {{-- Editar --}}
                    <a href="{{ route('editarAdministrador', $administrador->id) }}" class="btn btn-sm btn-outline-secondary" title="Editar">
                      <!-- icono lápiz -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                      </svg>
                    </a>

                    {{-- Eliminar --}}
                    <form action="{{ route('eliminarAdministradorPost', $administrador->id) }}" method="POST" class="d-inline-block ms-2" onsubmit="return confirm('¿Eliminar este administrador?');">
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
                <tr>
                  <td colspan="7" class="text-center py-4">
                    No hay usuarios registrados.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        {{-- Paginación (espera que el controlador pase un paginator) --}}
        <div class="d-flex justify-content-between align-items-center mt-3">
          <div>
            @if(method_exists($administradores, 'total'))
              <small class="text-muted">Mostrando {{ $users->count() }} de {{ $users->total() }} usuarios</small>
            @endif
          </div>
          <div>
            
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection
