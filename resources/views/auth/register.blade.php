{{-- resources/views/auth/register.blade.php --}}
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro — Administrador</title>

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light vh-100 d-flex align-items-center justify-content-center">

  <div class="container">
    <div class="row justify-content-center w-100">
      <div class="col-sm-10 col-md-7 col-lg-5">
        <div class="card shadow-lg rounded-3">
          <div class="card-body p-4">

            <!-- Logo / Icono -->
            <div class="d-flex justify-content-center mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
              </svg>
            </div>

            <!-- Session Success (opcional) -->
            @if (session('success'))
              <div class="alert alert-success" role="alert">
                {{ session('success') }}
              </div>
            @endif

            <!-- Validation Errors (general) -->
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <!-- Formulario de registro (mantiene la funcionalidad de Breeze) -->
            <form method="POST" action="{{ route('registro') }}">
              @csrf

              <!-- Nombre -->
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input id="nombre"
                       name="nombre"
                       type="text"
                       class="form-control @if($errors->has('nombre')) is-invalid @endif"
                       value="{{ old('nombre') }}"
                       required
                       autofocus
                       placeholder="Ingrese su nombre">
                @if($errors->has('nombre'))
                  @foreach($errors->get('nombre') as $message)
                    <div class="invalid-feedback d-block">
                      {{ $message }}
                    </div>
                  @endforeach
                @endif
              </div>

              <!-- Apellido Paterno -->
              <div class="mb-3">
                <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                <input id="apellido_paterno"
                       name="apellido_paterno"
                       type="text"
                       class="form-control @if($errors->has('apellido_paterno')) is-invalid @endif"
                       value="{{ old('apellido_paterno') }}"
                       required
                       autofocus
                       placeholder="Ingrese su nombre">
                @if($errors->has('apellido_paterno'))
                  @foreach($errors->get('apellido_paterno') as $message)
                    <div class="invalid-feedback d-block">
                      {{ $message }}
                    </div>
                  @endforeach
                @endif
              </div>

              <!-- Apellido Materno -->
              <div class="mb-3">
                <label for="apellido_materno" class="form-label">Apellido Materno</label>
                <input id="apellido_materno"
                       name="apellido_materno"
                       type="text"
                       class="form-control @if($errors->has('apellido_materno')) is-invalid @endif"
                       value="{{ old('apellido_materno') }}"
                       required
                       autofocus
                       placeholder="Ingrese su nombre">
                @if($errors->has('apellido_materno'))
                  @foreach($errors->get('apellido_materno') as $message)
                    <div class="invalid-feedback d-block">
                      {{ $message }}
                    </div>
                  @endforeach
                @endif
              </div>

              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email"
                       name="email"
                       type="email"
                       class="form-control @if($errors->has('email')) is-invalid @endif"
                       value="{{ old('email') }}"
                       required
                       placeholder="ejemplo@dominio.com"
                       autocomplete="email">
                @if($errors->has('email'))
                  @foreach($errors->get('email') as $message)
                    <div class="invalid-feedback d-block">
                      {{ $message }}
                    </div>
                  @endforeach
                @endif
              </div>

              <!-- Password -->
              <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password"
                       name="password"
                       type="password"
                       class="form-control @if($errors->has('password')) is-invalid @endif"
                       required
                       autocomplete="new-password"
                       placeholder="Ingrese una contraseña">
                @if($errors->has('password'))
                  @foreach($errors->get('password') as $message)
                    <div class="invalid-feedback d-block">
                      {{ $message }}
                    </div>
                  @endforeach
                @endif
              </div>

              <!-- Confirm Password -->
              <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                <input id="password_confirmation"
                       name="password_confirmation"
                       type="password"
                       class="form-control"
                       required
                       placeholder="Confirme su contraseña">
              </div>

              <div class="mb-3">
                <label class="form-label">Rol del usuario</label>
                <select name="roles_id" class="form-select" required>
                  <option value="">SELECCIONE UN ROL</option>
                  @foreach ($roles as $rol)
                    <option value="{{ $rol->id }}" {{ old('roles_id') == $rol->id ? 'selected' : '' }}>
                      {{ $rol->rol }}
                    </option>
                  @endforeach
                </select>

                @error('roles_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="d-flex justify-content-center row mt-4 pt-3 ps-3 pe-3 ">
                <a href="{{ route('inicio') }}" class="btn btn-danger col-5 me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary col-5 ms-2">Registrar usuario</button>
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
