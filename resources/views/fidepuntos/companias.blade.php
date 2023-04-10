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
                <h1 class="titulo-vista">Compañias</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/nuevacompania" class="btn boton_menu">Crear Compañia</a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead class="encabezado_tabla">
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Identificacion</th>
                    <th scope="col">Nombre Contacto</th>
                    <th scope="col">Email</th>
                    <th scope="col">Celular Contacto</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody class="cuerpo_tabla">
                    @foreach ($companias as $compania)
                        <tr>
                            <th>{{$compania->nombre_compania}}</th>
                            <th>{{$compania->identificacion}}</th>
                            <th>{{$compania->nombre_contacto}}</th>
                            <th>{{$compania->email_contacto}}</th>
                            <th>{{$compania->celular_contacto}}</th>
                            <th>
                                <div class='btn-group'>
                                    <a href="/dashboard/fidepuntos/companias/{{$compania->id}}" class='btn btn-ver'><i class="fas fa-eye"></i></a>
                                    <a href="/dashboard/fidepuntos/companias/update/{{$compania->id}}" class='btn btn-update'><i class="fas fa-edit"></i></a>

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
