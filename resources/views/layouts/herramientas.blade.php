@extends('layouts.modulos')

@section('links')
    <link rel="stylesheet" href="{{ asset('styles/vehiculo.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
@endsection
@section('content')

<div class="tool-grid">
    <div class="tool-card">
        @yield('content')
    </div>
</div>

    <div class="content-wrapper">
    <div class="cuadroHerramientas">
      <div class="actions-herramientas">
    <div class="action-buttons">
            <a href="#" class="btn-agregar-vehiculo">
            <i class="fas fa-plus"></i> Añadir Herramienta
        </a>
        <a href="#" class="btn-eliminar-vehiculo">
            <i class="fas fa-trash-alt"></i> Eliminar Herramienta
        </a>
    </div>
</div>
    </div>
</div>
{{-- <script src="{{ asset('js/modulos.js') }}"></script> --}}
<script src="{{ asset('js/herramientas.js') }}"></script>
@endsection