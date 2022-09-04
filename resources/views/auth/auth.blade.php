<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registro sistema Fortune Online</title>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
	<style>
		.field-icon {
			float: right;
			margin-left: -50px;
			margin-right: 10px;
			margin-top: -35px;
			position: relative;
			z-index: 2;
		}
	</style>
</head>

<body>
    <div class="login-wrap">
        <div class="login-html">
            <div class="logo">
                <img src="{{asset('assets/images/auth/logo-white_b.png')}}">
            </div>

            <input type="radio" name="tab" class="sign-in" id="radio-sign_in">
			<label for="radio-sign_in" class="tab">Ingresar</label>

            <input type="radio" name="tab" class="sign-up" id="radio-sign_up">
			<label for="radio-sign_up" class="tab">Registrarme</label>

            <div class="login-form">
                <div class="sign-in-htm">
					<form method="POST" action="{{ route('login') }}" id="form-sign_in">
						@csrf
						<div class="group">
							<label for="email_sign_in" class="label">Correo electrónico</label>
							<input type="text" class="input @error('email') is-invalid @enderror" id="email_sign_in" placeholder="Ingrese su Correo">
						</div>
						<div class="group">
							<p>
								<label for="password_sign_in" class="label">Contraseña</label>
								<input type="password" class="input @error('password') is-invalid @enderror" id="password_sign_in" placeholder="Contraseña">
								<i class="bi bi-eye-slash field-icon" style="margin-left: -30px; cursor: pointer;" id="password_visibility"></i>
							</p>
						</div>
						@if (old('username') == "")
							@error('email')
								<p style="color:red;" role="alert">{{ $message }}</p>
							@enderror
							@error('password')
								<p style="color:red;" role="alert">{{ $message }}</p>
							@enderror
						@endif
						<div class="group">
							<button type="submit" class="button" id="btn-sign_in" style="cursor: pointer;">
								INGRESAR
							</button>
						</div>
					</form>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="{{ route('password.reset')}}">Olvidé mi contraseña</a>
                    </div>
                </div>
                <div class="sign-up-htm">
					<form method="POST" action="{{ route('register') }}" id="form-sign_up">
						@csrf
						<div class="group">
							<label for="username_sign_up" class="label">Usuario</label>
							<input type="text" class="input" id="username_sign_up" placeholder="Usuario">
						</div>
						<div class="group">
							<p>
								<label for="password_sign_up" class="label">Contraseña</label>
								<input type="password" class="input" id="password_sign_up" placeholder="Contraseña">
								<i class="bi bi-eye-slash field-icon" style="margin-left: -30px; cursor: pointer;" id="password_visibility_register"></i>
							</p>
						</div>
						<div class="group">
							<label for="email_sign_up" class="label">Correo electrónico</label>
							<input type="text" class="input" id="email_sign_up" placeholder="Ingrese su Correo">
						</div>
						<input type="hidden" name="password_confirmation" id="password_confirmation_sign_up">
						@if (old('username') != "")
							@error('username')
								<p style="color:red;" role="alert">{{ $message }}</p>
							@enderror
							@error('password')
								<p style="color:red;" role="alert">{{ $message }}</p>
							@enderror
							@error('email')
								<p style="color:red;" role="alert">{{ $message }}</p>
							@enderror
						@endif
						<div class="group">
							<button type="submit" class="button" id="btn-sign_up" style="cursor: pointer;">
								REGISTRARME
							</button>
						</div>
					</form>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <label for="tab-1">¿Ya estas registrado? ingresa aquí</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/alertify.min.js"></script>

<script>
	$("#btn-sign_in").on('click', function(){
		$('#form-sign_in').submit();
	});

	$("#btn-sign_up").on('click', function(){
		$('#password_confirmation_sign_up').val($('#password_sign_up').val());
		$('#form-sign_up').submit();
	});

	// JS SETTINGS DEPENDS ON LOGIN/REGISTER
	$( document ).ready(function() {
		let lastPageUsername = "{{old('username')}}";

		if (lastPageUsername == "") {
			$('#radio-sign_in').attr('checked', 'checked');
			$("#email_sign_in").val("{{ old('email') }}");
			activeSignInFields();
		}
		else {
			$('#radio-sign_up').attr('checked', 'checked');
			$("#username_sign_up").val("{{ old('username') }}");
			$("#email_sign_up").val("{{ old('email') }}");
			activeSignUpFields();
		}
	});

		$("#radio-sign_in").on('click', function(){
			activeSignInFields();
			disableSignUpFields();
		});

		$("#radio-sign_up").on('click', function(){
			activeSignUpFields();
			disableSignInFields();
		});

	function activeSignInFields(){
		$("#email_sign_in").attr("required", true);
		$("#password_sign_in").attr("required", true);
		$("#email_sign_in").attr("name", "email");
		$("#password_sign_in").attr("name", "password");
	}
	function disableSignInFields(){
		$('#email_sign_in').removeAttr("required");
		$('#password_sign_in').removeAttr("required");
		$("#email_sign_in").removeAttr("name");
		$("#password_sign_in").removeAttr("name");
	}

	function activeSignUpFields(){
		$("#email_sign_up").attr("required", true);
		$("#username_sign_up").attr("required", true);
		$("#password_sign_up").attr("required", true);
		$("#email_sign_up").attr("name", "email");
		$("#username_sign_up").attr("name", "username");
		$("#password_sign_up").attr("name", "password");
	}

	function disableSignUpFields(){
		$('#email_sign_up').removeAttr("required");
		$('#username_sign_up').removeAttr("required");
		$('#password_sign_up').removeAttr("required");
		$("#email_sign_up").removeAttr("name");
		$("#username_sign_up").removeAttr("name");
		$("#password_sign_up").removeAttr("name");
	}

	$("#password_visibility").on('click', function(){
		if ($('#password_sign_in').attr('type') == "password") {
			$('#password_sign_in').attr('type', 'text');
			$(this).removeClass("bi-eye-slash").addClass("bi-eye");
		} else {
			$('#password_sign_in').attr('type', 'password');
			$(this).removeClass("bi-eye").addClass("bi-eye-slash");

		}
	});

	$("#password_visibility_register").on('click', function(){
		if ($('#password_sign_up').attr('type') == "password") {
			$('#password_sign_up').attr('type', 'text');
			$(this).removeClass("bi-eye-slash").addClass("bi-eye");
		} else {
			$('#password_sign_up').attr('type', 'password');
			$(this).removeClass("bi-eye").addClass("bi-eye-slash");
		}
	});
</script>
</html>
