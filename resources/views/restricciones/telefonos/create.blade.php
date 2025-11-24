@extends('layouts.app')

@section('title', 'Dashboard — Administrador')

@section('content') 

<div class="row d-flex align-items-center justify-content-center min-vh-100">
  <div class="col-12 col-md-8 col-lg-6">
    <div class="card shadow-sm">
      <div class="card-header bg-light">
        <h4 class="mb-1">Agregar Restricción de Teléfono</h4>
      </div>

      <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('registroRestriccionTelefonoPost') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label for="restriccion" class="form-label">Teléfono restringido:</label>
            <input type="text" name="restriccion" id="restriccion" class="form-control @error('restriccion') is-invalid @enderror" placeholder="Ingrese el teléfono restringido" value="{{ old('restriccion') }}">

            @error('restriccion')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="text-center mt-4">
            <a href="{{ route('listarRestricciones') }}" class="btn btn-secondary me-2">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection