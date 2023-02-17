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
                <h1>Categorias</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/nuevacategoria" class="btn boton_menu">Crear Categoria</a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre Categoria</th>
                    <th scope="col">Compañia</th>
                    <th scope="col">Activo</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        @if ($categoria->compania->activo)
                            <tr>
                                <th>{{$categoria->id}}</th>
                                <th>{{$categoria->nombre_categoria}}</th>
                                <th>{{$categoria->compania->nombre_compania}}</th>
                                <th>
                                    @if ($categoria->activo)
                                        Si
                                    @else
                                        No
                                    @endif
                                </th>
                                <th>
                                    <div class='btn-group'>
                                        <a href="/dashboard/fidepuntos/categorias/{{$categoria->id}}" class='btn btn-info'><i class="fas fa-eye"></i></a>
                                        <a href="/dashboard/fidepuntos/categorias/update/{{$categoria->id}}" class='btn btn-warning'><i class="fas fa-edit"></i></a>

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
