@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row pt-4">
        <div class="col text-center">
            <h1 class="titulo-dashboard">Panel Administrador</h1>
        </div>
    </div>
    <div class="row pt-4">
        @foreach ($tarjetas as $tarjeta)
            <div class="col">
                <div class="card formulario-login">
                    <div class="card-body">
                      <h5 class="card-title">{{$tarjeta->titulo}}</h5>
                      <p class="card-text">{{$tarjeta->descripcion}}</p>
                      <a href="{{$tarjeta->link}}" class="boton_menu">Ver Más</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

@section('title')
    Administrador Grupo GZR
@endsection

@section('description')
    Panel Administrativo Gurpo GZR.
@endsection
