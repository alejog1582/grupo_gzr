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
            <div class="col-8">
                <h1>Clientes</h1>
            </div>
            <div class="col-4">
                <a href="/dashboard/fidepuntos/nuevocliente" class="btn boton_menu">Crear Cliente</a>
                <!-- Modal Import Boton-->
                <button type="button" class="btn boton_menu" data-bs-toggle="modal" data-bs-target="#importarClientes">
                    Importar
                </button>

                <!-- Modal Import-->
                <div class="modal fade" id="importarClientes" tabindex="-1" aria-labelledby="importarClientesLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="importarClientesLabel">Importar Clientes</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Cargue el archivo en formato excel para cargue masivo de clientes</p>
                                <form action="/dashboard/fidepuntos/imports/clientes" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label for="file_clientes_fidepuntos"><b>Archivo Clientes</b></label>
                                            <input required type="file" class="form-control" name="file_clientes_fidepuntos">
                                            <br>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-6">
                                            <button type="submit" class="btn boton_menu">Cargar</button>
                                            <br><br>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <a href="/dashboard/fidepuntos/exports/plantilla/clientes" class="btn boton_menu"><i class="fas fa-download"></i></a>
                <!-- Modal Import Boton-->
                <button type="button" class="btn boton_menu" data-bs-toggle="modal" data-bs-target="#actualizarErp">
                    Actualizar ERP
                </button>

                <!-- Modal Import-->
                <div class="modal fade" id="actualizarErp" tabindex="-1" aria-labelledby="actualizarErpLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="actualizarErpLabel">Actualizar Clientes Por ERP</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/dashboard/fidepuntos/actualizacioneserps/clientes" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="proceso" value="clientes">
                                    <div class="form-row">
                                        <div class="form-group col-sm-12">
                                            <label for="compania_id"><b>Compañia *</b></label>
                                            <select id="compania_id" class="form-control" name="compania_id">
                                                    <option selected disabled value="">Seleccione una opcion</option>
                                                @foreach ($companias as $compania)
                                                    <option value="{{$compania->id}}">{{$compania->nombre_compania}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-6">
                                            <button type="submit" class="btn boton_menu">Iniciar</button>
                                            <br><br>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Identificacion</th>
                    <th scope="col">Compania</th>
                    <th scope="col">Puntos</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Email</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        @if ($cliente->compania->activo)
                            <tr>
                                <th>{{$cliente->nombre_completo}}</th>
                                <th>{{$cliente->identificacion}}</th>
                                <th>{{$cliente->compania->nombre_compania}}</th>
                                <th>{{$cliente->puntos_total}}</th>
                                <th>{{$cliente->celular}}</th>
                                <th>{{$cliente->email}}</th>
                                <th>
                                    <div class='btn-group'>
                                        <a href="/dashboard/fidepuntos/clientes/{{$cliente->id}}" class='btn btn-info'><i class="fas fa-eye"></i></a>
                                        <a href="/dashboard/fidepuntos/clientes/update/{{$cliente->id}}" class='btn btn-warning'><i class="fas fa-edit"></i></a>

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
