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
                <h1 class="titulo-vista">Categoria {{$categoria->nombre_categoria}}</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/categorias" class="btn boton_menu">Regresar</a>
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
                        {{$categoria->id}}
                    </div>
                  </div>
                  <hr class="separador">
                  <div class="row">
                    <div class="col">
                        <b>Nombre Categoria:</b>
                    </div>
                    <div class="col">
                        {{$categoria->nombre_categoria}}
                    </div>
                  </div>
                  <hr class="separador">
                  <div class="row">
                    <div class="col">
                        <b>Compania:</b>
                    </div>
                    <div class="col">
                        {{$categoria->compania->nombre_compania}}
                    </div>
                  </div>
                  <hr class="separador">
                  <div class="row">
                    <div class="col">
                        <b>Activo:</b>
                    </div>
                    <div class="col">
                        @if ($categoria->compania->activo)
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
