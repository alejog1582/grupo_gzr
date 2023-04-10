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
                <h1 class="titulo-vista">Membresia {{$membresia->membresia}}</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/membresias" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card cuerpo_tabla">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                        <b>ID:</b>
                    </div>
                    <div class="col">
                        {{$membresia->id}}
                    </div>
                  </div>
                  <hr class="separador">
                  <div class="row">
                    <div class="col">
                        <b>Membresia:</b>
                    </div>
                    <div class="col">
                        {{$membresia->membresia}}
                    </div>
                  </div>
                  <hr class="separador">
                  <div class="row">
                    <div class="col">
                        <b>Puntos a Otrogar:</b>
                    </div>
                    <div class="col">
                        {{$membresia->puntos_otorgar}}
                    </div>
                  </div>
                  <hr class="separador">
                  <div class="row">
                    <div class="col">
                        <b>Activo:</b>
                    </div>
                    <div class="col">
                        {{$membresia->activo}}
                    </div>
                  </div>
                </div>
              </div>
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
