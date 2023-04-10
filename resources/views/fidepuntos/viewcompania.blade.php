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
                <h1 class="titulo-vista">Compañia {{$compania->nombre_compania}}</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/companias" class="btn boton_menu">Regresar</a>
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
                        {{$compania->id}}
                    </div>
                  </div>
                  <hr class="separador">
                  <div class="row">
                    <div class="col">
                        <b>Tipo:</b>
                    </div>
                    <div class="col">
                        {{$compania->tipo}}
                    </div>
                  </div>
                  <hr class="separador">
                  <div class="row">
                    <div class="col">
                        <b>Identificacion:</b>
                    </div>
                    <div class="col">
                        {{$compania->identificacion}}
                    </div>
                  </div>
                  <hr class="separador">
                  <div class="row">
                    <div class="col">
                        <b>Nombre Compañia:</b>
                    </div>
                    <div class="col">
                        {{$compania->nombre_compania}}
                    </div>
                  </div>
                  <hr class="separador">
                  <div class="row">
                    <div class="col">
                        <b>Nombre Contacto:</b>
                    </div>
                    <div class="col">
                        {{$compania->nombre_contacto}}
                    </div>
                  </div>
                  <hr class="separador">
                  <div class="row">
                    <div class="col">
                        <b>Celular Contacto:</b>
                    </div>
                    <div class="col">
                        {{$compania->celular_contacto}}
                    </div>
                  </div>
                  <hr class="separador">
                  <div class="row">
                    <div class="col">
                        <b>Telefono Contacto:</b>
                    </div>
                    <div class="col">
                        {{$compania->telefono_contacto}}
                    </div>
                  </div>
                  <hr class="separador">
                  <div class="row">
                    <div class="col">
                        <b>Email Contacto:</b>
                    </div>
                    <div class="col">
                        {{$compania->email_contacto}}
                    </div>
                  </div>
                  <hr class="separador">
                  <div class="row">
                    <div class="col">
                        <b>Direccion:</b>
                    </div>
                    <div class="col">
                        {{$compania->direccion}}
                    </div>
                  </div>
                  <hr class="separador">
                  <div class="row">
                    <div class="col">
                        <b>Ciudad:</b>
                    </div>
                    <div class="col">
                        {{$compania->ciudad}}
                    </div>
                  </div>
                  <hr class="separador">
                  <div class="row">
                    <div class="col">
                        <b>Codigo Postal:</b>
                    </div>
                    <div class="col">
                        {{$compania->codigo_postal}}
                    </div>
                  </div>
                  <hr class="separador">
                  <div class="row">
                    <div class="col">
                        <b>Activo:</b>
                    </div>
                    <div class="col">
                        {{$compania->activo}}
                    </div>
                  </div>
                  <hr class="separador">
                  <div class="row">
                    <div class="col">
                        <b>ERP:</b>
                    </div>
                    <div class="col">
                        {{$compania->erp}}
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
