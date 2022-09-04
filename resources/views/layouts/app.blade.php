<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
	
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="msapplication-TileColor" content="#0061da">
		<meta name="theme-color" content="#1643a3">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<link rel="icon" href="{{asset('assets/images/brand/favicon.ico')}}" type="image/x-icon">
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/brand/favicon.ico')}}">

		<!-- Title -->
		<title>Fortune Online - Casa de cambio Digital</title>
		<!--Bootstrap.min css-->
		<link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}"  rel="stylesheet">

        <!--Font Awesome-->
		<link href="{{asset('assets/plugins/fontawesome-free/css/all.css')}}" rel="stylesheet">

		<!-- Dashboard Css -->
		<link href="{{asset('assets/css/dashboard.css')}}" rel="stylesheet">

		<!-- Custom scroll bar css-->
		<link href="{{asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.css')}}" rel="stylesheet">

		<!-- Sidemenu Css -->
		<link href="{{url('assets/plugins/toggle-sidebar/css/sidemenu-closed-light.css')}}" rel="stylesheet">

		<!---Font icons-->
		<link href="{{asset('assets/plugins/iconfonts/plugin.css')}}" rel="stylesheet">

		<!-- Sidebar css -->
        <link href="{{asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">

        @stack('css')
    </head>

	<body class="app sidebar-mini rtl">
		<!-- Global Loader-->
        <div id="global-loader"><img src="{{asset('assets/images/loader.svg')}}" alt="loader"></div>

		<div class="page">
			<div class="page-main">

                @include('layouts.header')
                @include('layouts.sidebar')

                <div class=" app-content my-3 my-md-5">
					<div class="side-app" id="side-app">
						<!--Page Header-->
						<div class="mb-5">
							<div class="page-header  mb-0">
								<h4 class="page-title">
                                    @if(is_null(\Auth::User()->usuario_id))
                                        <a href="{{route('personal_o_empresa')}}" class="btn btn-outline-danger">Aún no ha terminado su perfil</a>
                                    @endif
                                    @stack('titulo_completo')
                                </h4>

								<div class="card-body">
                                    <ol class="breadcrumb1">
                                        <li class="breadcrumb-item">Inicio</li>
                                        <li class="breadcrumb-item active" aria-current="page">@stack('titulo')</li>
                                    </ol>
                                </div>
							</div>
                        </div>
						


						
						
						

                        @yield('content')

                    </div>

                    {{-- @include('layouts.notificacion') --}}
                    @include('layouts.footer')

                </div>
            </div>
        </div>

        <!-- Back to top -->
        <a href="#top" id="back-to-top"><i class="fas fa-angle-up "></i></a>

        <!-- Dashboard Js -->
        <script src="{{asset('assets/js/vendors/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('assets/js/vendors/jquery.sparkline.min.js')}}"></script>
        <script src="{{asset('assets/js/vendors/selectize.min.js')}}"></script>
        <script src="{{asset('assets/js/vendors/jquery.tablesorter.min.js')}}"></script>
        <script src="{{asset('assets/js/vendors/circle-progress.min.js')}}"></script>
        <script src="{{asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>

        <!--Bootstrap.min js-->
        <script src="{{asset('assets/plugins/bootstrap/popper.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

        <!-- Side menu js -->
        <script src="{{asset('assets/plugins/toggle-sidebar/js/sidemenu.js')}}"></script>

        <!-- Custom scroll bar Js-->
        <script src="{{asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js')}}"></script>

        <!-- peitychart -->
        <script src="{{asset('assets/plugins/peitychart/jquery.peity.min.js')}}"></script>

        <!-- Input Mask Plugin -->
        <script src="{{asset('assets/plugins/input-mask/jquery.mask.min.js')}}"></script>
		
		<!--popup -->
		
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.7/js/mdb.min.js"></script>
        <script>
            debugger;
        
            $(document).ready(function() {
            setTimeout(function() {
              $('#modalLoginForm').modal('show');
            }, 3000); // milliseconds
        });
        </script>


<!--popup  fin -->
        <!--Counters -->
        <script src="{{asset('assets/plugins/counters/counterup.min.js')}}"></script>
        <script src="{{asset('assets/plugins/counters/waypoints.min.js')}}"></script>

        <!-- Sidebar js -->
        <script src="{{asset('assets/plugins/sidebar/sidebar.js')}}"></script>

        <!-- Custom js -->
        <script src="{{asset('assets/js/custom.js')}}"></script>

        @yield('scripts')

    </body>
</html>
