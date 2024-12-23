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
     @include('flash::message')
        <div class="row">
            <div class="col-10">
                <h1 class="titulo-vista">Mensajes</h1>
            </div>
            {{-- <div class="col-2">
                <a href="/dashboard/fidepuntos/nuevapedidos" class="btn boton_menu">Crear Pedido</a>
            </div> --}}
        </div>
        <div class="row">
            @foreach ($mensajes as $mensaje)
            <div class="col-4">
                <div class="card cuerpo_tabla">
                    <div class="card-header text-center encabezado_tabla">
                    <b>  {{$mensaje->tipo}}</b>
                    </div>
                    <div class="card-body">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item cuerpo_tabla"><b>Nombre:</b> {{$mensaje->nombre}}</li>
                        <li class="list-group-item cuerpo_tabla"><b>Email:</b> {{$mensaje->email}}</li>
                        <li class="list-group-item cuerpo_tabla"><b>Celular:</b> {{$mensaje->celular}}</li>
                        <li class="list-group-item cuerpo_tabla"><b>Nombre Empresa:</b> {{$mensaje->nombre_empresa}}</li>
                        <li class="list-group-item cuerpo_tabla"><b>Plan Cotizacion:</b> {{$mensaje->plan_cotizacion}}</li>
                        <li class="list-group-item cuerpo_tabla"><b>Estado:</b> {{$mensaje->estado}}</li>
                        <li class="list-group-item cuerpo_tabla"><b>Mensaje:</b> {{$mensaje->mensaje}}</li>
                      </ul>
                      {{-- <a href="/dashboard/fidepuntos/mensajes/{{$mensaje->id}}" class="btn boton_menu">Ver Detalle</a> --}}
                    </div>
                  </div>
                  <br>
            </div>
            @endforeach
        </div>
        {{-- <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre Fabricante</th>
                    <th scope="col">Compañia</th>
                    <th scope="col">Activo</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
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
                                        <a href="/dashboard/fidepuntos/fabricantes/{{$fabricante->id}}" class='btn btn-info'><i class="fas fa-eye"></i></a>
                                        <a href="/dashboard/fidepuntos/fabricantes/update/{{$fabricante->id}}" class='btn btn-warning'><i class="fas fa-edit"></i></a>

                                    </div>
                                </th>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
              </table>
        </div> --}}
    </div>
</div>
@endsection

@section('title')
    Administrador Grupo GZR
@endsection

@section('description')
    Panel Administrativo Gurpo GZR.
@endsection
