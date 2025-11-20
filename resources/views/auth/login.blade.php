{{-- resources/views/auth/login.blade.php --}}
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Iniciar sesión — Administrador</title>

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light vh-100 d-flex align-items-center">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-10 col-md-6 col-lg-4">
        <div class="card shadow-sm mt-5">
          <div class="card-body p-4">

            <!-- Logo / Icono -->
            <div class="d-flex align-content-end flex-wrap justify-content-center mt-4 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
              </svg>
            </div>

            <!-- Session Status -->
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <!-- Other session error (optional) -->
            @if (session('error'))
              <div class="alert alert-danger" role="alert">
                {{ session('error') }}
              </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <!-- Formulario de login -->
            <form method="POST" action="{{ route('loginPost') }}" class="mt-3">
              @csrf

              <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email"
                       name="email"
                       type="email"
                       class="form-control"
                       value="{{ old('email') }}"
                       autocomplete="email"
                       autofocus
                       placeholder="ejemplo@dominio.com"
                       required>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password"
                       name="password"
                       type="password"
                       class="form-control"
                       autocomplete="current-password"
                       placeholder="Inserte su contraseña"
                       required>
              </div>

              <!--<div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                  <input id="remember" name="remember" type="checkbox" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                  <label for="remember" class="form-check-label">Recuérdame</label>
                </div>

                @if (Route::has('password.request'))
                  <a class="text-decoration-underline small" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                  </a>
                @endif
              </div>-->

              <div class="d-grid mb-2 mt-2 pt-1">
                <button type="submit" class="btn btn-primary">Iniciar sesión</button>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
