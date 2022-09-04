@extends('auth.layout')

@section('content')
    <div id="section1" class="section-w3ls">
        <input type="radio" name="sections" id="option1" onclick="location.href='{{route('login')}}'">
        <label for="option1" class="icon-left-w3pvt"><span class="fa fa-user-circle" aria-hidden="true"></span>Ingreso</label>
    </div>

    <div id="section2" class="section-w3ls">
        <input type="radio" name="sections" id="option2" onclick="location.href='{{route('register')}}'">
        <label for="option2" class="icon-left-w3pvt"><span class="fa fa-pencil-square" aria-hidden="true"></span>Registro</label>
    </div>

    <div id="section3" class="section-w3ls">
        <input type="radio" name="sections" id="option3" checked>
        <label for="option3" class="icon-left-w3pvt"><span class="fa fa-lock" aria-hidden="true"></span>¿Perdió su contraseña?</label>
        <article>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <h3 class="legend last">Resetear contraseña</h3>
                <p class="para-style">Ingrese su email y recibirá un link para cambiar su contraseña.</p>
                <p class="para-style-2"><strong>Recuerde</strong> ingresar el correo con el cual creo la cuenta en nuestro sistema.</p>
                <div class="input">
                    <span class="fa fa-envelope-o" aria-hidden="true"></span>
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                    {{-- //TODO: preguntar por los mensajes de error. --}}
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn submit last-btn">Enviar email</button>
            </form>
        </article>
    </div>
@endsection
