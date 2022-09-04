<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
	<div class="app-sidebar__user">
		<div class="user-body">
			<span class="avatar avatar-lg brround text-center cover-image" data-image-src="{{url('assets/images/users/female/25.png')}}"></span>
		</div>
		<div class="user-info">
			<a href="{{url('home')}}" class="ml-2"><span class="text-dark app-sidebar__user-name font-weight-semibold">{{\Auth::User()->firstname.' '.\Auth::User()->lastname}}</span><br>
				<span class="text-muted app-sidebar__user-name text-sm"> {{Auth::User()->username}}</span>
			</a>
		</div>
	</div>
	<ul class="side-menu">
		<li class="slide">
			<a class="side-menu__item {{Request::is('perfil') ? 'active' : ''}}" href="{{url('home')}}"><i class="side-menu__icon fas fa-home"></i><span class="side-menu__label">PANEL USUARIO</span></a>
		</li>
		@if(\Auth::User()->hasRole('Administrators'))
		<li>
			<a class="side-menu__item {{Request::is('lusuario') ? 'active' : ''}}" href="{{url('lusuario')}}"><i class="side-menu__icon fa-solid fa-address-card"></i><span class="side-menu__label">Usuarios</span></a>
		</li>
		@endif
		<li>
			<a class="side-menu__item {{Request::is('lcuentasbancaria') ? 'active' : ''}}" href="{{url('cuentasbancarias')}}"><i class="side-menu__icon fa-solid fa-building-columns"></i><span class="side-menu__label">Cuentas Bancarias</span></a>
		</li>
		@if(\Auth::User()->hasRole('Usuario'))
		<li>
			<a class="side-menu__item" href="{{url('operacion')}}"><i class="side-menu__icon far fa-money-bill-alt"></i><span class="side-menu__label">INICIAR OPERACIÓN</span></a>
		</li>



		@endif
		@if(\Auth::User()->hasRole('Administrators'))
		<li>
			<a class="side-menu__item" href="{{url('tipocambio')}}"><i class="side-menu__icon fas fa-hand-holding-usd"></i><span class="side-menu__label">Tipo de cambio</span></a>
		</li>
		<li>
			<a class="side-menu__item" href="{{url('reportesbs')}}"><i class="side-menu__icon fas fa-money-check-alt"></i><span class="side-menu__label">Reporte SBS</span></a>
		</li>
		<li>
			<a class="side-menu__item" href="{{url('reporte')}}"><i class="side-menu__icon fa-solid fa-receipt"></i><span class="side-menu__label">Transacciones</span></a>
		</li>
		@endif
		@if(\Auth::User()->hasRole('Usuario'))
		<li>
			<a class="side-menu__item" href="{{url('historial')}}"><i class="side-menu__icon fas fa-receipt"></i><span class="side-menu__label">HISTORIAL</span></a>
		</li>
		@endif
		<li>
			<a class="side-menu__item" href="{{url('ayuda')}}"><i class="side-menu__icon fa-solid fa-circle-question"></i><span class="side-menu__label">AYUDA</span></a>
		</li>
	</ul>
	</br>
	<div class="app-sidebar__user">
		<div class="user-body">
			<i class="far fa-clock fa-2x"></i>
		</div>
		<div class="user-info">

			<span class="text-dark app-sidebar__user-name font-weight-semibold">Nuestro Horario de Atención</span><br>
				<span class="text-muted app-sidebar__user-name text-sm"> Lun a Vie <br>9:00 am a 7:00 pm <br>Sáb de 9:00 am a 2:00 pm				<br><br>

				<span class="text-dark app-sidebar__user-name font-weight-semibold">Síguenos</span><br>



				<a href="mailto:operaciones@fortuneonline.com" target="_blank"><i class="fas fa-envelope-open-text" style="font-size:24px"></i></i></a>
				&nbsp;&nbsp;


				<a href="https://www.facebook.com/#" target="_blank"><i class="fab fa-facebook-f" style="font-size:24px"></i></a>
				&nbsp;&nbsp;
				<a href="https://wa.me/#" target="_blank"><i class="fab fa-whatsapp" style="font-size:24px"></i></a>
				&nbsp;&nbsp;
				<a href="https://www.instagram.com/#" target="_blank"><i class="fab fa-instagram" style="font-size:24px"></i></a>
				</span>
		</div>
	</div>
</aside>
