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
                <h1>Media a Editar: {{$media->nombre}}</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/bibliotecamedia" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card">
                <br>
                <div class="container">
                    <form action="/dashboard/fidepuntos/bibliotecamedia//update/save" method="post" >
                        {{ csrf_field() }}
                        <input type="hidden" name="media_id" value="{{$media->id}}">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="nombre"><b>Nombre Media *</b></label>
                                <input required type="text" class="form-control" id="nombre" name="nombre" value="{{$media->nombre}}">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="url"><b>URL *</b></label>
                                <input required type="text" class="form-control" id="url" name="url" value="{{$media->url}}">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="tipo"><b>Tipo *</b></label>
                                <select id="tipo" class="form-control" name="tipo">
                                    @foreach ($tipos_medias as $tp)
                                        @if ($media->tipo == $tp->nombre_tipo_media)
                                            <option value="{{ $tp->nombre_tipo_media }}" selected>{{$tp->nombre_tipo_media}}</option>
                                        @else
                                            <option value="{{ $tp->nombre_tipo_media }}">{{$tp->nombre_tipo_media}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="descripcion"><b>descripcion *</b></label>
                                <select id="descripcion" class="form-control" name="descripcion">
                                    @foreach ($descripcion_medias as $dm)
                                        @if ($media->descripcion == $dm->nombre_descripcion_media)
                                            <option value="{{ $dm->nombre_descripcion_media }}" selected>{{$dm->nombre_descripcion_media}}</option>
                                        @else
                                            <option value="{{ $dm->nombre_descripcion_media }}">{{$dm->nombre_descripcion_media}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="slugs"><b>Slugs *</b></label>
                                <input type="text" class="form-control" id="slugs" name="slugs" value="{{$media->slugs}}">
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
