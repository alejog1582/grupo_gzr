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
                <h1>Cliente a Editar: {{$producto->nombre_producto}}</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/productos" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card">
                <br>
                <div class="container">
                    <form action="/dashboard/fidepuntos/productos/update/save" method="post" >
                        {{ csrf_field() }}
                        <input type="hidden" name="producto_id" value="{{$producto->id}}">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="nombre_producto"><b>Nombre Producto *</b></label>
                                <input required type="text" class="form-control" id="nombre_producto" name="nombre_producto" value="{{$producto->nombre_producto}}">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="codigo_producto"><b>Codigo Producto</b></label>
                                <input required type="text" class="form-control" id="codigo_producto" name="codigo_producto" value="{{$producto->codigo_producto}}">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="ean"><b>EAN</b></label>
                                <input type="text" class="form-control" id="ean" name="ean" value="{{$producto->ean}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="marca_id"><b>Marca *</b></label>
                                <select id="marca_id" class="form-control" name="marca_id">
                                    @foreach ($marcas as $marca)
                                        @if ($marca->fabricante_id == $producto->fabricante_id)
                                            @if ($producto->marca_id == $marca->id)
                                                <option value="{{ $marca->id }}" selected>{{$marca->nombre_marca}}</option>
                                            @else
                                                <option value="{{ $marca->id }}">{{$marca->nombre_marca}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="categoria_id"><b>Categoria *</b></label>
                                <select id="categoria_id" class="form-control" name="categoria_id">
                                    @foreach ($categorias as $categoria)
                                        @if ($categoria->compania_id == $producto->compania_id)
                                            @if ($producto->categoria_id == $categoria->id)
                                                <option value="{{ $categoria->id }}" selected>{{$categoria->nombre_categoria}}</option>
                                            @else
                                                <option value="{{ $categoria->id }}">{{$categoria->nombre_categoria}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="tipo"><b>Tipo *</b></label>
                                <select id="tipo" class="form-control" name="tipo">
                                    @if ( $producto->tipo	== "producto")
                                        <option selected value="producto">Producto</option>
                                        <option value="servicio">Servicio</option>
                                    @endif
                                    @if ( $producto->tipo	== "servicio")
                                        <option value="producto">Producto</option>
                                        <option selected value="servicio">Servicio</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="objetivo"><b>Objetivo *</b></label>
                                <select id="objetivo" class="form-control" name="objetivo">
                                    @if ( $producto->objetivo	== "ecommerce")
                                        <option selected value="ecommerce">Ecommerce</option>
                                        <option value="canje">Canje</option>
                                        <option value="mixto">Mixto</option>
                                    @endif
                                    @if ( $producto->objetivo	== "canje")
                                        <option value="ecommerce">Ecommerce</option>
                                        <option selected value="canje">Canje</option>
                                        <option value="mixto">Mixto</option>
                                    @endif
                                    @if ( $producto->objetivo	== "mixto")
                                        <option value="ecommerce">Ecommerce</option>
                                        <option value="canje">Canje</option>
                                        <option selected value="mixto">Mixto</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="presentacion_talla_tamano"><b>Presentacion / Tamaño / Talla</b></label>
                                <input type="text" class="form-control" id="presentacion_talla_tamano" name="presentacion_talla_tamano" value="{{$producto->presentacion_talla_tamano}}">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="inventario"><b>Inventario</b></label>
                                <input type="number" class="form-control" id="inventario" name="inventario" value="{{$producto->inventario}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="oferta"><b>Oferta *</b></label>
                                <select id="oferta" class="form-control" name="oferta">
                                    @if ( $producto->objetivo	== 0)
                                        <option selected value="no">No</option>
                                        <option  value="si">Si</option>
                                    @endif
                                    @if ( $producto->objetivo	== 1)
                                        <option  value="no">No</option>
                                        <option selected value="si">Si</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="descuento_porcentaje"><b>Descuento de Porcentaje</b></label>
                                <input type="number" class="form-control" id="descuento_porcentaje" name="descuento_porcentaje"  value="{{$producto->descuento_porcentaje}}">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="descuento_valor"><b>Descuento Valor</b></label>
                                <input type="number" class="form-control" id="descuento_valor" name="descuento_valor"  value="{{$producto->descuento_valor}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="precio_unitario"><b>Precio Unitario</b></label>
                                <input required type="number" class="form-control" id="precio_unitario" name="precio_unitario"  value="{{$producto->precio_unitario}}">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="iva"><b>IVA *</b></label>
                                <select required id="iva" class="form-control" name="iva">
                                    @if ($producto->iva	> 0)
                                        <option  value="sin">Sin IVA</option>
                                        <option selected value="19">19 %</option>
                                    @endif
                                    @if ($producto->iva == null || $producto->iva == 0)
                                        <option selected value="sin">Sin IVA</option>
                                        <option  value="19">19 %</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="impoconsumo"><b>Impoconsumo *</b></label>
                                <select required id="impoconsumo" class="form-control" name="impoconsumo">
                                    @if ($impoconsumo == 0)
                                        <option selected value="sin">Sin Impoconsumo</option>
                                        <option  value="4">4 %</option>
                                        <option  value="8">8 %</option>
                                        <option  value="16">16 %</option>
                                    @endif
                                    @if ($impoconsumo == 4)
                                        <option  value="sin">Sin Impoconsumo</option>
                                        <option selected value="4">4 %</option>
                                        <option  value="8">8 %</option>
                                        <option  value="16">16 %</option>
                                    @endif
                                    @if ($impoconsumo == 8)
                                        <option  value="sin">Sin Impoconsumo</option>
                                        <option  value="4">4 %</option>
                                        <option selected value="8">8 %</option>
                                        <option  value="16">16 %</option>
                                    @endif
                                    @if ($impoconsumo == 16)
                                        <option  value="sin">Sin Impoconsumo</option>
                                        <option  value="4">4 %</option>
                                        <option  value="8">8 %</option>
                                        <option selected value="16">16 %</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="precio_puntos"><b>Precio Puntos</b></label>
                                <input type="number" class="form-control" id="precio_puntos" name="precio_puntos"  value="{{$producto->precio_puntos}}">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="fidelizacion"><b>Fidelizacion *</b></label>
                                <select id="fidelizacion" class="form-control" name="fidelizacion">
                                    @if ($producto->fidelizacion == 1)
                                        <option selected value="1" selected>Si</option>
                                        <option  value="0">No</option>
                                    @endif
                                    @if ($producto->fidelizacion == 0)
                                        <option  value="1" selected>Si</option>
                                        <option selected value="0">No</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="activo"><b>Activo *</b></label>
                                <select id="activo" class="form-control" name="activo">
                                    @if ($producto->activo == 1)
                                        <option selected value="1" selected>Si</option>
                                        <option  value="0">No</option>
                                    @endif
                                    @if ($producto->activo == 0)
                                        <option  value="1" selected>Si</option>
                                        <option selected value="0">No</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        {{-- <div class="form-row">
                            <div class="form-group col-4">
                                <label for="media_secundaria"><b>Subir Imagen Secundaria</b></label>
                                <input type="file"  id="media_secundaria" class="form-control-file" name="media_secundaria">
                            </div>
                            <div class="form-group col-4">
                                <label for="media_terciaria"><b>Subir Imagen Terciaria</b></label>
                                <input type="file" id="media_terciaria" class="form-control-file" name="media_secundaria">
                            </div>
                            <div class="form-group col-4">
                                <label for="media_video"><b>Subir Video</b></label>
                                <input type="file" id="media_video" class="form-control-file" name="media_video">
                            </div>
                        </div> --}}
                        <button type="submit" class="btn boton_menu">Actualizar</button>
                        <br><br>
                    </form>
                </div>
            </div>
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
