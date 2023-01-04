@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center pt-5 mt-5 m-1">
        <div class="col-md-4 formulario-login">
            <div class="form-group pt-3 text-center">
                <h1 class="text-light">INICIAR SESIÓN</h1>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group mx-sm-4 pt-3">
                    <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                 :value="old('name')" placeholder="Ingrese Nombre" required autofocus autocomplete="name" />
                    <x-jet-input-error for="name"></x-jet-input-error>
                </div>

                <div class="form-group mx-sm-4 pt-3">
                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                 :value="old('email')" placeholder="Ingrese Email" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="form-group mx-sm-4 pt-3">
                    <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                 name="password" placeholder="Ingrese Contraseña" required autocomplete="new-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="form-group mx-sm-4 pt-3">
                    <x-jet-input class="form-control" placeholder="Confirme Contraseña" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="form-group mx-sm-4 pb-2">
                    <x-jet-button  class="btn btn-block ingresar">
                        {{ __('Registrar') }}
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
