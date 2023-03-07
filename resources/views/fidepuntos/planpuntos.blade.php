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
                <h1>Planes de Puntos x Compania</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Compañia</th>
                    <th scope="col">Puntos x Compras</th>
                    <th scope="col">Puntos x Producto</th>
                    <th scope="col">Fidelizacion Clientes</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($companias as $compania)
                        <tr>
                            <th>{{$compania->id}}</th>
                            <th>{{$compania->nombre_compania}}</th>
                            <th>
                                @foreach ($planpuntos as $pp)
                                    @if ($pp->compania_id == $compania->id && $pp->plan_puntos_id == '1' && $pp->activo == '1')
                                        Activo
                                    @endif
                                @endforeach
                            </th>
                            <th>
                                @foreach ($planpuntos as $pp)
                                    @if ($pp->compania_id == $compania->id && $pp->plan_puntos_id == '2' && $pp->activo == '1')
                                        Activo
                                    @endif
                                @endforeach
                            </th>
                            <th>
                                @foreach ($planpuntos as $pp)
                                    @if ($pp->compania_id == $compania->id && $pp->plan_puntos_id == '3' && $pp->activo == '1')
                                        Activo
                                    @endif
                                @endforeach
                            </th>
                            <th>
                                <div class='btn-group'>
                                    <a href="/dashboard/fidepuntos/planpuntos/update/{{$compania->id}}" class='btn btn-warning'><i class="fas fa-edit"></i></a>
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
