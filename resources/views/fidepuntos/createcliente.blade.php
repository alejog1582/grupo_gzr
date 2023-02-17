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
                <h1>Crear Nuevo Cliente</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/clientes" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card">
                <br>
                <div class="container">
                    <form action="/dashboard/fidepuntos/nuevocliente/save" method="post" >
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="compania_id"><b>Compañia *</b></label>
                                <select id="compania_id" class="form-control" name="compania_id">
                                        <option selected disabled value="">Seleccione una opcion</option>
                                    @foreach ($companias as $compania)
                                        <option value="{{$compania->id}}">{{$compania->nombre_compania}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="tipo"><b>Tipo *</b></label>
                                <select id="tipo" class="form-control" name="tipo">
                                    <option disabled selected>Seleccionar una Opcion</option>
                                    <option  value="empresa">Empresa</option>
                                    <option value="persona">Persona</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="puntos_total"><b>Puntos *</b></label>
                                <input type="number" class="form-control" id="puntos_total" name="puntos_total">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="identificacion"><b>Identificacion *</b></label>
                                <input required type="text" class="form-control" id="identificacion" name="identificacion">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="nombre_completo"><b>Nombre Completo *</b></label>
                                <input required type="text" class="form-control" id="nombre_completo" name="nombre_completo">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="nombre_comercial"><b>Nombre Comercial *</b></label>
                                <input type="text" class="form-control" id="nombre_comercial" name="nombre_comercial">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="celular"><b>Celular *</b></label>
                                <input required type="text" class="form-control" id="celular" name="celular">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="telefono"><b>Telefono</b></label>
                                <input type="text" class="form-control" id="telefono" name="telefono">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="codigo_cliente"><b>Codigo Cliente</b></label>
                                <input type="text" class="form-control" id="codigo_cliente" name="codigo_cliente">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="email"><b>Email *</b></label>
                                <input required type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="direccion"><b>Direccion *</b></label>
                                <input required type="text" class="form-control" id="direccion" name="direccion">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="ciudad"><b>Ciudad *</b></label>
                                <input required type="text" class="form-control" id="ciudad" name="ciudad">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="barrio"><b>Barrio *</b></label>
                                <input  type="text" class="form-control" id="barrio" name="barrio">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="codigo_postal"><b>Codigo Postal *</b></label>
                                <input  type="text" class="form-control" id="codigo_postal" name="codigo_postal">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="latitud"><b>Latitud *</b></label>
                                <input  type="text" class="form-control" id="latitud" name="latitud">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="longitud"><b>Longitud *</b></label>
                                <input  type="text" class="form-control" id="longitud" name="longitud">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="membresia"><b>Membresia *</b></label>
                                <input  type="text" class="form-control" id="membresia" name="membresia">
                            </div>
                        </div>
                        <button type="submit" class="btn boton_menu">Crear</button>
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
