@php
    use App\Utils\TextoConstructor;
@endphp

@extends('app')
@section('content')
    <div class="container px-4">
        <h1>{{TextoConstructor::formatText($tabla)}}</h1>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <x-formulario-desde-entidad
            :tabla="$tabla"
            :rutaPrefijo="$rutaPrefijo"
        />
    </div>
@endsection
