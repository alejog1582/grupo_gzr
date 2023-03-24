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
                <h1>Pedidos</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/nuevapedidos" class="btn boton_menu">Crear Pedido</a>
            </div>
        </div>
        <div class="row">
            @foreach ($pedidos as $pedido)
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                    <b>  {{$pedido->compania->nombre_compania}}</b>
                    </div>
                    <div class="card-body">
                      <h5 class="card-title text-center"><b>Valor Pedido: $ {{number_format($pedido->valor_pedido)}}</b></h5>
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Fecha Envio:</b> {{$pedido->fecha_envio}}</li>
                        <li class="list-group-item"><b>Metodo Pago:</b> {{$pedido->metodo_pago}}</li>
                        <li class="list-group-item"><b>Fecha Pago:</b> {{$pedido->fecha_pago}}</li>
                        <li class="list-group-item"><b>Identificacion Cliente:</b> {{$pedido->cliente->identificacion}}</li>
                        <li class="list-group-item"><b>Nombre Cliente:</b> {{$pedido->cliente->nombre_completo}}</li>
                      </ul>
                      <a href="/dashboard/fidepuntos/pedidos/{{$pedido->id}}" class="btn boton_menu">Ver Detalle</a>
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
