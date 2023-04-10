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
                <h1 class="titulo-vista">Configuracion Puntos x Compra Compañia: {{$plan_punto_compania->compania->nombre_compania}}</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/puntosxcompra" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card cuerpo_tabla">
                <br>
                <div class="container">
                    <form action="/dashboard/fidepuntos/puntoscompra/update/save" method="post" >
                        {{ csrf_field() }}
                        <input type="hidden" name="plan_puntos_compania_id" value="{{$plan_punto_compania->id}}">
                        <input type="hidden" name="control_existe_configuracion" value="{{$control_existe_configuracion}}">
                        @if ($control_existe_configuracion)
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="valor_punto"><b>Valor Punto *</b></label>
                                    <input required type="number" class="form-control" id="valor_punto" name="valor_punto" value="{{$configuracion_puntos_compras[0]->valor_punto}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="valor_punto_canje"><b>Valor Punto Canje*</b></label>
                                    <input required type="number" class="form-control" id="valor_punto_canje" name="valor_punto_canje" value="{{$configuracion_puntos_compras[0]->valor_punto_canje}}">
                                </div>
                            </div>
                        @else
                            <p>No existe ninguna configuracion de puntos por compras por el momento</p>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="valor_punto"><b>Valor Punto *</b></label>
                                    <input required type="number" class="form-control" id="valor_punto" name="valor_punto">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="valor_punto_canje"><b>Valor Punto Canje*</b></label>
                                    <input required type="number" class="form-control" id="valor_punto_canje" name="valor_punto_canje">
                                </div>
                            </div>
                        @endif
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
