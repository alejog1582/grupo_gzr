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
                <h1>Marca {{$marca->nombre_marca}}</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/marcas" class="btn boton_menu">Regresar</a>
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
                        {{$marca->id}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Nombre Marca:</b>
                    </div>
                    <div class="col">
                        {{$marca->nombre_marca}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Compania:</b>
                    </div>
                    <div class="col">
                        {{$marca->compania->nombre_compania}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Fabricante:</b>
                    </div>
                    <div class="col">
                        {{$marca->fabricante->nombre_fabricante}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <b>Activo:</b>
                    </div>
                    <div class="col">
                        @if ($marca->compania->activo)
                            Si
                        @else
                            No
                        @endif
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
