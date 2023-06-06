<?php

namespace App\Http\Controllers;

use App\Models\Cita;

class CitaController extends EntityControllerBase
{
    public function __construct()
    {
        parent::__construct("cita", Cita::class);
    }
}
