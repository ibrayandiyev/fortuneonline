<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reset password sistema Fortune Online</title>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
</head>

<body>
    <div class="login-wrap">
        <div class="login-html">
            <div class="logo">
                <img src="{{asset('assets/images/auth/logo-white_b.png')}}">
            </div>

            <input type="radio" name="tab" class="sign-in" id="radio-sign_in" checked>
			<label for="radio-sign_in" class="tab">Resetear contraseña</label>

            <div class="login-form">
                <div class="sign-in-htm" style="transform: rotateY(0);">
                    <div class="group">
                        <label for="email_sign_in" class="label" style="margin-bottom: 10px;">Correo electrónico</label>
                        <input type="text" class="input" name="email" id="email" placeholder="Ingrese su Correo" required>
                    </div>
                    <div class="group">
                        <button type="button" class="button" id="btn-reset" style="cursor: pointer;">
                            Enviar email
                        </button>
                    </div>
                    <div class="group" id="span-restablecer-mensaje" style="color:green; display: none;">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="{{ route('login') }}" class="link">Volver</a>
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
$("#btn-reset").on('click', function(){
    if (!email || email == "") {
        alert('Debe ingresar el email.');
    }

    let token = "{{csrf_token()}}";
    let url = "{{ route('custom-reset-password') }}";
    $.ajax({
        type:"POST",
        url: url,
        data:{
            _token: token,
            email: $("#email").val()
        },
        beforeSend: function(data){
            $("#span-restablecer-mensaje").css('color', '');
            $("#span-restablecer-mensaje").text('');
            $("#span-restablecer-mensaje").css('display', '');
            $("#btn-reset").prop('disabled', true);
        },
        success: function(data){
            if (data['success']) {
                $("#span-restablecer-mensaje").css('color', 'green');
                $("#span-restablecer-mensaje").text('Hemos enviado un link de recuperación a su email');
                $("#span-restablecer-mensaje").css('display', '');
            }
            else {
                $("#span-restablecer-mensaje").css('color', 'red');
                $("#span-restablecer-mensaje").text('No pudimos enviar el link de recuperación a el mail ingresado ya que no existe');
                $("#span-restablecer-mensaje").css('display', '');
            }
            $("#btn-reset").prop('disabled', false);
        },
        error: function(data){
            $("#span-restablecer-mensaje").css('color', 'red');
            $("#span-restablecer-mensaje").text(data.responseJSON.errors.email[0]);
            $("#span-restablecer-mensaje").css('display', '');
            $("#btn-reset").prop('disabled', false);
        },
    });
})
</script>
</html>
