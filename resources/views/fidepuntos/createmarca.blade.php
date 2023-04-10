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
            var selectedOption = this.options[compania.selectedIndex];
            console.log(selectedOption.value);
            $.ajax({
                url: "{{route('obtenerfabricantesxcompania')}}",
                dataType: "json",
                data: {
                    compania_id: selectedOption.value,
                },
                success: function (response) {
                    if (response.length > 0) {
                        response.forEach(element => {
                            console.log(element);
                            $('#fabricante_id').append("<option value='" + element.id + "'>" + element.nombre_fabricante + "</option>");
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
                <h1 class="titulo-vista">Crear Nueva Marca</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/marcas" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card cuerpo_tabla">
                <br>
                <div class="container">
                    <form action="/dashboard/fidepuntos/nuevamarca/save" method="post" >
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
                                <label for="fabricante_id"><b>Fabricante *</b></label>
                                <select id="fabricante_id" class="form-control" name="fabricante_id">
                                        {{-- <option selected disabled value="">Seleccione una opcion</option> --}}
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="nombre_marca"><b>Nombre marca *</b></label>
                                <input required type="text" class="form-control" id="nombre_marca" name="nombre_marca">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="activo"><b>Activo *</b></label>
                                <select id="activo" class="form-control" name="activo">
                                    <option selected value="1">Si</option>
                                    <option value="0">No</option>
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
