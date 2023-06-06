<?php

namespace App\Utils;

use App\Http\Controllers\CitaController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\UsuarioController;

class Pagina
{
    private string $nombre;
    private string $uri;
    private string $tabla;
    private string $faIcon;
    private string $controllerClass;
    private string $rutaPrefijo;
    private array $validaciones;

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): Pagina
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function setUri(string $pageUri): Pagina
    {
        $this->uri = $pageUri;
        return $this;
    }

    public function getTabla(): string
    {
        return $this->tabla;
    }

    public function setTabla(string $tabla): Pagina
    {
        $this->tabla = $tabla;
        return $this;
    }

    public function getFaIcon(): string
    {
        return $this->faIcon;
    }

    public function setFaIcon(string $faIcon): Pagina
    {
        $this->faIcon = $faIcon;
        return $this;
    }

    public function getControllerClass(): string
    {
        return $this->controllerClass;
    }

    public function setControllerClass(string $controllerClass): Pagina
    {
        $this->controllerClass = $controllerClass;
        return $this;
    }

    public function getRutaPrefijo(): string
    {
        return $this->rutaPrefijo;
    }

    public function setRutaPrefijo(string $rutaPrefijo): Pagina
    {
        $this->rutaPrefijo = $rutaPrefijo;
        return $this;
    }

    public function getValidaciones(): array
    {
        return $this->validaciones;
    }


    public function setValidaciones(array $validaciones): Pagina
    {
        $this->validaciones = $validaciones;
        return $this;
    }


    public function esEntidadRelacional(): bool
    {
        return isset($this->tabla) and isset($this->controllerClass) and isset($this->rutaPrefijo);
    }

    /** @return  Pagina[] $paginas */
    public static function obtenerPaginas(): array
    {
        /** @var Pagina[] $paginas */
        return [
            "" => (new Pagina())
                ->setUri("/")
                ->setFaIcon("fa-solid fa-house")
                ->setNombre("Inicio")
                ->setRutaPrefijo("index")
            ,
            "cita" => (new Pagina())
                ->setUri("/citas")
                ->setFaIcon("fa-solid fa-calendar-days")
                ->setNombre("Citas")
                ->setTabla("citas")
                ->setControllerClass(CitaController::class)
                ->setRutaPrefijo('cita')
                ->setValidaciones([]),

            "doctor" => (new Pagina())
                ->setUri("/doctores")
                ->setTabla("doctores")
                ->setNombre("Doctores")
                ->setFaIcon("fa-solid fa-user-doctor")
                ->setControllerClass(DoctorController::class)
                ->setRutaPrefijo("doctor")
                ->setValidaciones([]),

            "paciente" => (new Pagina())
                ->setUri("/pacientes")
                ->setTabla("pacientes")
                ->setNombre("Pacientes")
                ->setFaIcon("fa-solid fa-hospital-user")
                ->setControllerClass(PacienteController::class)
                ->setRutaPrefijo("paciente")
                ->setValidaciones([]),

            "usuario" => (new Pagina())
                ->setUri("/usuarios")
                ->setTabla("usuarios")
                ->setNombre("Usuario")
                ->setFaIcon("fa-solid fa-user")
                ->setControllerClass(UsuarioController::class)
                ->setRutaPrefijo("usuario")
                ->setValidaciones([
                    'nombre' => 'required',
                    'apellido' => 'required',
                    'email' => 'required|email|unique:usuarios',
                    'password' => 'required',
                ])
        ];
    }
}
