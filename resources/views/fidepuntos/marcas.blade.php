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
                <h1>Marcas</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/nuevamarca" class="btn boton_menu">Crear Marca</a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre Marca</th>
                    <th scope="col">Compañia</th>
                    <th scope="col">Fabricante</th>
                    <th scope="col">Activo</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($marcas as $marca)
                        @if ($marca->compania->activo)
                            <tr>
                                <th>{{$marca->id}}</th>
                                <th>{{$marca->nombre_marca}}</th>
                                <th>{{$marca->compania->nombre_compania}}</th>
                                <th>{{$marca->fabricante->nombre_fabricante}}</th>
                                <th>
                                    @if ($marca->activo)
                                        Si
                                    @else
                                        No
                                    @endif
                                </th>
                                <th>
                                    <div class='btn-group'>
                                        <a href="/dashboard/fidepuntos/marcas/{{$marca->id}}" class='btn btn-info'><i class="fas fa-eye"></i></a>
                                        <a href="/dashboard/fidepuntos/marcas/update/{{$marca->id}}" class='btn btn-warning'><i class="fas fa-edit"></i></a>

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
