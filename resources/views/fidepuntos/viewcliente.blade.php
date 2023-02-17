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
                <h1>Cliente {{$cliente->nombre_completo}}</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/clientes" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                        <b>ID:</b>
                    </div>
                    <div class="col">
                        {{$cliente->id}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Tipo:</b>
                    </div>
                    <div class="col">
                        {{$cliente->tipo}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Identificacion:</b>
                    </div>
                    <div class="col">
                        {{$cliente->identificacion}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Nombre Completo:</b>
                    </div>
                    <div class="col">
                        {{$cliente->nombre_completo}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Nombre Comercial:</b>
                    </div>
                    <div class="col">
                        {{$cliente->nombre_comercial}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Puntos:</b>
                    </div>
                    <div class="col">
                        {{$cliente->puntos_total}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Codigo Cliente:</b>
                    </div>
                    <div class="col">
                        {{$cliente->codigo_cliente}}
                    </div>
                  </div>
                  @if ($cliente->membresia_id)
                    <div class="row">
                        <div class="col">
                            <b>Membresia:</b>
                        </div>
                        <div class="col">
                            {{$cliente->membresia->membresia}}
                        </div>
                    </div>
                  @endif
                  <div class="row">
                    <div class="col">
                        <b>Celular:</b>
                    </div>
                    <div class="col">
                        {{$cliente->celular}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Telefono:</b>
                    </div>
                    <div class="col">
                        {{$cliente->telefono}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Email:</b>
                    </div>
                    <div class="col">
                        {{$cliente->email}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Direccion:</b>
                    </div>
                    <div class="col">
                        {{$cliente->direccion}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Ciudad:</b>
                    </div>
                    <div class="col">
                        {{$cliente->ciudad}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Barrio:</b>
                    </div>
                    <div class="col">
                        {{$cliente->barrio}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Codigo Postal:</b>
                    </div>
                    <div class="col">
                        {{$cliente->codigo_postal}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Latitud:</b>
                    </div>
                    <div class="col">
                        {{$cliente->latitud}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Longitud:</b>
                    </div>
                    <div class="col">
                        {{$cliente->longitud}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Compania ID:</b>
                    </div>
                    <div class="col">
                        {{$cliente->compania_id}}
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
