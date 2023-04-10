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
                <h1 class="titulo-vista">Fabricantes</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/nuevofabricante" class="btn boton_menu">Crear Fabricante</a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead  class="encabezado_tabla">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre Fabricante</th>
                    <th scope="col">Compañia</th>
                    <th scope="col">Activo</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody class="cuerpo_tabla">
                    @foreach ($fabricantes as $fabricante)
                        @if ($fabricante->compania->activo)
                            <tr>
                                <th>{{$fabricante->id}}</th>
                                <th>{{$fabricante->nombre_fabricante}}</th>
                                <th>{{$fabricante->compania->nombre_compania}}</th>
                                <th>
                                    @if ($fabricante->activo)
                                        Si
                                    @else
                                        No
                                    @endif
                                </th>
                                <th>
                                    <div class='btn-group'>
                                        <a href="/dashboard/fidepuntos/fabricantes/{{$fabricante->id}}" class='btn btn-ver'><i class="fas fa-eye"></i></a>
                                        <a href="/dashboard/fidepuntos/fabricantes/update/{{$fabricante->id}}" class='btn btn-warning'><i class="fas fa-edit"></i></a>

                                    </div>
                                </th>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
              </table>
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
