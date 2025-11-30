<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Portal Cautivo</title>

  @php $bsCss = public_path('vendor/bootstrap/css/bootstrap.min.css'); @endphp
  @if (file_exists($bsCss))
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}?v={{ filemtime($bsCss) }}" rel="stylesheet">
  @else
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  @endif
</head>
<body class="bg-light">

  <main>
    <div class="container-fluid px-0">
      <div class="row gx-0 vh-100">

        <div class="col-12 col-md-6 d-none d-md-flex align-items-center justify-content-center bg-white">
          <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" class="bi bi-card-image text-secondary" viewBox="0 0 16 16">
            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
            <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z"/>
          </svg>
        </div>

        <div class="col-6 d-flex align-items-center justify-content-center bg-light">
          <div class="card shadow-sm">
            <div class="card-body p-4">

              <h3 class="card-title text-center fw-bold mb-4">¡ACCEDE A NUESTRA RED!</h3>

              {{-- Mensaje general de error --}}
              @if ($errors->any())
                <div class="alert alert-danger">
                  <strong>Por favor corrige los errores antes de continuar.</strong>
                </div>
              @endif

              <form action="{{ route('accesoPortalPost') }}" method="POST">
                @csrf

                {{-- Nombre --}}
                <div class="mb-3">
                  <input id="nombre" name="nombre" type="text"
                    class="form-control border border-2 border-dark rounded-1 py-2 @error('nombre') is-invalid @enderror"
                    placeholder="Nombre usuario" value="{{ old('nombre') }}" maxlength="100">
                  @error('nombre')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
                </div>

                {{-- Correo electrónico --}}
                <div class="mb-3">
                  <input id="correo_electronico" name="correo_electronico" type="email"
                    class="form-control border border-2 border-dark rounded-1 py-2 @error('correo_electronico') is-invalid @enderror"
                    placeholder="Correo electrónico" value="{{ old('correo_electronico') }}" maxlength="150">
                  @error('correo')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
                </div>

                {{-- Teléfono --}}
                <div class="mb-3">
                  <input id="telefono" name="telefono" type="text"
                    class="form-control border border-2 border-dark rounded-1 py-2 @error('telefono') is-invalid @enderror"
                    placeholder="Número telefónico" value="{{ old('telefono') }}" maxlength="15">
                  @error('telefono')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
                </div>

                {{-- Acepta condiciones --}}
                <div class="mb-3 d-flex align-items-center align-items-start">
                  <div class="form-check me-2">
                    <input class="form-check-input @error('acepta') is-invalid @enderror" type="checkbox" value="1" id="acepta" name="acepta" style="width:20px;height:20px;">
                  </div>
                  <label class="form-check-label small text-muted" for="acepta">
                    Al acceder, acepto las condiciones del servicio y la política de privacidad.
                  </label>
                </div>
                @error('acepta')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror

                <div class="d-grid mb-2">
                  <button type="submit" class="btn btn-dark btn-lg">ACCEDER</button>
                </div>

                <p class="text-muted small mt-2 mb-0 text-center">Si tienes problemas contacta con el administrador de la red.</p>
              </form>

            </div>
          </div>
        </div>

      </div>
    </div>
  </main>

  @php $bsJs = public_path('vendor/bootstrap/js/bootstrap.bundle.min.js'); @endphp
  @if (file_exists($bsJs))
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}?v={{ filemtime($bsJs) }}"></script>
  @else
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  @endif

</body>
</html>

