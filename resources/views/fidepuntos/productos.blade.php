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
                <h1 class="titulo-vista">Productos</h1>
            </div>
            <div class="col-4">
                <a href="/dashboard/fidepuntos/nuevoproducto" class="btn boton_menu">Crear Producto</a>
                <!-- Modal Import Boton-->
                <button type="button" class="btn boton_menu" data-bs-toggle="modal" data-bs-target="#importarProductos">
                    Importar
                </button>

                <!-- Modal Import-->
                <div class="modal fade" id="importarProductos" tabindex="-1" aria-labelledby="importarProductosLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="importarProductosLabel">Importar Productos</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Cargue el archivo en formato excel para cargue masivo de productos</p>
                                <form action="/dashboard/fidepuntos/imports/productos" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label for="file_productos_fidepuntos"><b>Archivo Productos</b></label>
                                            <input required type="file" class="form-control" name="file_productos_fidepuntos">
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
                <a href="/dashboard/fidepuntos/exports/plantilla/productos" class="btn boton_menu"><i class="fas fa-download"></i></a>
                <!-- Modal Import Boton-->
                <button type="button" class="btn boton_menu" data-bs-toggle="modal" data-bs-target="#actualizarErpProducto">
                    Actualizar ERP
                </button>

                <!-- Modal Import-->
                <div class="modal fade" id="actualizarErpProducto" tabindex="-1" aria-labelledby="actualizarErpProductoLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="actualizarErpProductoLabel">Actualizar Productos Por ERP</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/dashboard/fidepuntos/actualizacioneserps/productos" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="proceso" value="productos">
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
            @foreach ($productos as $producto)
                <div class="col-6">
                    <div class="accordion" id="accordionExample">
                        <div class="card card_secundaria card-producto">
                            <div class="card-header card_principal" id="headingOne">
                                <h2 class="">
                                    <button class="btn btn-link card_principal txt-encabezado-producto" type="button" data-toggle="collapse" data-target="#collapseOne{{$producto->id}}" aria-expanded="true" aria-controls="collapseOne">
                                        <b>Nombre:</b> {{ $producto->nombre_producto }} || <b>Compañia:</b> {{ $producto->compania->nombre_compania }} || <b>Objetivo:</b> {{ $producto->objetivo }}
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne{{$producto->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="{{$producto->mediaprincial->url}}" alt="" width="100%">
                                        @if ($producto->mediaprincial->id == 1)
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarImagenPrincipalModal{{$producto->id}}">
                                                Editar
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editarImagenPrincipalModal{{$producto->id}}" tabindex="-1" aria-labelledby="editarImagenPrincipalModalLabel{{$producto->id}}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editarImagenPrincipalModalLabel{{$producto->id}}">Editar Imagen Principal</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/dashboard/fidepuntos/actualizacionimagenprincipal" method="POST" enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="producto_id" value="{{$producto->id}}">
                                                            <div class="form-row">
                                                                <div class="form-group col-12">
                                                                    <label for="imagen_principal"><b>Imagen Principal</b></label>
                                                                    <input required type="file" id="imagen_principal" class="form-control" name="imagen_principal">
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
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-8">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col" style="text-align: end">
                                                        <a href="/dashboard/fidepuntos/productos/update/{{$producto->id}}" class='btn btn-warning'><i class="fas fa-edit"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col">
                                                        <b>ID:</b> {{$producto->id}}
                                                    </div>
                                                    <div class="col">
                                                        <b>Activo:</b> {{$producto->activo}}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item"><b>Codigo Producto:</b> {{$producto->codigo_producto}}</li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col">
                                                        <b>Ean:</b> {{$producto->ean}}
                                                    </div>
                                                    <div class="col">
                                                        <b>Tipo:</b> {{$producto->tipo}}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item"><b>Presentacion / Talla / Tamaño:</b> {{$producto->presentacion_talla_tamano}}</li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col">
                                                        <b>Fabricante:</b> {{$producto->fabricante->nombre_fabricante}}
                                                    </div>
                                                    <div class="col">
                                                        <b>Marca:</b> {{$producto->marca->nombre_marca}}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item"><b>Categoria:</b> {{$producto->categoria->nombre_categoria}}</li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col">
                                                        <b>Oferta:</b> {{$producto->oferta}}
                                                    </div>
                                                    <div class="col">
                                                        <b>Descuento Porcentaje:</b> {{$producto->descuento_porcentaje}}
                                                    </div>
                                                    <div class="col">
                                                        <b>Descuento Valor:</b> {{$producto->descuento_valor}}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item"><b>Precio Unitario:</b> {{$producto->precio_unitario}}</li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col">
                                                        <b>IVA:</b> {{$producto->iva}}
                                                    </div>
                                                    <div class="col">
                                                        <b>Impoconsumo:</b> {{$producto->impoconsumo}}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item"><b>Precio:</b> {{$producto->precio}}</li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col">
                                                        <b>Precio Puntos:</b> {{$producto->precio_puntos}}
                                                    </div>
                                                    <div class="col">
                                                        <b>Fidelizacion:</b> {{$producto->fidelizacion}}
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
