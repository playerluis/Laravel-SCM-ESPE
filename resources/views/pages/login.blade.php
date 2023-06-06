<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('bootstrap-5.3.0-alpha3-dist/css/bootstrap.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c903d303d4.js" crossorigin="anonymous"></script>
    <title>Sistema de Citas Medicas</title>
</head>
<body class="d-flex flex-column align-items-center">

<div class="d-flex justify-content-center align-items-center">
    <h1 class="fs-4">
        <i class="fa-solid fa-hospital my-5 fs-1"></i>
        SISTEMA DE CITAS MEDICAS
    </h1>
</div>
<div class="card w-75">
    <div class="card-header fs-2 text-center py-3">
        <i class="fa-solid fa-user-circle"></i>
        Iniciar Sesion
    </div>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card-body">
        <form method="POST" action="{{ route("autenticar") }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electronico</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">No compartiremos tu correo con nadie mas.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary my-2">
                    <i class="fa-solid fa-sign-in"></i>
                    Iniciar Sesion
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
