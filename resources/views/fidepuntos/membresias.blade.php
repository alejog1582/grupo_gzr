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
                <h1 class="titulo-vista">Membresia</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/nuevamembresia" class="btn boton_menu">Crear ERP</a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead  class="encabezado_tabla">
                  <tr>
                    <th scope="col">Membresia</th>
                    <th scope="col">Puntos a Otorgar</th>
                    <th scope="col">Activo</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody class="cuerpo_tabla">
                    @foreach ($membresias as $membresia)
                        <tr>
                            <th>{{$membresia->membresia}}</th>
                            <th>{{$membresia->puntos_otorgar}}</th>
                            <th>{{$membresia->activo}}</th>
                            <th>
                                <div class='btn-group'>
                                    <a href="/dashboard/fidepuntos/membresias/{{$membresia->id}}" class='btn btn-ver'><i class="fas fa-eye"></i></a>
                                    <a href="/dashboard/fidepuntos/membresias/update/{{$membresia->id}}" class='btn btn-warning'><i class="fas fa-edit"></i></a>
                                </div>
                            </th>
                        </tr>
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
