<?php

use App\Http\Controllers\AuthController;
use App\Utils\Pagina;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return view("pages.index");
});

Route::get("/login", function () {
    return view("pages.login");
})->name("login")->middleware("guest");

Route::post("/post", function () {
    return view("pages.login");
});

Route::post("/autenticar",
    [AuthController::class, "authenticate"]
)->name("autenticar");

Route::get("/salir",
    [AuthController::class, "logout"]
)->name("salir");

/** @var Pagina[] $paginas */
$paginas = app('paginas');

foreach ($paginas as $pagina) {
    if ($pagina->esEntidadRelacional()) {

        $uri = $pagina->getUri();
        $rutaPrefijo = $pagina->getRutaPrefijo();
        $controlador = $pagina->getControllerClass();

        Route::get($uri,
            [$controlador, 'index']
        )->name($rutaPrefijo . ".index");

        Route::get($uri . "/crear",
            [$controlador, 'create']
        )->name($rutaPrefijo . ".crear");

        Route::post($uri,
            [$controlador, 'store']
        )->name($rutaPrefijo . ".guardar");

        Route::get($uri . "/ver/{id}",
            [$controlador, "show"]
        )->name($rutaPrefijo . ".ver");

        Route::get($uri . "/editar/{id}",
            [$controlador, 'edit']
        )->name($rutaPrefijo . ".editar");

        Route::post($uri . "/editar/{id}",
            [$controlador, 'update']
        )->name($rutaPrefijo . ".actualizar");

        Route::delete($uri . "/eliminar/{id}",
            [$controlador, 'destroy']
        )->name($rutaPrefijo . ".eliminar");
    }
}



