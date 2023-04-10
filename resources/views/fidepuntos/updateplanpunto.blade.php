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
                <h1 class="titulo-vista">Configuracion de Planes de Puntos de Compañia: {{$compania->nombre_compania}}</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/planpuntos" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card cuerpo_tabla">
                <br>
                <div class="container">
                    <form action="/dashboard/fidepuntos/planpuntos/update/save" method="post" >
                        {{ csrf_field() }}
                        <input type="hidden" name="compania_id" value="{{$compania->id}}">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <div class="input-group mb-12">
                                    <div class="input-group-text">
                                        @if ($puntosxcompra)
                                            <input name="puntosxcompra" checked class="mt-0" type="checkbox" value="1">
                                        @else
                                            <input name="puntosxcompra" class="mt-0" type="checkbox" value="1">
                                        @endif
                                    </div>
                                    <input type="text" class="form-control" value="Puntos por Compra">
                                  </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <div class="input-group mb-12">
                                    <div class="input-group-text">
                                        @if ($puntosxproducto)
                                            <input name="puntosxproducto" checked class="mt-0" type="checkbox" value="2">
                                        @else
                                            <input name="puntosxproducto" class="mt-0" type="checkbox" value="2">
                                        @endif
                                    </div>
                                    <input type="text" class="form-control" value="Puntos por Producto">
                                  </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <div class="input-group mb-12">
                                    <div class="input-group-text">
                                        @if ($fidelizacioncliente)
                                            <input name="fidelizacioncliente" checked class="mt-0" type="checkbox" value="3">
                                        @else
                                            <input name="fidelizacioncliente" class="mt-0" type="checkbox" value="3">
                                        @endif
                                    </div>
                                    <input type="text" class="form-control" value="Fidelizacion Clientes">
                                  </div>
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
