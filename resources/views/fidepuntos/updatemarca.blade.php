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
                <h1 class="titulo-vista">Marca a Editar: {{$marca->nombre_marca}}. Compañia {{$marca->compania->nombre_compania}}</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/marcas" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card cuerpo_tabla">
                <br>
                <div class="container">
                    <form action="/dashboard/fidepuntos/marcas/update/save" method="post" >
                        {{ csrf_field() }}
                        <input type="hidden" name="marca_id" value="{{$marca->id}}">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="nombre_marca"><b>Nombre Marca *</b></label>
                                <input required type="text" class="form-control" id="nombre_marca" name="nombre_marca" value="{{$marca->nombre_marca}}">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="fabricante_id"><b>Fabricante *</b></label>
                                <select id="fabricante_id" class="form-control" name="fabricante_id">
                                    @foreach ($fabricantes as $fabricante)
                                        @if ($fabricante->compania_id == $marca->compania_id)
                                            @if ($marca->fabricante_id == $fabricante->id)
                                                <option value="{{ $fabricante->id }}" selected>{{$fabricante->nombre_fabricante}}</option>
                                            @else
                                                <option value="{{ $fabricante->id }}">{{$fabricante->nombre_fabricante}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="activo"><b>Activo *</b></label>
                                <select id="activo" class="form-control" name="activo">
                                    @if ( $marca->activo	== "1")
                                        <option selected value="1">Si</option>
                                        <option value="0">No</option>
                                    @endif
                                    @if ( $marca->activo	== "0")
                                        <option value="1">Si</option>
                                        <option selected value="0">No</option>
                                    @endif
                                </select>
                            </div>
                        </div>
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
