@extends('layouts.app')

@section('script')
    <script type="text/javascript">
        const btnMenuFidepuntos  = document.querySelector('#menu-btn-fidepuntos');
        btnMenuFidepuntos.addEventListener('click', e => {
            console.log("me dieron");
            if ($('#sidebar').is(':hidden'))
                $('#sidebar').show();
            else
                $('#sidebar').hide();
        });
    </script>
@endsection

@section('content')

<div class="wrapper-fidepuntos">
    @include('fidepuntos.menu')
     <div class="container">
        <div class="row">
            <div class="col-10">
                <h1 class="titulo-vista">Puntos x Productos</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            @foreach ($companiasplanpuntosproducto as $cpp)
            <div class="col-3">
                <div class="card cuerpo_tabla">
                    <div class="card-body">
                      <h4 class="card-title text-center">{{$cpp->compania->nombre_compania}}</h4>
                      <a href="/dashboard/fidepuntos/puntosproducto/update/{{$cpp->id}}" class="boton_menu">Ver Configuracion</a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection

@section('title')
    Administrador Grupo GZR
@endsection

@section('description')
    Panel Administrativo Gurpo GZR.
@endsection
