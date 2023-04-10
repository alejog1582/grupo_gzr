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
                <h1 class="titulo-vista">Erps</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/nuevoerp" class="btn boton_menu">Crear ERP</a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead class="encabezado_tabla">
                  <tr>
                    <th scope="col">Compania</th>
                    <th scope="col">Endpoint</th>
                    <th scope="col">Sistema ERP</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody class="cuerpo_tabla">
                    @foreach ($erps as $erp)
                        @if ($erp->compania->activo)
                            <tr>
                                <th>{{$erp->compania->nombre_compania}}</th>
                                <th>{{$erp->endpoint}}</th>
                                <th>{{$erp->sistema_erp}}</th>
                                <th>
                                    <div class='btn-group'>
                                        <a href="/dashboard/fidepuntos/erps/{{$erp->id}}" class='btn btn-ver'><i class="fas fa-eye"></i></a>
                                        <a href="/dashboard/fidepuntos/erps/update/{{$erp->id}}" class='btn btn-update'><i class="fas fa-edit"></i></a>

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
