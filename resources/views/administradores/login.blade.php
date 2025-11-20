<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar sesión — Administrador</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light vh-100 d-flex align-items-center">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-10 col-md-6 col-lg-4">
        <div class="card shadow-sm mt-5">
          <div class="card-body p-4">
            <div class="d-flex align-content-end flex-wrap justify-content-center mt-4 mb-5">
              <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
              </svg>
            </div>

            @if(session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            @if(session('error')) 
              <div class="alert alert-danger" role="alert">
                {{ session('error') }}
              </div>
            @endif

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="mt-3">
              @csrf

              <div class="mb-3">
                <label for="correo_electronico" class="form-label">Correo electrónico</label>
                <input id="correo_electronico"
                       name="correo_electronico"
                       type="email"
                       class="form-control"
                       value="{{ old('correo_electronico') }}"
                       autocomplete="email"
                       autofocus
                       placeholder="Inserte su correo">
              </div>

              <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input id="contrasena"
                       name="contrasena"
                       type="password"
                       class="form-control"
                       autocomplete="current-password"
                       placeholder="Inserte su contraseña">
              </div>

              <div class="d-grid mb-2 mt-4 pt-3">
                <button type="submit" class="btn btn-primary">Iniciar sesión</button>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
