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
                <h1>Detalle Pedido: {{$pedido->id}}</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/pedidos" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    {{-- <th scope="col">producto_id</th> --}}
                    <th scope="col">nombre</th>
                    <th scope="col">cantidad</th>
                    <th scope="col">precio_unitario</th>
                    <th scope="col">iva</th>
                    <th scope="col">impoconsumo</th>
                    <th scope="col">descuento</th>
                    <th scope="col">Precio Total</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($productosxpeidos as $prod)
                        <tr>
                            {{-- <th>{{$prod->id}}</th> --}}
                            <th>{{$prod->producto->nombre_producto}}</th>
                            <th>{{$prod->cantidad}}</th>
                            <th>{{$prod->precio_unitario}}</th>
                            <th>{{$prod->iva}}</th>
                            <th>{{$prod->impoconsumo}}</th>
                            <th>{{$prod->descuento_valor}}</th>
                            <th>{{$prod->precio}}</th>
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
