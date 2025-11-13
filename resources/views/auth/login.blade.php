<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login EPC</title>
    <link rel="stylesheet" href="{{ asset('/styles/Estiloslogin.css') }}">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <div class="container" id="container">
        {{-- Formulario de Registro --}}
        <div class="container-form form-register">
            <form method="POST" action="{{ route('auth.handle') }}" class="sing-up">
                @csrf
                <input type="hidden" name="action" value="register">
                <h2>Registrarse</h2>

                <div class="logo">
                    <img src="{{ asset('img/logo_epc.webp') }}" alt="logo" />
                </div>

                <span>Use correo electrónico para registrarse</span>

                {{-- Primer Nombre --}}
                <div class="container-input">
                    <input type="text" name="primer_nombre" value="{{ old('primer_nombre') }}" placeholder="Primer Nombre" required>
                </div>

                {{-- Segundo Nombre --}}
                <div class="container-input">
                    <input type="text" name="segundo_nombre" value="{{ old('segundo_nombre') }}" placeholder="Segundo Nombre">
                </div>

                {{-- Primer Apellido --}}
                <div class="container-input">
                    <input type="text" name="primer_apellido" value="{{ old('primer_apellido') }}" placeholder="Primer Apellido" required>
                </div>

                {{-- Segundo Apellido --}}
                <div class="container-input">
                    <input type="text" name="segundo_apellido" value="{{ old('segundo_apellido') }}" placeholder="Segundo Apellido">
                </div>

                {{-- Documento --}}
                <div class="container-input">
                    <input type="text" name="num_documento" value="{{ old('num_documento') }}" placeholder="Número de documento" required>
                </div>

                {{-- Tipo de Documento --}}
                <div class="container-input">
                    <select name="id_tipdocumento" required>
                        <option value="">Seleccione un tipo</option>
                        <option value="1" {{ old('id_tipdocumento') == 1 ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                        <option value="2" {{ old('id_tipdocumento') == 2 ? 'selected' : '' }}>Cédula de Extranjería</option>
                        <option value="3" {{ old('id_tipdocumento') == 3 ? 'selected' : '' }}>Pasaporte</option>
                        <option value="4" {{ old('id_tipdocumento') == 4 ? 'selected' : '' }}>NIT</option>
                        <option value="5" {{ old('id_tipdocumento') == 5 ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('id_tipdocumento')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="container-input">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="container-input">
                    <input type="password" name="password" placeholder="Contraseña" required>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Confirmar Password --}}
                <div class="container-input">
                    <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña" required>
                </div>

                <button type="submit">Registrarse</button>

                @if ($errors->any())
                    <div class="error-summary">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>


        {{-- Formulario de Inicio de Sesión --}}

        <div class="container-form form-login">
            <form method="POST" action="{{ route('auth.handle') }}" class="sing-in">
                @csrf
                <input type="hidden" name="action" value="login">
                <h2>Iniciar Sesión</h2>
                <div class="logo">
                    <img src="{{ asset('img/logo_epc.webp') }}" alt="logo" />
                </div>
                <span>Use correo y contraseña para iniciar sesión</span>

                <div class="container-input">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" placeholder="Email" name="email" required />
                </div>

                <div class="container-input">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" placeholder="Password" name="password" required />
                </div>

                <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>

                <button type="submit">INICIAR SESIÓN</button>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h2>¡Hola!</h2>
                    <p>Ingrese sus datos personales y comience su viaje con nosotros</p>
                    <button class="ghost" id="btn-iniciar">Iniciar Sesión</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h2>¡Bienvenido de nuevo!</h2>
                    <p>Para mantenerse conectado, inicie sesión con su información personal</p>
                    <button class="ghost" id="btn-registrar">Registrarse</button>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
    <br>
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btnRegistrar = document.getElementById('btn-registrar');
            const btnIniciar = document.getElementById('btn-iniciar');
            const container = document.getElementById('container');

            btnRegistrar.addEventListener('click', () => {
                container.classList.add("right-panel-active");
            });

            btnIniciar.addEventListener('click', () => {
                container.classList.remove("right-panel-active");
            });
        });
    </script>
</body>
</html>