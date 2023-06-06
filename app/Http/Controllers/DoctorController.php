<?php

namespace App\Http\Controllers;

use App\Models\Doctor;

class DoctorController extends EntityControllerBase
{
    public function __construct()
    {
        parent::__construct("doctor", Doctor::class);
    }
}
