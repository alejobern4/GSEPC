@extends('layouts.app')

@section('title', 'Vehiculos - EPC')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- Estilos --}}
    
    <title>Módulo - @yield('title')</title>
</head>
    @include('partials.nav-modulos')

    {{-- Scripts --}}
    @vite(['resources/js/vehiculos.js', 'resources/js/modulos.js'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/estilosModulos.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/sidebar.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
@endpush

@push('scripts')
    {{-- <script src="{{ asset('js/vehiculos.js') }}"></script> --}}
@endpush

{{-- Chatbot component (Hugging Face) --}}
@include('components.chatbot')