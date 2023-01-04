@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center pt-5 mt-5 m-1">
        <div class="col-md-4 formulario-login">
            <div class="form-group pt-3 text-center">
                <h1 class="text-light">INICIAR SESIÓN</h1>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group mx-sm-4 pt-3">
                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }} form-control" type="email"
                        name="email"  placeholder="Ingrese Email" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="form-group mx-sm-4 pt-3">
                    <x-jet-input class="{{ $errors->has('password') ? ' is-invalid' : '' }} form-control" type="password"
                         name="password" placeholder="Ingrese Contraseña" required/>
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                {{-- <div class="form-group mx-sm-4 text-right">
                    <div class="d-flex justify-content-end align-items-baseline">
                        @if (Route::has('password.request'))
                            <a class="recuperacion-contrasena" href="{{ route('password.request') }}">
                                {{ __('Olvide mi contraseña?') }}
                            </a>
                        @endif
                    </div>
                </div> --}}

                <div class="form-group mx-sm-4 pb-2">
                    <x-jet-button class="btn btn-block ingresar">
                        {{ __('INGRESAR') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </div>
</div>




@endsection

@section('title')
    Ingreso a cuenta Cash Advance | acceso a prestamos personales
@endsection

@section('description')
    Ingresa a tu cuenta de Cash Advance SAS donde podras gestionar tus creditos.
@endsection
