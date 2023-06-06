@php
    use App\Utils\TextoConstructor;
@endphp
@extends('app')
@section('content')
    <div class="container px-4">
        <h2>{{TextoConstructor::formatText($tabla)}}</h2>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <a href="{{ route( $rutaPrefijo . ".crear" )}}" class="btn btn-primary my-3">
            <i class="fa-solid fa-circle-plus"></i>
            Nuevo Registro
        </a>
        @if($tabla === 'citas')
            <div id="calendar"></div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const calendarEl = document.getElementById('calendar');
                    const calendar = new FullCalendar.Calendar(calendarEl, {
                        locale:"es",
                        timeZone: 'UTC',
                        initialView: 'timeGridWeek',
                        aspectRatio: 1.5,
                        headerToolbar: {
                        },
                        events: [
                                @foreach($registros as $cita)
                            {
                                id: '{{ $cita->id }}',
                                title: 'Paciente: {{ $cita->paciente_id }}\n Medico: {{ $cita->doctor_id }}',
                                start: '{{ $cita->fecha_y_hora_de_inicio }}',
                                end: '{{ $cita->fecha_y_hora_de_fin }}',
                                url: '{{ route( $rutaPrefijo . ".editar", $cita->id ) }}'
                            },
                            @endforeach
                        ]
                    });
                    calendar.render();
                });
            </script>
        @endif
        <x-tabla-desde-datos
            :tabla="$tabla"
            :rutaPrefijo="$rutaPrefijo"
            :registros="$registros"
        />
    </div>
@endsection
