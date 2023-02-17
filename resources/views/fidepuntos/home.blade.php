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
        <div class="row pt-4">
            @foreach ($tarjetas_fidepuntos as $tarjeta_fidepuntos)
                <div class="col">
                    <div class="card formulario-login">
                        <div class="card-body">
                          <h5 class="card-title">{{$tarjeta_fidepuntos->titulo}}</h5>
                          <p class="card-text">{{$tarjeta_fidepuntos->descripcion}}</p>
                          <a href="{{$tarjeta_fidepuntos->link}}" class="boton_menu">Ver Más</a>
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
