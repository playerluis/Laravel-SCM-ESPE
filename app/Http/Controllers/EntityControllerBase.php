<?php

namespace App\Http\Controllers;

use App\Utils\CRUD;
use App\Utils\Pagina;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EntityControllerBase extends Controller
{
    private Pagina $entidad;
    private string $model;

    public function __construct(string $entidad, string $model)
    {
        $this->entidad = Pagina::obtenerPaginas()[$entidad];
        $this->model = $model;
        $this->middleware('auth');
    }

    public function index(): Factory|View|Application
    {
        return CRUD::obtenerIndex($this->entidad, new $this->model(), todos: true);
    }

    public function create(): Application|Factory|View
    {
        return CRUD::obtenerFormulario($this->entidad);
    }

    public function store(Request $request): RedirectResponse
    {
        return CRUD::guardarModelo($this->entidad, new $this->model(), $request);
    }

    public function show(string $id): Factory|View|Application|RedirectResponse
    {
        $registro = $this->model::find($id);
        return CRUD::obtenerIndex($this->entidad, $registro, ['accion' => 'buscar']);
    }

    public function edit(string $id): Factory|View|Application|RedirectResponse
    {
        $registro = $this->model::find($id);
        return CRUD::obtenerFormularioParaEditar($this->entidad, $registro);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $registro = $this->model::find($id);
        return CRUD::guardarModelo($this->entidad, $registro, $request);
    }

    public function destroy(string $id): RedirectResponse
    {
        $registro = $this->model::find($id);
        return CRUD::eliminarModelo($this->entidad, $registro);

    }
}
