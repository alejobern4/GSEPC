@extends('layouts.app')

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
        <div class="cuadroConductores">
            <div class="actions-conductores">
                <div class="action-buttons">
                    {{-- Aquí puedes agregar botones de acción si lo deseas --}}
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/conductores.js') }}"></script>
@endsection