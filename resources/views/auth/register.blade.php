@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="primer_nombre" class="col-md-4 col-form-label text-md-end">{{ __('Primer nombre') }}</label>

                            <div class="col-md-6">
                                <input id="primer_nombre" type="text" name="primer_nombre" value="{{ old('primer_nombre') }}" required autocomplete="primer_nombre" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="segundo_nombre" class="col-md-4 col-form-label text-md-end">{{ __('Segundo nombre') }}</label>

                            <div class="col-md-6">
                                <input id="segundo_nombre" type="text" name="segundo_nombre" value="{{ old('segundo_nombre') }}" required autocomplete="segundo_nombre" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="primer_apellido" class="col-md-4 col-form-label text-md-end">{{ __('Primer apellido') }}</label>

                            <div class="col-md-6">
                                <input id="primer_apellido" type="text" name="primer_apellido" value="{{ old('primer_apellido') }}" required autocomplete="primer_apellido" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="segundo_apellido" class="col-md-4 col-form-label text-md-end">{{ __('Segundo apellido') }}</label>

                            <div class="col-md-6">
                                <input id="segundo_apellido" type="text" name="segundo_apellido" value="{{ old('segundo_apellido') }}" required autocomplete="segundo_apellido" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="num_documento" class="col-md-4 col-form-label text-md-end">{{ __('numero de documento') }}</label>

                            <div class="col-md-6">
                                <input id="num_documento" type="text" name="num_documento" value="{{ old('num_documento') }}" required autocomplete="num_documento" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="id_tipdocumento" class="col-md-4 col-form-label text-md-end">{{ __('Tipo documento') }}</label>

                            <div class="col-md-6">
                                <select id="id_tipdocumento" name="id_tipdocumento" class="form-select" required autofocus>
                                    <option value="">Seleccione un tipo</option>
                                    <option value="1" {{ old('id_tipdocumento') == 1 ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                                    <option value="2" {{ old('id_tipdocumento') == 2 ? 'selected' : '' }}>Cédula de Extranjería</option>
                                    <option value="3" {{ old('id_tipdocumento') == 3 ? 'selected' : '' }}>Pasaporte</option>
                                    <option value="4" {{ old('id_tipdocumento') == 4 ? 'selected' : '' }}>NIT</option>
                                    <option value="5" {{ old('id_tipdocumento') == 5 ? 'selected' : '' }}>Otro</option>
                                </select>

                                @error('id_tipdocumento')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                    </form>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
