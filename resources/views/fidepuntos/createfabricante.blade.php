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
                <h1>Crear Nuevo Fabricante</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/fabricantes" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card">
                <br>
                <div class="container">
                    <form action="/dashboard/fidepuntos/nuevofabricante/save" method="post" >
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="compania_id"><b>Compañia *</b></label>
                                <select id="compania_id" class="form-control" name="compania_id">
                                        <option selected disabled value="">Seleccione una opcion</option>
                                    @foreach ($companias as $compania)
                                        <option value="{{$compania->id}}">{{$compania->nombre_compania}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="nombre_fabricante"><b>Nombre Fabricante *</b></label>
                                <input required type="text" class="form-control" id="nombre_fabricante" name="nombre_fabricante">
                            </div>
                            <div class="form-group col-sm-4">
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
