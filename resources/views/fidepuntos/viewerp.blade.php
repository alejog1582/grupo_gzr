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
                <h1>ERP Compañia {{$erp->compania->nombre_compania}}</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/erps" class="btn boton_menu">Regresar</a>
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
                        {{$erp->id}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Compania ID:</b>
                    </div>
                    <div class="col">
                        {{$erp->compania_id}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Endpoint:</b>
                    </div>
                    <div class="col">
                        {{$erp->endpoint}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Sistema ERP:</b>
                    </div>
                    <div class="col">
                        {{$erp->sistema_erp}}
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
