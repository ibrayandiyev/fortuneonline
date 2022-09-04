<header class="app-header header"> <meta charset="UTF-8">
    <!-- Navbar Right Menu-->
    <div class="container-fluid">
        <div class="d-flex">
            <a class="header-brand" href="{{route('home')}}">
                <img alt="logo" class="header-brand-img main-logo" src="{{asset('assets/images/brand/logofortuneonline.png')}}">
                <img alt="logo" class="header-brand-img mobile-logo" src="{{asset('assets/images/brand/icon.png')}}">
            </a>

            <!-- Sidebar toggle button-->
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
            <div class="header-searchinput">
                <div class="d-sm-flex d-none">
                    <a href="#" class="nav-link icon full-screen-link">
                        <i class="fas fa-money-bill-alt"></i> &nbsp;&nbsp;<p class="arriba">Fortune Online solo acepta transacciones bancarias. NO ACEPTAMOS depósitos en efectivo.</p>
                    </a>
                </div>
            </div>

            <div class="d-flex order-lg-2 ml-auto">
                <div class="d-sm-flex d-none">
                    <a href="#" class="nav-link icon full-screen-link">
                        <i class="fe fe-minimize fullscreen-button"></i>
                    </a>
                </div>

                <button class="navbar-toggler navresponsive-toggler d-sm-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fe fe-more-vertical text-white"></span>
                </button>
                <!--Navbar -->

                <div class="dropdown">
                    <a class="nav-link pr-0 leading-none d-flex" data-toggle="dropdown" href="#">
                        <span class="avatar avatar-md brround cover-image" data-image-src="{{asset('assets/images/users/female/25.png')}}"></span>
                        <span class="ml-2 d-none d-lg-block">
                            <span class="text-dark">{{\Auth::User()->usuario ? \Auth::User()->usuario->empresa == 1 ? \Auth::User()->usuario->razon_social : \Auth::User()->firstname.' '.\Auth::User()->lastname : \Auth::User()->firstname.' '.\Auth::User()->lastname}}</span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item {{Request::is('perfil') ? 'active' : ''}}" href="{{route('perfil')}}"><i class="dropdown-icon fa-solid fa-circle-user"></i>Perfil de usuario</a>
                        <a class="dropdown-item" href="{{route('ayuda')}}"><i class="dropdown-icon fa-solid fa-circle-question"></i> ¿Dudas?</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Cerrar sesión"><i class="dropdown-icon fa-solid fa-door-open"></i>Salir</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			                @csrf
			            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="mb-1 navbar navbar-expand-lg  responsive-navbar navbar-dark d-sm-none bg-white">
    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
        <div class="d-flex order-lg-2 ml-auto">
            <div class="dropdown d-md-flex header-message">
                <a class="nav-link icon text-dark" data-toggle="dropdown">
                    <i class="far fa-clock"></i> &nbsp;&nbsp;Estamos para ti en horario extendido: Lunes a viernes de 9am a 7pm y Sábado 9am a 1pm
                </a>
            </div>
        </div>
    </div>
</div>
