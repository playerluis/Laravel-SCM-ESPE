<?php

namespace App\Http\Controllers;

use App\Models\Paciente;

class PacienteController extends EntityControllerBase
{
    public function __construct()
    {
        parent::__construct("paciente", Paciente::class);
    }
}

