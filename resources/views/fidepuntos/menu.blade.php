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
                        <a href="#">Productos</a>
                    </li>
                    <li>
                        <a href="#">Fabricantes</a>
                    </li>
                    <li>
                        <a href="#">Marcas</a>
                    </li>
                    <li>
                        <a href="#">Categorias</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#configpuntosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Config. Puntos</a>
                <ul class="collapse list-unstyled" id="configpuntosSubmenu">
                    <li>
                        <a href="#">Activar Plan de Puntos</a>
                    </li>
                    <li>
                        <a href="#">Puntos x Compras</a>
                    </li>
                    <li>
                        <a href="#">Puntos x Productos</a>
                    </li>
                    <li>
                        <a href="#">Fidelizacion Clientes Config</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#cargueventasSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Cargue Ventas</a>
                <ul class="collapse list-unstyled" id="cargueventasSubmenu">
                    <li>
                        <a href="#">Ventas Puntos</a>
                    </li>
                    <li>
                        <a href="#">Ventas Fidelizacion</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#pedidosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pedidos</a>
                <ul class="collapse list-unstyled" id="pedidosSubmenu">
                    <li>
                        <a href="#">Canje de puntos</a>
                    </li>
                    <li>
                        <a href="#">Ecommerce</a>
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
