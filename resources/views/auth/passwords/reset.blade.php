<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-TileColor" content="#0061da">
        <meta name="theme-color" content="#1643a3">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <link rel="icon" href="{{url('assets/images/brand/favicon.ico')}}" type="image/x-icon"/>
        <link rel="shortcut icon" type="image/x-icon" href="{{url('assets/images/brand/favicon.ico')}}" />
        <title>Fortune Online - Casa de cambio digital</title>
        <link rel="stylesheet" href="{{url('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
        <link href="{{url('assets/plugins/fontawesome-free/css/all.css')}}" rel="stylesheet">
        <link href="{{url('assets/plugins/scroll-bar/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />
        <link href="{{url('assets/css/dashboard.css')}}" rel="stylesheet" />
        <link href="{{url('assets/plugins/iconfonts/plugin.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
        <style>
            .field-icon {
                float: right;
                margin-left: -50px;
                margin-right: 10px;
                margin-top: -31px;
                position: relative;
                z-index: 2;
            }
        </style>
    </head>
    <body class="login-img custom-bg">
        <div id="global-loader"><img src="{{url('assets/images/loader.svg')}}" alt="loader"></div>
        <div class="page">
            <div class="custompage">
                <div class="custom-content  mt-0">
                    <div class="row">
                        <div class="col d-block mx-auto">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="{{url('assets/images/brand/logo.png')}}" class="header-brand-img mb-2 mt-2 mt-lg-0 " alt="logo">
                                    <h3 class="text-center">Reestablecer Contraseña</h3>
                                    <p>Introduzca su contraseña y confirmela</p>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <p>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <i class="bi bi-eye-slash field-icon" style="margin-left: -30px; cursor: pointer;" id="password_visibility"></i>
                                </p>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>

                            <div class="col-md-6">
                                <p>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    <i class="bi bi-eye-slash field-icon" style="margin-left: -30px; cursor: pointer;" id="confirm_password_visibility"></i>
                                </p>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Resetear contraseña') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{url('assets/js/vendors/jquery-3.2.1.min.js')}}"></script>
        <script src="{{url('assets/js/vendors/jquery.sparkline.min.js')}}"></script>
        <script src="{{url('assets/js/vendors/selectize.min.js')}}"></script>
        <script src="{{url('assets/js/vendors/jquery.tablesorter.min.js')}}"></script>
        <script src="{{url('assets/js/vendors/circle-progress.min.js')}}"></script>
        <script src="{{url('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
        <script src="{{url('assets/plugins/bootstrap/popper.min.js')}}"></script>
        <script src="{{url('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{url('assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
        <script src="{{url('assets/plugins/peitychart/jquery.peity.min.js')}}"></script>
        <script src="{{url('assets/plugins/counters/counterup.min.js')}}"></script>
        <script src="{{url('assets/plugins/counters/waypoints.min.js')}}"></script>
        <script src="{{url('assets/js/custom.js')}}"></script>

        <script>
            $("#password_visibility").on('click', function(){
            if ($('#password').attr('type') == "password") {
                $('#password').attr('type', 'text');
                $(this).removeClass("bi-eye-slash").addClass("bi-eye");
            } else {
                $('#password').attr('type', 'password');
                $(this).removeClass("bi-eye").addClass("bi-eye-slash");

            }
        });

        $("#confirm_password_visibility").on('click', function(){
            if ($('#password-confirm').attr('type') == "password") {
                $('#password-confirm').attr('type', 'text');
                $(this).removeClass("bi-eye-slash").addClass("bi-eye");
            } else {
                $('#password-confirm').attr('type', 'password');
                $(this).removeClass("bi-eye").addClass("bi-eye-slash");
            }
        });
        </script>
    </body>
</html>
