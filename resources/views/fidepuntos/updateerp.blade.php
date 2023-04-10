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
                <h1 class="titulo-vista">ERP a Editar: {{$erp->compania->nombre_compania}}</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/erps" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card cuerpo_tabla">
                <br>
                <div class="container">
                    <form action="/dashboard/fidepuntos/erps/update/save" method="post" >
                        {{ csrf_field() }}
                        <input type="hidden" name="erp_id" value="{{$erp->id}}">
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="endpoint"><b>Endpoint *</b></label>
                                <input required type="text" class="form-control" id="endpoint" name="endpoint" value="{{$erp->endpoint}}">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="sistema_erp"><b>Sistema ERP *</b></label>
                                <input required type="text" class="form-control" id="sistema_erp" name="sistema_erp" value="{{$erp->sistema_erp}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="token"><b>Token</b></label>
                                <input type="text" class="form-control" id="token" name="token" value="{{$erp->token}}">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="data_connection"><b>Data Connection *</b></label>
                                <input type="text" class="form-control" id="data_connection" name="data_connection" value="{{$erp->data_connection}}">
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
