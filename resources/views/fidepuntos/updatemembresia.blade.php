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
                <h1>Membresia a Editar: {{$membresia->membresia}}</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/membresias" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card">
                <br>
                <div class="container">
                    <form action="/dashboard/fidepuntos/membresias/update/save" method="post" >
                        {{ csrf_field() }}
                        <input type="hidden" name="membresia_id" value="{{$membresia->id}}">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="membresia"><b>Membresia *</b></label>
                                <input required type="text" class="form-control" id="membresia" name="membresia" value="{{$membresia->membresia}}">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="puntos_otorgar"><b>Puntos a Otorgar *</b></label>
                                <input required type="text" class="form-control" id="puntos_otorgar" name="puntos_otorgar" value="{{$membresia->puntos_otorgar}}">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="activo"><b>Activo *</b></label>
                                <select id="activo" class="form-control" name="activo">
                                    @if ( $membresia->activo	== "1")
                                        <option selected value="1">Si</option>
                                        <option value="0">No</option>
                                    @endif
                                    @if ( $membresia->activo	== "0")
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
