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
                <h1 class="titulo-vista">Compañia a Editar: {{$compania->nombre_compania}}</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/companias" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card cuerpo_tabla">
                <br>
                <div class="container">
                    <form action="/dashboard/fidepuntos/companias/update/save" method="post" >
                        {{ csrf_field() }}
                        <input type="hidden" name="compania_id" value="{{$compania->id}}">
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="identificacion"><b>Identificacion *</b></label>
                                <input required type="text" class="form-control" id="identificacion" name="identificacion" value="{{$compania->identificacion}}">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="nombre_compania"><b>Nombre Compañia *</b></label>
                                <input required type="text" class="form-control" id="nombre_compania" name="nombre_compania" value="{{$compania->nombre_compania}}">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="tipo"><b>Tipo *</b></label>
                                <select id="tipo" class="form-control" name="tipo">
                                    @if ( $compania->tipo	== null)
                                        <option value="">Seleccione una opcion</option>
                                        <option value="empresa">Empresa</option>
                                        <option value="persona">Persona</option>
                                    @endif
                                    @if ( $compania->tipo	== "empresa")
                                        <option selected value="empresa">Empresa</option>
                                        <option value="persona">Persona</option>
                                    @endif
                                    @if ( $compania->tipo	== "persona")
                                        <option value="empresa">Empresa</option>
                                        <option selected value="persona">Persona</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="nombre_contacto"><b>Nombre Contacto *</b></label>
                                <input required type="text" class="form-control" id="nombre_contacto" name="nombre_contacto" value="{{$compania->nombre_contacto}}">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="celular_contacto"><b>Celular Contacto *</b></label>
                                <input required type="text" class="form-control" id="celular_contacto" name="celular_contacto" value="{{$compania->celular_contacto}}">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="telefono_contacto"><b>Telefono Contacto *</b></label>
                                <input required type="text" class="form-control" id="telefono_contacto" name="telefono_contacto" value="{{$compania->telefono_contacto}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="email_contacto"><b>Email Contacto *</b></label>
                                <input required type="text" class="form-control" id="email_contacto" name="email_contacto" value="{{$compania->email_contacto}}">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="direccion"><b>Direccion *</b></label>
                                <input required type="text" class="form-control" id="direccion" name="direccion" value="{{$compania->direccion}}">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="ciudad"><b>Ciudad *</b></label>
                                <input required type="text" class="form-control" id="ciudad" name="ciudad" value="{{$compania->ciudad}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="codigo_postal"><b>Codigo Postal *</b></label>
                                <input required type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="{{$compania->codigo_postal}}">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="erp"><b>Erp *</b></label>
                                <select id="erp" class="form-control" name="erp">
                                    @if ( $compania->erp	== 1)
                                        <option selected value="1">Si</option>
                                        <option value="0">No</option>
                                    @endif
                                    @if ( $compania->erp	== 0)
                                        <option value="1">Si</option>
                                        <option selected value="0">No</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="activo"><b>Activo *</b></label>
                                <select id="activo" class="form-control" name="activo">
                                    @if ( $compania->activo	== "1")
                                        <option selected value="1">Si</option>
                                        <option value="0">No</option>
                                    @endif
                                    @if ( $compania->activo	== "0")
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
