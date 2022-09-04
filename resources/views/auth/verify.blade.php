@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
  	<h4 class="txtazul"> Verificación de&nbsp; </h4> <h4 class="txtnaranja"> Correo Electrónico</h4>
                </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">


                            {{ __('Hemos actualizado el correo de verificación.') }}
                        </div>
                    @endif

                    {{ __('Estamos procesando su pedido, por favor revise en su correo electrónico el enlace de verificación.') }}<br>
                    {{ __('Si aun no recibió el correo de verificación') }},<br>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click aquí para volver a enviar') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
