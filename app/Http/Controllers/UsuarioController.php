<?php

namespace App\Http\Controllers;

use App\Models\Usuario;

class UsuarioController extends EntityControllerBase
{
    public function __construct()
    {
        parent::__construct("usuario", Usuario::class);
    }
}
