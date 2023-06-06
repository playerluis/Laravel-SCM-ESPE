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
        <x-formulario-desde-entidad
            :tabla="$tabla"
            :rutaPrefijo="$rutaPrefijo"
            :registro="$registro"
        />
    </div>
@endsection
