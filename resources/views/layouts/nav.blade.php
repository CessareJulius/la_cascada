    <header>
        <div class="total-content">
        <div class="contenedor" id="uno">
            <a href="{{ route('home') }}">
                <img class="icon {{ Request::is('home') ? 'active' : '' }}"
                        src="{{ asset('imagenes/home.png') }}">
                <p class="texto">Inicio</p>
            </a>
        </div>

        @if(Auth::user()->role == 'admin')
        <div class="contenedor" id="tres">
            <a href="{{ route('mesas.index') }}">
                <img class="icon {{ Request::is(['mesas', 'mesas/*']) ? 'active' : '' }}"
                        src="{{ asset('imagenes/video_conference1600.png') }}">
                <p class="texto">Mesas</p>
            </a>
        </div>

        <div class="contenedor" id="dos">
            <a href="{{ route('clientes.index') }}">
                <img class="icon {{ Request::is(['clientes', 'clientes/*']) ? 'active' : '' }}"
                        src="{{ asset('imagenes/network_add.png') }}">
                <p class="texto">Clientes</p>
            </a>
        </div>

        <div class="contenedor" id="cinco">
            <a href="{{ route('users.index') }}">
                <img class="icon {{ Request::is(['users', 'users/*']) ? 'active' : '' }}"
                        src="{{ asset('imagenes/registro-de-usuarios.png') }}">
                <p class="texto">Usuarios</p>
            </a>
        </div>
        @endif

        <div class="contenedor" id="siete">
            <a href="{{ route('menus.index') }}">
                <img class="icon {{ Request::is(['menus', 'menus/*']) ? 'active' : '' }}"
                src="{{ asset('imagenes/al.png') }}">
                <p class="texto">Menú</p>
            </a>
        </div>

        <div class="contenedor" id="seis">
            <a href="{{ route('pedidos.index') }}">
                <img class="icon {{ Request::is(['pedidos', 'pedidos/*']) ? 'active' : '' }}"
                src="{{ asset('imagenes/al.png') }}">
                <p class="texto">Pedidos</p>
            </a>
        </div>

        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'cajero')
        <div class="contenedor" id="ocho">
            <a href="{{ route('facturas.index') }}">
                <img class="icon {{ Request::is(['facturas', 'facturas/*']) ? 'active' : '' }}"
                src="{{ asset('imagenes/reclamar_facturas_01.png') }}">
                <p class="texto">Facturar</p>
            </a>
        </div>
        <div class="contenedor" id="nueve">
            <a href="">
                <img class="icon" src="{{ asset('imagenes/Reporte.png') }}">
                <p class="texto">Reporte</p>
            </a>
        </div>
        @endif

        <div class="contenedor" id="diez">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <img class="icon" src="{{ asset('imagenes/liberar-icono-3901-128.png') }}">
                <p class="texto">Salir</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
    </header>