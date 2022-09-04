@extends('auth.layout')

@section('content')
    <div id="section1" class="section-w3ls">
        <input type="radio" name="sections" id="option1" onclick="location.href='{{route('login')}}'">
        <label for="option1" class="icon-left-w3pvt"><span class="fa fa-user-circle" aria-hidden="true"></span>Ingreso</label>
    </div>

    <div id="section2" class="section-w3ls">
        <input type="radio" name="sections" id="option2" checked>
        <label for="option2" class="icon-left-w3pvt"><span class="fa fa-pencil-square" aria-hidden="true"></span>Registro</label>
        <article>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h3 class="legend">Registro</h3>
                <div class="input">
                    <span class="fa fa-envelope-o" aria-hidden="true"></span>
                    <input id="email_registro" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Email" autofocus>
                    {{-- //TODO: preguntar por los mensajes de error. --}}
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input">
                    <span class="fa fa-key" aria-hidden="true"></span>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña">
                    {{-- //TODO: preguntar por los mensajes de error. --}}
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input">
                    <span class="fa fa-key" aria-hidden="true"></span>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Contraseña">
                </div>
                <button type="submit" class="btn submit">Registrar</button>
            </form>
        </article>
    </div>

    <div id="section3" class="section-w3ls">
        <input type="radio" name="sections" id="option3" onclick="location.href='{{route('password.request')}}'">
        <label for="option3" class="icon-left-w3pvt"><span class="fa fa-lock" aria-hidden="true"></span>¿Perdió su contraseña?</label>
    </div>
@endsection
