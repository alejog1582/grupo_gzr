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
                <h1>Biblioteca Media</h1>
            </div>
            <div class="col-2">
                <!-- Modal Import Boton-->
                <button type="button" class="btn boton_menu" data-bs-toggle="modal" data-bs-target="#mediaModal">
                    Importar
                </button>

                <!-- Modal Import-->
                <div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby="mediaModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="mediaModalLabel">Subir Media</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/dashboard/fidepuntos/nuevabibliotecamedia/save" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-row">
                                        <div class="form-group col-4">
                                            <label for="nombre"><b>Nombre</b></label>
                                            <input required type="text" class="form-control" name="nombre">
                                            <br>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="tipo"><b>Tipo *</b></label>
                                            <select id="tipo" class="form-control" name="tipo">
                                                    <option selected disabled value="">Seleccione una opcion</option>
                                                @foreach ($tipos_medias as $tp)
                                                    <option value="{{$tp->nombre_tipo_media}}">{{$tp->nombre_tipo_media}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="descripcion"><b>Descripcion *</b></label>
                                            <select id="descripcion" class="form-control" name="descripcion">
                                                    <option selected disabled value="">Seleccione una opcion</option>
                                                @foreach ($descripcion_medias as $dm)
                                                    <option value="{{$dm->nombre_descripcion_media}}">{{$dm->nombre_descripcion_media}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="slugs"><b>Slugs</b></label>
                                            <input type="text" class="form-control" name="slugs">
                                            <br>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="media"><b>Subir Imagen</b></label>
                                            <input required type="file" class="form-control" name="media">
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
                <a href="/dashboard/fidepuntos" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            @foreach ($medias as $media)
            <div class="col-3">
                <div class="card h-100">
                    <img src="{{$media->url}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center"><b>{{$media->nombre}}</b></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>ID: </b>{{$media->id}}</li>
                        <li class="list-group-item"><b>Tipo: </b>{{$media->tipo}}</li>
                        <li class="list-group-item"><b>Descripcion: </b>{{$media->descripcion}}</li>
                        <li class="list-group-item"><b>Slugs: </b>{{$media->slugs}}</li>
                    </ul>
                    <div class="card-body">
                        <a href="/dashboard/fidepuntos/bibliotecamedia//update/{{$media->id}}" class="btn boton_menu">Editar</a>
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
