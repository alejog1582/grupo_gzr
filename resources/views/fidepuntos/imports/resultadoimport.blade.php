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
                <h1>Resultado Import <b>{{$proceso_importacion}}</b> Identificador <b>{{$identificador_importacion}}</b></h1>
            </div>
            <div class="col-2">
                @if ($proceso_importacion == "clientes")
                    <a href="/dashboard/fidepuntos/clientes" class="btn boton_menu">Regresar</a>
                @endif
                @if ($proceso_importacion == "productos")
                    <a href="/dashboard/fidepuntos/productos" class="btn boton_menu">Regresar</a>
                @endif
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                        <b>Registros Exitosos:</b>
                    </div>
                    <div class="col">
                        {{$registros_exitosos}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Registros Declinados:</b>
                    </div>
                    <div class="col">
                        {{$registros_declinados}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Registros Declinados por Campos:</b>
                    </div>
                    <div class="col">
                        {{$registros_declinados_campos_vacios}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Filas Declinados por Campos:</b>
                    </div>
                    <div class="col">
                        {{$string_filas_error_campos_vacios}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Registros Declinados Duplicidad {{$proceso_importacion}}:</b>
                    </div>
                    <div class="col">
                        {{$registros_declinados_duplicidad_cliente}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Filas Declinados Duplicidad {{$proceso_importacion}}:</b>
                    </div>
                    <div class="col">
                        {{$string_filas_error_duplicidad_cliente}}
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
