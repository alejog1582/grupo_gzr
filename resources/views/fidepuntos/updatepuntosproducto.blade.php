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
                <h1 class="titulo-vista">Configuracion Puntos x Productos Compañia: {{$plan_punto_compania->compania->nombre_compania}}</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard/fidepuntos/puntosxproducto" class="btn boton_menu">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div style="width: 100%" class="card cuerpo_tabla">
                <br>
                <div class="container">
                    <form action="/dashboard/fidepuntos/puntosproducto/update/save" method="post" >
                        {{ csrf_field() }}
                        <input type="hidden" name="plan_puntos_compania_id" value="{{$plan_punto_compania->id}}">
                        <div class="row">
                            <div class="col-4">
                                <h3 class="text-center">Fabricantes</h3>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <select required id="fabricante_id" class="form-control" name="fabricante_id">
                                            @foreach ($fabricantes as $fabricante)
                                                <option value="{{ $fabricante->id }}">{{$fabricante->nombre_fabricante}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input placeholder="Puntuaje a asignar" type="number" class="form-control" id="puntaje_asignado_fabricante" name="puntaje_asignado_fabricante">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <table class="table">
                                            <thead  class="encabezado_tabla">
                                              <tr>
                                                <th scope="col">Fabricante</th>
                                                <th scope="col">Puntaje</th>
                                              </tr>
                                            </thead>
                                            <tbody class="cuerpo_tabla">
                                                    <tr>
                                                        @foreach ($configuracion_puntos_productos as $cpp)
                                                            @if ($cpp->fabricante_id != null)
                                                                <th>{{$cpp->fabricante->nombre_fabricante}}</th>
                                                                <th>{{$cpp->puntaje_asignado}}</th>
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                            </tbody>
                                          </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <h3 class="text-center">Marcas</h3>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <select required id="marca_id" class="form-control" name="marca_id">
                                            @foreach ($marcas as $marca)
                                                <option value="{{ $marca->id }}">{{$marca->nombre_marca}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input placeholder="Puntuaje a asignar"  type="number" class="form-control" id="puntaje_asignado_marca" name="puntaje_asignado_marca">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <table class="table">
                                            <thead  class="encabezado_tabla">
                                              <tr>
                                                <th scope="col">Marca</th>
                                                <th scope="col">Puntaje</th>
                                              </tr>
                                            </thead>
                                            <tbody class="cuerpo_tabla">
                                                    <tr>
                                                        @foreach ($configuracion_puntos_productos as $cpp)
                                                            @if ($cpp->marca_id != null)
                                                                <th>{{$cpp->marca->nombre_marca}}</th>
                                                                <th>{{$cpp->puntaje_asignado}}</th>
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                            </tbody>
                                          </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <h3 class="text-center">Categorias</h3>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <select required id="categoria_id" class="form-control" name="categoria_id">
                                            @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id }}">{{$categoria->nombre_categoria}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input placeholder="Puntuaje a asignar"  type="number" class="form-control" id="puntaje_asignado_categoria" name="puntaje_asignado_categoria">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <table class="table">
                                            <thead  class="encabezado_tabla">
                                              <tr>
                                                <th scope="col">Categoria</th>
                                                <th scope="col">Puntaje</th>
                                              </tr>
                                            </thead>
                                            <tbody class="cuerpo_tabla">
                                                    <tr>
                                                        @foreach ($configuracion_puntos_productos as $cpp)
                                                            @if ($cpp->categoria_id != null)
                                                                <th>{{$cpp->categoria->nombre_categoria}}</th>
                                                                <th>{{$cpp->puntaje_asignado}}</th>
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                            </tbody>
                                          </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h3 class="text-center">Productos</h3>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <select id="producto_id" class="form-control" name="producto_id">
                                            @foreach ($productos as $producto)
                                                <option value="{{ $producto->id }}">{{$producto->nombre_producto}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input placeholder="Puntuaje a asignar"  type="number" class="form-control" id="puntaje_asignado_producto" name="puntaje_asignado_producto">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <table class="table">
                                            <thead  class="encabezado_tabla">
                                              <tr>
                                                <th scope="col">Producto</th>
                                                <th scope="col">Puntaje</th>
                                              </tr>
                                            </thead>
                                            <tbody class="cuerpo_tabla">
                                                    <tr>
                                                        @foreach ($configuracion_puntos_productos as $cpp)
                                                            @if ($cpp->producto_id != null)
                                                                <th>{{$cpp->producto->nombre_producto}}</th>
                                                                <th>{{$cpp->puntaje_asignado}}</th>
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                            </tbody>
                                          </table>
                                    </div>
                                </div>
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
