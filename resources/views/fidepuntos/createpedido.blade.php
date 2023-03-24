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
            $('#cliente_id').empty();
            $('#tabla_productos').empty();
            var selectedOption = this.options[compania.selectedIndex];
            console.log(selectedOption.value);
            $.ajax({
                url: "{{route('obtenerclientesxcompania')}}",
                dataType: "json",
                data: {
                    compania_id: selectedOption.value,
                },
                success: function (response) {
                    if (response.length > 0) {
                        response.forEach(element => {
                            console.log(element);
                            $('#cliente_id').append("<option value='" + element.id + "'>" + element.identificacion + ' - ' + element.nombre_completo + "</option>");
                        });
                    }else{
                        alert("la compañia seleccionad no cuenta con fabricantes");
                    }
                }

            });
            $.ajax({
                url: "{{route('obtenerproductospedidosxcompania')}}",
                dataType: "json",
                data: {
                    compania_id: selectedOption.value,
                },
                success: function (response) {
                    if (response.length > 0) {
                        response.forEach(element => {
                            console.log(element);
                            $('#tabla_productos').append("<tr><td>"+element.codigo_producto+"</td><td>"+element.nombre_producto+"</td><td>"+"<input value='1' type='number' class='form-control' name='cantidadprod-"+element.id+"'>"+"</td><td>"+"<input type='checkbox' value='"+element.id+"' class='form-control' name='seleccionadoprod-"+element.id+"'>"+"</td></tr>");
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
                <h1>Crear Nuevo Pedido</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/pedidos" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card">
                <br>
                <div class="container">
                    <form action="/dashboard/fidepuntos/nuevapedidos/save" method="post" >
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="compania_id"><b>Compañia *</b></label>
                                <select id="compania_id" class="form-control" name="compania_id">
                                        <option selected disabled value="">Seleccione una opcion</option>
                                    @foreach ($companias as $compania)
                                        <option value="{{$compania->id}}">{{$compania->nombre_compania}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="cliente_id"><b>Cliente *</b></label>
                                <select id="cliente_id" class="form-control" name="cliente_id">
                                        {{-- <option selected disabled value="">Seleccione una opcion</option> --}}
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="fecha_envio"><b>Fecha Envio *</b></label>
                                <input required type="date" class="form-control" id="fecha_envio" name="fecha_envio">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="metodo_pago"><b>Metodo de Pago *</b></label>
                                <select required id="metodo_pago" class="form-control" name="metodo_pago">
                                    <option value="">Seleccione Metodo de Pago</option>
                                    <option value="contraentrega">Contraentrega</option>
                                    <option value="transferencia">Transferencia</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="fecha_pago"><b>Fecha Pago *</b></label>
                                <input required type="date" class="form-control" id="fecha_pago" name="fecha_pago">
                            </div>
                        </div>
                        <hr>
                        <h3 class="text-center">Productos</h3>
                        <hr>
                        <div class="form-row">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Codigo Producto</th>
                                    <th scope="col">Nombre Producto</th>
                                    <th scope="col">Cantidades</th>
                                    <th scope="col">Seleccionar</th>
                                  </tr>
                                </thead>
                                <tbody id="tabla_productos">

                                </tbody>
                              </table>
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
