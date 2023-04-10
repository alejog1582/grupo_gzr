<link rel="stylesheet" href="{{ asset('css/menu-fidepuntos.css') }}">
<div class="row">
    <div id="menu-btn-fidepuntos" class="btn-menu-fidepuntos">
        <div class="btn-hamburger-fidepuntos"></div>
        <div class="btn-hamburger-fidepuntos"></div>
        <div class="btn-hamburger-fidepuntos"></div>
    </div>
</div>

    <!-- Sidebar  -->
    <nav id="sidebar">

        <ul class="list-unstyled components">
            <li>
                <a href="/dashboard/fidepuntos">HOME</a>
                <a href="#companiasSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Compañias</a>
                <ul class="collapse list-unstyled" id="companiasSubmenu">
                    <li>
                        <a href="/dashboard/fidepuntos/companias">Compañias</a>
                    </li>
                    <li>
                        <a href="/dashboard/fidepuntos/erps">ERPS</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#clientesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Clientes</a>
                <ul class="collapse list-unstyled" id="clientesSubmenu">
                    <li>
                        <a href="/dashboard/fidepuntos/clientes">Clientes</a>
                    </li>
                    <li>
                        <a href="/dashboard/fidepuntos/membresias">Membresias</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#productosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Productos</a>
                <ul class="collapse list-unstyled" id="productosSubmenu">
                    <li>
                        <a href="/dashboard/fidepuntos/productos">Productos</a>
                    </li>
                    <li>
                        <a href="/dashboard/fidepuntos/bibliotecamedia">Biblioteca Imagenes</a>
                    </li>
                    <li>
                        <a href="/dashboard/fidepuntos/fabricantes">Fabricantes</a>
                    </li>
                    <li>
                        <a href="/dashboard/fidepuntos/marcas">Marcas</a>
                    </li>
                    <li>
                        <a href="/dashboard/fidepuntos/categorias">Categorias</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#configpuntosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Config. Puntos</a>
                <ul class="collapse list-unstyled" id="configpuntosSubmenu">
                    <li>
                        <a href="/dashboard/fidepuntos/planpuntos">Activar Plan de Puntos</a>
                    </li>
                    <li>
                        <a href="/dashboard/fidepuntos/puntosxcompra">Puntos x Compras</a>
                    </li>
                    <li>
                        <a href="/dashboard/fidepuntos/puntosxproducto">Puntos x Productos</a>
                    </li>
                    <li>
                        <a href="/dashboard/fidepuntos/fidelizacionconfig">Fidelizacion Clientes Config</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#cargueventasSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Cargue Puntos</a>
                <ul class="collapse list-unstyled" id="cargueventasSubmenu">
                    <li>
                        <a href="#">Cargue Puntos</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#pedidosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pedidos</a>
                <ul class="collapse list-unstyled" id="pedidosSubmenu">
                    <li>
                        <a href="/dashboard/fidepuntos/pedidos">Pedidos</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#mensajesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Mensajes</a>
                <ul class="collapse list-unstyled" id="mensajesSubmenu">
                    <li>
                        <a href="/dashboard/fidepuntos/mensajes">Mensajes</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

   {{--  <div class="container">
        <div class="row">
            <div id="menu-btn-fidepuntos" class="btn-menu-fidepuntos">
                <div class="btn-hamburger-fidepuntos"></div>
                <div class="btn-hamburger-fidepuntos"></div>
                <div class="btn-hamburger-fidepuntos"></div>
            </div>
        </div>
        <div class="row pt-4">
            @foreach ($tarjetas_fidepuntos as $tarjeta_fidepuntos)
                <div class="col">
                    <div class="card formulario-login">
                        <div class="card-body">
                          <h5 class="card-title">{{$tarjeta_fidepuntos->titulo}}</h5>
                          <p class="card-text">{{$tarjeta_fidepuntos->descripcion}}</p>
                          <a href="{{$tarjeta_fidepuntos->link}}" class="boton_menu">Ver Más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div> --}}
