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
                <h1>Cliente a Editar: {{$cliente->nombre_completo}}</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/clientes" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card">
                <br>
                <div class="container">
                    <form action="/dashboard/fidepuntos/clientes/update/save" method="post" >
                        {{ csrf_field() }}
                        <input type="hidden" name="cliente_id" value="{{$cliente->id}}">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="identificacion"><b>Identificacion *</b></label>
                                <input required type="text" class="form-control" id="identificacion" name="identificacion" value="{{$cliente->identificacion}}">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="nombre_completo"><b>Nombre Completo *</b></label>
                                <input required type="text" class="form-control" id="nombre_completo" name="nombre_completo" value="{{$cliente->nombre_completo}}">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="tipo"><b>Tipo *</b></label>
                                <select id="tipo" class="form-control" name="tipo">
                                    @if ( $cliente->tipo	== "empresa")
                                        <option selected value="empresa">Empresa</option>
                                        <option value="persona">Persona</option>
                                    @endif
                                    @if ( $cliente->tipo	== "persona")
                                        <option value="empresa">Empresa</option>
                                        <option selected value="persona">Persona</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="nombre_comercial"><b>Nombre Comercial *</b></label>
                                <input required type="text" class="form-control" id="nombre_comercial" name="nombre_comercial" value="{{$cliente->nombre_comercial}}">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="celular"><b>Celular *</b></label>
                                <input required type="text" class="form-control" id="celular" name="celular" value="{{$cliente->celular}}">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="telefono"><b>Telefono</b></label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="{{$cliente->telefono}}">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="codigo_cliente"><b>Codigo Cliente</b></label>
                                <input type="text" class="form-control" id="codigo_cliente" name="codigo_cliente" value="{{$cliente->codigo_cliente}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="email"><b>Email *</b></label>
                                <input required type="text" class="form-control" id="email" name="email" value="{{$cliente->email}}">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="direccion"><b>Direccion *</b></label>
                                <input required type="text" class="form-control" id="direccion" name="direccion" value="{{$cliente->direccion}}">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="ciudad"><b>Ciudad *</b></label>
                                <input required type="text" class="form-control" id="ciudad" name="ciudad" value="{{$cliente->ciudad}}">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="barrio"><b>Barrio *</b></label>
                                <input  type="text" class="form-control" id="barrio" name="barrio" value="{{$cliente->barrio}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="codigo_postal"><b>Codigo Postal *</b></label>
                                <input  type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="{{$cliente->codigo_postal}}">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="latitud"><b>Latitud *</b></label>
                                <input  type="text" class="form-control" id="latitud" name="latitud" value="{{$cliente->latitud}}">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="longitud"><b>Longitud *</b></label>
                                <input  type="text" class="form-control" id="longitud" name="longitud" value="{{$cliente->longitud}}">
                            </div>
                            @if ($cliente->membresia_id)
                                <div class="form-group col-sm-3">
                                    <label for="membresia"><b>Membresia *</b></label>
                                    <input  type="text" class="form-control" id="membresia" name="membresia" value="{{$cliente->membresia->membresia}}">
                                </div>
                            @else
                                <div class="form-group col-sm-3">
                                    <label for="membresia"><b>Membresia *</b></label>
                                    <input  type="text" class="form-control" id="membresia" name="membresia">
                                </div>
                            @endif
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="puntos_total"><b>Puntos *</b></label>
                                <input  type="text" class="form-control" id="puntos_total" name="puntos_total" value="{{$cliente->puntos_total}}">
                            </div>
                        </div>
                        <button type="submit" class="btn boton_menu">Actualizar</button>
                        <br><br>
                    </form>
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
