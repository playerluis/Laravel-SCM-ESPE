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
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.8/index.global.min.js'></script>

    <title>Sistem de Citas Medicas</title>
</head>
<body class="d-flex vh-100">
<aside class="d-flex flex-column flex-shrink-0 p-3"
       style="
            width: 280px;
            border-right: rgba(173,181,189,0.3) 1px solid;
       ">
    <a href="/"
       class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none"
    >
        <div class="mx-2"><i class="fa-solid fa-hospital"></i></div>
        <span class="fs-4">SCM</span>
    </a>
    <hr>

    <ul class="nav nav-pills flex-column mb-auto">
        @php
            Use App\Utils\Pagina;
            use Illuminate\Support\Facades\Auth;
            /** @var Pagina[] $paginas */
        @endphp
        @foreach ($paginas as $pagina)
            <li class="nav-item">
                @if ("/" . request()->path() === $pagina->getUri() or ($pagina->getUri() === request()->path()) )
                    <a href="{{ $pagina->getUri() }}" class="nav-link active" aria-current="page">
                        <div class="mx-2 d-inline-block"><i class="{{ $pagina->getFaIcon() }}"></i></div>
                        {{ $pagina->getNombre() }}
                    </a>
                @else
                    <a href="{{ $pagina->getUri() }}" class="nav-link text-white">
                        <div class="mx-2 d-inline-block"><i class="{{ $pagina->getFaIcon() }}"></i></div>
                        {{ $pagina->getNombre() }}
                    </a>
                @endif
            </li>
        @endforeach
    </ul>

    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
           id="dropdownUser1"
           data-bs-toggle="dropdown" aria-expanded="false">
            <strong>
                @auth
                    {{Auth::user()->nombre}}
                @else
                    Invitado
                @endauth
            </strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">Ajustes</a></li>
            <li><a class="dropdown-item" href="#">Perfil</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item"
                   href="{{Auth::user()? route("salir") : route("login")}}">
                    {{Auth::user()? "Cerrar Sesion":"Iniciar Sesion"}}
                </a>
            </li>
        </ul>
    </div>
</aside>
<main class="container-fluid" style="width: calc(100% - 280px)">
    <div class="row mt-3">
        <div class="col d-flex justify-content-center"><h1>Sistema de Citas Medicas</h1></div>
        <hr>
    </div>
    <div class="row">
        @yield('content')
    </div>
</main>


</body>
</html>
