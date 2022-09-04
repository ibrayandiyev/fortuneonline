<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <div class="user-body">
            <span class="avatar avatar-lg brround text-center cover-image" data-image-src="{{asset('assets/images/users/female/25.png')}}"></span>
        </div>
        <div class="user-info">
            <a href="{{route('home')}}" class="ml-2"><span class="text-dark app-sidebar__user-name font-weight-semibold">{{\Auth::User()->usuario ? \Auth::User()->usuario->empresa == 1 ? \Auth::User()->usuario->razon_social : \Auth::User()->firstname.' '.\Auth::User()->lastname : \Auth::User()->firstname.' '.\Auth::User()->lastname}}</span><br>
                <span class="text-muted app-sidebar__user-name text-sm">{{Auth::User()->username}}</span>
            </a>
        </div>
    </div>

    <ul class="side-menu">
        <li class="slide">
            <a class="side-menu__item {{Request::is('home') ? 'active' : ''}}" href="{{route('home')}}"><i class="side-menu__icon fa-solid fa-house-user"></i><span class="side-menu__label">Inicio</span></a>
        </li>

        @if(\Auth::User()->hasRole('Administrators'))
            <li>
                <a class="side-menu__item {{Request::is('lusuario') ? 'active' : ''}}" href="{{route('lusuario')}}"><i class="side-menu__icon fa-solid fa-address-card"></i><span class="side-menu__label">Usuarios</span></a>
            </li>
            <li>
                <a class="side-menu__item {{Request::is('iniciar-operacion-manual') ? 'active' : ''}}" href="{{route('iniciar-operacion-manual')}}"><i class="side-menu__icon fas fa-calculator"></i><span class="side-menu__label">Operación manual</span></a>
            </li>
            {{-- <li>
                <a class="side-menu__item {{Request::is('lbancos') ? 'active' : ''}}" href="{{route('lbancos')}}"><i class="side-menu__icon fa-solid fa-money-check-dollar"></i><span class="side-menu__label">Mis bancos</span></a>
            </li> --}}
        @endif

        <li>
            <a class="side-menu__item {{Request::is('lcuentasbancaria') ? 'active' : ''}}" href="{{route('cuentasbancarias')}}"><i class="side-menu__icon fa-solid fa-building-columns"></i><span class="side-menu__label">Cuentas bancarias</span></a>
        </li>

        @if(\Auth::User()->hasRole('Usuario'))
            <li>
                <a class="side-menu__item {{Request::is('operacion') ? 'active' : ''}}" href="{{route('operacion')}}"><i class="side-menu__icon fa-solid fa-circle-dollar-to-slot"></i><span class="side-menu__label">Operaciones</span></a>
            </li>
        @endif

        @if(\Auth::User()->hasRole('Usuario'))
            <li>
                <a class="side-menu__item {{Request::is('historial') ? 'active' : ''}}" href="{{route('historial')}}"><i class="side-menu__icon fa-solid fa-receipt"></i><span class="side-menu__label">Historial</span></a>
            </li>

            <li>
                <a class="side-menu__item {{Request::is('ayuda') ? 'active' : ''}}" href="{{route('ayuda')}}"><i class="side-menu__icon fa-solid fa-circle-question"></i><span class="side-menu__label">¿Dudas?</span></a>
            </li>
        @endif

        {{-- //TODO ME FALTA ESTO, QUE NOSE QUE ES... --}}
        @if(\Auth::User()->hasRole('Administrators'))
            <li>
                <a class="side-menu__item {{Request::is('tipocambio') ? 'active' : ''}}" href="{{route('tipocambio')}}"><i class="side-menu__icon fas fa-comment-dollar"></i><span class="side-menu__label">Tipo de cambios</span></a>
            </li>

            {{-- <li>
                <a class="side-menu__item {{Request::is('lcodigosdescuento') ? 'active' : ''}}" href="{{route('lcodigosdescuento')}}"><i class="side-menu__icon fas fa-comment-dollar"></i><span class="side-menu__label">Códigos de descuento</span></a>
            </li> --}}

            <li>
                <a class="side-menu__item {{Request::is('reporte') ? 'active' : ''}}" href="{{route('reporte')}}"><i class="side-menu__icon fas fa-receipt"></i><span class="side-menu__label">Transacciones</span></a>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fas fa-chart-pie"></i><span class="side-menu__label">Reportes</span><i class="angle fas fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li>
                        <a href="{{url('reportesbs')}}" class="slide-item">SBS</a>
                    </li>
                    {{-- <li>
                        <a href="{{route('reporte-caja')}}" class="slide-item">BALANCE</a>
                    </li> --}}
                    {{-- <li>
                        <a href="#" class="slide-item">Reporte 01</a>
                    </li> --}}

                </ul>
            </li>
        @endif

        {{--
        @if(\Auth::User()->hasRole('Usuario'))
            <li>
                <a class="side-menu__item" href="libro.html"><i class="side-menu__icon fas fa-comment-dollar"></i><span class="side-menu__label">Libro de reclamaciones</span></a>
            </li>
        @endif
        --}}
    </ul>
</aside>
