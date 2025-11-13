@extends('layouts.app') 

@section('title', 'Restablecer Contraseña - EPC') 

@section('content')
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <title>Login EPC</title>
    <link rel="stylesheet" href="{{ asset('styles/Estiloslogin.css') }}">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <div class="container single-form-page" id="container">
        <div class="container-form form-login">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <h2>Restablecer Contraseña</h2>
                <div class="logo">
                    <img src="{{ asset('img/logo_epc.webp') }}" alt="logo" />
                </div>
                <span>Ingrese su correo electrónico para recibir un enlace de restablecimiento.</span>

                <div class="container-input">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus />
                </div>

                <button type="submit">Enviar Enlace de Restablecimiento</button>

                @if (session('status'))
                    <div class="success-message">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->has('email'))
                    <div class="error-messages">
                        <ul>
                            <li>{{ $errors->first('email') }}</li>
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>
</body>
@endsection