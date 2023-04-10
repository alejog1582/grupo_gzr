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
            $('#producto_id').empty();
            $('#producto_canjeable_id').empty();
            var selectedOption = this.options[compania.selectedIndex];
            console.log(selectedOption.value);
            $.ajax({
                url: "{{route('obtenerproductosxcompania')}}",
                dataType: "json",
                data: {
                    compania_fidelizacion_cliente: selectedOption.value,
                },
                success: function (response) {
                    if (response.length > 0) {
                        response.forEach(element => {
                            console.log(element);
                            $('#producto_id').append("<option value='" + element.id + "'>" + element.nombre_producto + "</option>");
                        });
                        response.forEach(element => {
                            console.log(element);
                            $('#producto_canjeable_id').append("<option value='" + element.id + "'>" + element.nombre_producto + "</option>");
                        });
                    }else{
                        alert("la compañia seleccionad no cuenta con fabricantes");
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
                <h1 class="titulo-vista">Crear Nueva Configuracion de Fidelizacion Cliente</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/fidelizacionconfig" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card cuerpo_tabla">
                <br>
                <div class="container">
                    <form action="/dashboard/fidepuntos/nuevafidelizacionconfig/save" method="post" >
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="compania_id"><b>Compañia *</b></label>
                                <select id="compania_id" class="form-control" name="compania_id">
                                        <option selected disabled value="">Seleccione una opcion</option>
                                    @foreach ($companiasfidelizacionclientes as $cfc)
                                        <option value="{{$cfc->id}}">{{$cfc->compania->nombre_compania}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="producto_id"><b>Producto *</b></label>
                                <select id="producto_id" class="form-control" name="producto_id">
                                        {{-- <option selected disabled value="">Seleccione una opcion</option> --}}
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="tipo_fidelizacion"><b>Tipo_fidelizacion Fidelizacion*</b></label>
                                <select required required id="tipo_fidelizacion" class="form-control" name="tipo_fidelizacion">
                                    <option  value="">Seleccionar una Opcion</option>
                                    <option  value="descuento">Descuento</option>
                                    <option value="producto_gratis">Producto Gratis</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="porcentaje_descuento_canje"><b>Porcentaje Descuento Canje</b></label>
                                <input type="number" class="form-control" id="porcentaje_descuento_canje" name="porcentaje_descuento_canje">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="numero_compras_canje"><b>Numero Compras Canje</b></label>
                                <input required type="number" class="form-control" id="numero_compras_canje" name="numero_compras_canje">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="producto_canjeable_id"><b>Producto a Canjear*</b></label>
                                <select id="producto_canjeable_id" class="form-control" name="producto_canjeable_id">
                                        {{-- <option selected disabled value="">Seleccione una opcion</option> --}}
                                </select>
                            </div>
                        </div>
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
