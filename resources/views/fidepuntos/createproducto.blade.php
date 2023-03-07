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

        var compania = document.querySelector('#compania_id');

        compania.addEventListener('change', function(){
            $('#fabricante_id').empty();
            var selectedOptionFabricante = this.options[compania.selectedIndex];
            console.log(selectedOptionFabricante.value);
            $.ajax({
                url: "{{route('obtenerfabricantesxcompania')}}",
                dataType: "json",
                data: {
                    compania_id: selectedOptionFabricante.value,
                },
                success: function (response) {
                    if (response.length > 0) {
                        $('#fabricante_id').append("<option value=''>Seleccione una Opcion</option>");
                        response.forEach(element => {
                            console.log(element);
                            $('#fabricante_id').append("<option value='" + element.id + "'>" + element.nombre_fabricante + "</option>");
                        });
                    }else{
                        alert("la compañia seleccionad no cuenta con fabricantes");
                    }
                }

            });

            $.ajax({
                url: "{{route('obtenercategoriasxcompania')}}",
                dataType: "json",
                data: {
                    compania_id: selectedOptionFabricante.value,
                },
                success: function (response) {
                    if (response.length > 0) {
                        $('#categoria_id').append("<option value=''>Seleccione una Opcion</option>");
                        response.forEach(element => {
                            console.log(element);
                            $('#categoria_id').append("<option value='" + element.id + "'>" + element.nombre_categoria + "</option>");
                        });
                    }else{
                        alert("la compañia seleccionad no cuenta con fabricantes");
                    }
                }

            });
        });

        var fabricante = document.querySelector('#fabricante_id');

        fabricante.addEventListener('change', function(){
            console.log("Cambiaron fabricante");
            $('#marca_id').empty();
            var selectedOptionMarca = this.options[fabricante.selectedIndex];
            console.log(selectedOptionMarca.value);
            $.ajax({
                url: "{{route('obtenermarcasxcompania')}}",
                dataType: "json",
                data: {
                    fabricante_id: selectedOptionMarca.value,
                },
                success: function (response) {
                    if (response.length > 0) {
                        $('#marca_id').append("<option value=''>Seleccione una Opcion</option>");
                        response.forEach(element => {
                            console.log(element);
                            $('#marca_id').append("<option value='" + element.id + "'>" + element.nombre_marca + "</option>");
                        });
                    }else{
                        alert("la compañia seleccionad no cuenta con marcas");
                    }
                }

            });
        });
    </script>
@endsection

@section('content')

<div class="wrapper-fidepuntos">
    @include('fidepuntos.menu')
    <div class="container">
        <div class="row">
            <div class="col-10">
                <h1>Crear Nuevo Producto</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/productos" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card">
                <br>
                <div class="container">
                    <form action="/dashboard/fidepuntos/nuevoproducto/save" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="nombre_producto"><b>Nombre Producto *</b></label>
                                <input required type="text" class="form-control" id="nombre_producto" name="nombre_producto">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="codigo_producto"><b>Codigo Producto</b></label>
                                <input required type="text" class="form-control" id="codigo_producto" name="codigo_producto">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="ean"><b>EAN</b></label>
                                <input type="text" class="form-control" id="ean" name="ean">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="compania_id"><b>Compañia *</b></label>
                                <select required id="compania_id" class="form-control" name="compania_id">
                                        <option value="">Seleccione una opcion</option>
                                    @foreach ($companias as $compania)
                                        <option value="{{$compania->id}}">{{$compania->nombre_compania}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="fabricante_id"><b>Fabricante *</b></label>
                                <select required id="fabricante_id" class="form-control" name="fabricante_id">
                                        {{-- <option selected disabled value="">Seleccione una opcion</option> --}}
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="marca_id"><b>Marca *</b></label>
                                <select required id="marca_id" class="form-control" name="marca_id">
                                        {{-- <option selected disabled value="">Seleccione una opcion</option> --}}
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="categoria_id"><b>Categoria *</b></label>
                                <select id="categoria_id" class="form-control" name="categoria_id">
                                        {{-- <option selected disabled value="">Seleccione una opcion</option> --}}
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="tipo"><b>Tipo *</b></label>
                                <select required required id="tipo" class="form-control" name="tipo">
                                    <option  value="">Seleccionar una Opcion</option>
                                    <option  value="producto">Producto</option>
                                    <option value="servicio">Servicio</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="objetivo"><b>Objetivo *</b></label>
                                <select required id="objetivo" class="form-control" name="objetivo">
                                    <option  value="">Seleccionar una Opcion</option>
                                    <option  value="ecommerce">Ecommerce</option>
                                    <option  value="canje">Canje</option>
                                    <option value="mixto">Mixto</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="presentacion_talla_tamano"><b>Presentacion / Tamaño / Talla</b></label>
                                <input type="text" class="form-control" id="presentacion_talla_tamano" name="presentacion_talla_tamano">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="inventario"><b>Inventario</b></label>
                                <input type="number" class="form-control" id="inventario" name="inventario">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="precio_unitario"><b>Precio Unitario</b></label>
                                <input required type="number" class="form-control" id="precio_unitario" name="precio_unitario">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="iva"><b>IVA *</b></label>
                                <select required id="iva" class="form-control" name="iva">
                                    <option  value="">Seleccionar una Opcion</option>
                                    <option  value="sin">Sin IVA</option>
                                    <option  value="19">19 %</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="impoconsumo"><b>Impoconsumo *</b></label>
                                <select required id="impoconsumo" class="form-control" name="impoconsumo">
                                    <option  value="">Seleccionar una Opcion</option>
                                    <option  value="sin">Sin Impoconsumo</option>
                                    <option  value="4">4 %</option>
                                    <option  value="8">8 %</option>
                                    <option  value="16">16 %</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="precio_puntos"><b>Precio Puntos</b></label>
                                <input type="number" class="form-control" id="precio_puntos" name="precio_puntos">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="oferta"><b>Oferta *</b></label>
                                <select id="oferta" class="form-control" name="oferta">
                                    <option selected value="no">No</option>
                                    <option  value="si">Si</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="descuento_porcentaje"><b>Descuento de Porcentaje</b></label>
                                <input type="number" class="form-control" id="descuento_porcentaje" name="descuento_porcentaje">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="descuento_valor"><b>Descuento Valor</b></label>
                                <input type="number" class="form-control" id="descuento_valor" name="descuento_valor">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="activo"><b>Activo *</b></label>
                                <select id="activo" class="form-control" name="activo">
                                    <option  value="1" selected>Si</option>
                                    <option  value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="fidelizacion"><b>Fidelizacion *</b></label>
                                <select id="fidelizacion" class="form-control" name="fidelizacion">
                                    <option  value="0" selected>No</option>
                                    <option  value="1">Si</option>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="media_principal"><b>Subir Imagen Principal</b></label>
                                <input type="file" id="media_principal" class="form-control-file" name="media_principal">
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
                        <button type="submit" class="btn boton_menu">Crear</button>
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
