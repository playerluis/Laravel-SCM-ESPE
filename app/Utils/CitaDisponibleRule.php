<?php

namespace App\Utils;

use Illuminate\Validation\Rule;
use App\Models\Cita;


class CitaDisponibleRule extends Rule
{
    public function passes($attribute, $value)
    {
        $fechaInicio = $value['fecha_y_hora_de_inicio'];
        $fechaFin = $value['fecha_y_hora_de_fin'];
        $doctorId = $value['doctor_id'];
        $pacienteId = $value['paciente_id'];

        $citasExistentes = Cita
            ::where('doctor_id', $doctorId)
            ->where('paciente_id', $pacienteId)
            ->where(
                function ($query) use ($fechaInicio, $fechaFin) {

                    $query->where(
                        function ($subQuery) use ($fechaInicio, $fechaFin) {
                            $subQuery
                                ->where('fecha_y_hora_de_inicio', '>=', $fechaInicio)
                                ->where('fecha_y_hora_de_inicio', '<', $fechaFin);
                        }
                    )->orWhere(
                        function ($subQuery) use ($fechaInicio, $fechaFin) {
                            $subQuery
                                ->where('fecha_y_hora_de_fin', '>', $fechaInicio)
                                ->where('fecha_y_hora_de_fin', '<=', $fechaFin);
                        }
                    )->orWhere(
                        function ($subQuery) use ($fechaInicio, $fechaFin) {
                            $subQuery
                                ->where('fecha_y_hora_de_inicio', '<=', $fechaInicio)
                                ->where('fecha_y_hora_de_fin', '>=', $fechaFin);
                        }
                    );

                }
            )
            ->exists();

        return !$citasExistentes;
    }

    public function message()
    {
        return 'El doctor y el paciente seleccionados tienen una cita en ese rango de tiempo.';
    }
}
