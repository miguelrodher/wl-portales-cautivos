@extends('layouts.app')

@section('title', 'Dashboard — Administrador')

@section('content') 

<div class="row d-flex align-items-center justify-content-center min-vh-100">
  <div class="col-12 col-md-8 col-lg-6">
    <div class="card shadow-sm">
      <div class="card-header bg-light">
        <h3 class="mb-1">Editar correo restringido</h3>
      </div>  

      <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('editarRestriccionCorreoPost', $correo->id) }}" method="POST">
          @csrf

          <div class="mb-3">
            <label class="form-label">Correo o dominio restringido:</label>
            <input type="text" name="restriccion" class="form-control @error('restriccion') is-invalid @enderror" value="{{ old('restriccion', $correo->restriccion) }}" required>

            @error('restriccion')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <div class="text-center mt-4">
            <a href="{{ route('listarRestricciones') }}" class="btn btn-secondary">Cancelar</a>
            <button class="btn btn-primary" type="submit">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection