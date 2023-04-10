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
                <h1 class="titulo-vista">Crear Nueva Compañia</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/companias" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card cuerpo_tabla">
                <br>
                <div class="container">
                    <form action="/dashboard/fidepuntos/nuevacompania/save" method="post" >
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="identificacion"><b>Identificacion *</b></label>
                                <input required type="text" class="form-control" id="identificacion" name="identificacion">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="nombre_compania"><b>Nombre Compañia *</b></label>
                                <input required type="text" class="form-control" id="nombre_compania" name="nombre_compania">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="tipo"><b>Tipo *</b></label>
                                <select id="tipo" class="form-control" name="tipo">
                                        <option selected disabled value="">Seleccione una opcion</option>
                                        <option value="empresa">Empresa</option>
                                        <option value="persona">Persona</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="nombre_contacto"><b>Nombre Contacto *</b></label>
                                <input required type="text" class="form-control" id="nombre_contacto" name="nombre_contacto">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="celular_contacto"><b>Celular Contacto *</b></label>
                                <input required type="text" class="form-control" id="celular_contacto" name="celular_contacto">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="telefono_contacto"><b>Telefono Contacto *</b></label>
                                <input required type="text" class="form-control" id="telefono_contacto" name="telefono_contacto">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="email_contacto"><b>Email Contacto *</b></label>
                                <input required type="text" class="form-control" id="email_contacto" name="email_contacto">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="direccion"><b>Direccion *</b></label>
                                <input required type="text" class="form-control" id="direccion" name="direccion">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="ciudad"><b>Ciudad *</b></label>
                                <input required type="text" class="form-control" id="ciudad" name="ciudad">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="codigo_postal"><b>Codigo Postal *</b></label>
                                <input required type="text" class="form-control" id="codigo_postal" name="codigo_postal">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="erp"><b>Erp *</b></label>
                                <select id="erp" class="form-control" name="erp">
                                    <option disabled selected value="1">Seleccione una opcion</option>
                                    <option value="1">Si</option>
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
