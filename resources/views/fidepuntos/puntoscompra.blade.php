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
                <h1 class="titulo-vista">Puntos x Compra</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead  class="encabezado_tabla">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Compañia</th>
                    <th scope="col">Valor Punto</th>
                    <th scope="col">Valor Punto Canje</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody class="cuerpo_tabla">
                    @foreach ($companiasplanpuntoscompra as $cppc)
                        <tr>
                            <th>{{$cppc->compania->id}}</th>
                            <th>{{$cppc->compania->nombre_compania}}</th>
                            <th>
                                @foreach ($puntoscompra as $pc)
                                    @if ($pc->plan_puntos_compania_id == $cppc -> id)
                                        {{$pc->valor_punto}}
                                    @endif
                                @endforeach
                            </th>
                            <th>
                                @foreach ($puntoscompra as $pc)
                                    @if ($pc->plan_puntos_compania_id == $cppc -> id)
                                        {{$pc->valor_punto_canje}}
                                    @endif
                                @endforeach
                            </th>
                            <th>
                                <div class='btn-group'>
                                    <a href="/dashboard/fidepuntos/puntoscompra/update/{{$cppc->id}}" class='btn btn-warning'><i class="fas fa-edit"></i></a>
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
