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
                <h1>Configuracion Fidelizacion Clientes</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/nuevafidelizacionconfig" class="btn boton_menu">Crear Config Fidelizacion</a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Compania</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Tipo Fidelizacion</th>
                        <th scope="col">Porcentaje Descuento Canje</th>
                        <th scope="col">Numero Compras Canje</th>
                        <th scope="col">Producto a Canjear</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fidelizacionconfig as $fc)
                        <tr>
                            <th>{{$fc->planpuntosxcompania->compania->nombre_compania}}</th>
                            <th>{{$fc->producto->nombre_producto}}</th>
                            <th>{{$fc->tipo_fidelizacion}}</th>
                            <th>{{$fc->porcentaje_descuento_canje}}</th>
                            <th>{{$fc->numero_compras_canje}}</th>
                            <th>{{$fc->productocanjeable->nombre_producto}}</th>
                            <th>
                                <div class='btn-group'>
                                    <a href="/dashboard/fidepuntos/erps/{{$fc->id}}" class='btn btn-info'><i class="fas fa-eye"></i></a>
                                    <a href="/dashboard/fidepuntos/erps/update/{{$fc->id}}" class='btn btn-warning'><i class="fas fa-edit"></i></a>

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
