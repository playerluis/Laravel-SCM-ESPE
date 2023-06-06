<?php

namespace App\Utils;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CRUD
{
    public static function guardarModelo(Pagina $entidad, Model $modelo, Request $request, bool $actualizando = false): RedirectResponse
    {
        try {
            if (!$entidad->esEntidadRelacional())
                throw new Exception("La pagina no contiene la suficiente información para ser una entidad Relacional");

            $tabla = $entidad->getTabla();

            $request->validate($entidad->getValidaciones());

            foreach ($request->all() as $campo => $valor) {
                if ($campo == '_token') continue;
                if (!in_array($campo, Schema::getColumnListing($tabla)))
                    throw new Exception("El campo $campo no existe en la tabla " . $tabla);
                if ($campo == 'password') {
                    $modelo->$campo = Hash::make($valor);
                    continue;
                }
                $modelo->$campo = $valor;
            }

            $modelo->save();

            return redirect()
                ->route($entidad->getRutaPrefijo() . ".index")
                ->with('success', $entidad->getNombre() . ($actualizando ? 'Actualizado ' : 'Creado') . '  correctamente');

        } catch (Exception $err) {
            return redirect()
                ->route($entidad->getRutaPrefijo() . ".index")
                ->with('error', $entidad->getNombre() . " : " . $err->getMessage());
        }
    }

    public static function eliminarModelo(Pagina $entidad, Model $modelo): RedirectResponse
    {
        try {
            if (!$entidad->esEntidadRelacional())
                throw new Exception("La pagina no contiene la suficiente información para ser una entidad Relacional");

            $modelo->delete();
            return redirect()
                ->route($entidad->getRutaPrefijo() . ".index")
                ->with('success', $entidad->getNombre() . ' eliminado correctamente');

        } catch (Exception $err) {
            return redirect()
                ->route($entidad->getRutaPrefijo() . ".index")
                ->with('error', $entidad->getNombre() . " : " . $err->getMessage());
        }
    }

    public static function obtenerFormulario(Pagina $entidad): Factory|View|Application|RedirectResponse
    {
        try {
            if (!$entidad->esEntidadRelacional())
                throw new Exception("La pagina no contiene la suficiente información para ser una entidad Relacional");
            return view('pages.entidades.crear',
                [
                    'tabla' => $entidad->getTabla(),
                    'rutaPrefijo' => $entidad->getRutaPrefijo(),
                ]
            );
        } catch (Exception $err) {
            return redirect()
                ->route($entidad->getRutaPrefijo() . ".index")
                ->with('error', $entidad->getNombre() . " : " . $err->getMessage());
        }
    }

    public static function obtenerFormularioParaEditar(Pagina $entidad, Model $modelo): Factory|View|Application|RedirectResponse
    {
        try {
            if (!$entidad->esEntidadRelacional())
                throw new Exception("La pagina no contiene la suficiente información para ser una entidad Relacional");
            return view('pages.entidades.editar',
                [
                    'tabla' => $entidad->getTabla(),
                    'rutaPrefijo' => $entidad->getRutaPrefijo(),
                    'registro' => $modelo
                ]
            );
        } catch (Exception $err) {
            return redirect()
                ->route($entidad->getRutaPrefijo() . ".index")
                ->with('error', $entidad->getNombre() . " : " . $err->getMessage());
        }
    }

    public static function obtenerIndex(Pagina $entidad, Model $modelo, array $adicionales = [], bool $todos = false): Factory|View|Application|RedirectResponse
    {
        try {
            if (!$entidad->esEntidadRelacional())
                throw new Exception("La pagina no contiene la suficiente información para ser una entidad Relacional");
            return view('pages.entidades.index',
                [
                    'registros' => $todos ? $modelo::all() : $modelo,
                    'tabla' => $entidad->getTabla(),
                    'rutaPrefijo' => $entidad->getRutaPrefijo(),
                    ...$adicionales
                ]
            );
        } catch (Exception $err) {
            return redirect()
                ->route($entidad->getRutaPrefijo() . ".index")
                ->with('error', $entidad->getNombre() . " : " . $err->getMessage());
        }
    }
}
