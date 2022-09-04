<!DOCTYPE html>
<html lang="en">
<head>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.3.2/css/simple-line-icons.css">

    <style>
        body {
            background-color: #f6f9f8;
            font-family: 'Roboto', sans-serif;
        }

        a {
            color: #0e7aea;
            text-decoration: none;
        }

        h6 {
            color: #9aa3ab;
            font-weight: 300;
            line-height: 15px;
        }

        h5 {
            color: #99a1aa;
            font-weight: 300;
        }

        h4 {
            font-weight: 300;
            font-size: 13px;
            color: #97a2ad
        }

        h3 {
            color: #58636a;
            font-weight: 500;
        }

        .container {
            width: 50%;
            height: 40%;
            min-width: 636px;
            min-height: 456px;
            margin: auto;
            margin-top: 10%;
            overflow: hidden;
            border-radius: 5px 5px 5px 5px;
            -webkit-box-shadow: 0px 5px 21px 0px rgba(128,128,128,0.2);
            -moz-box-shadow: 0px 5px 21px 0px rgba(128,128,128,0.2);
            box-shadow: 0px 5px 21px 0px rgba(128,128,128,0.2);
        }

        .left {
            background-color: #1882ef;
            width: 39%;
            height: 457px;
            border-radius: 5px 0 0 5px;
            float: left;
            color: #ffffff;
        }

        .info-box {
            margin-top: 35px;
            margin-left: 35px;
            margin-right: 35px;
        }

        .receipt {
            font-weight: 300;
            font-size: 15px;
            line-height: 26px;
            padding-top: 10px;
        padding-bottom: 15px;
            border-bottom: 1px solid #3895f4;
            height: 15%;
        }

        .receipt > span {
            font-weight: 500;
            font-size: 21px;
        }

        .entry {
            border-bottom: 1px solid #3895f4;
            height: 15%;
            overflow: hidden;
            padding-top: 15px;
        }

        .entry > p {
            font-weight: 300;
            font-size: 13px;
            line-height: 26px;
            margin-top: 0px !important;
            float: left;
        }

        .entry > i {
            margin-top: 4px;
            margin-right: 13px;
            float: left;
            color: #b4d8fc;
        }

        span {
            font-weight: 500;
            font-size: 16px;
        }

        .entry:last-child {
            border-bottom: none;
        }

        .right {
            background-color: #fefefe;
            width: 61%;
            height: 100%;
            float: left;
            border-radius: 0 5px 5px 0;
        }

        .content {
            margin-top: 50px;
            margin-left: 40px;
            margin-right: 40px;
        }

        .header {
            overflow: hidden;
            border-bottom: 1px solid #d7e2e7;
            height: 50px;
        }

        .header > img {
            width: 100px;
            float: left;
        }

        .header > h4 {
            text-align: right;
            margin-top: 10px;
        }

        .main {
            margin-top: 35px;
        }

        .message {
            margin-top: 40px;
        }

        .message > p {
            font-weight: 300;
            font-size: 15px;
            color: #7a838d;
            line-height: 30px;
        }

        .message > h6 {
            margin-top: 10px;
        }

        .body {
            overflow: hidden;
            border-bottom: 1px solid #d7e2e7;
        }

        .footer {
            overflow: hidden;
            border-top: 1px solid #d7e2e7;
            margin-top: 40px;
            padding-top: 30px;
        }

        .footer > a {
            font-size: 13px;
            font-weight: 500;
            float: left;
        }

        .footer > h6 {
            color: #7a838d;
            text-align: right;
            margin-top: 0px !important;
        }
    </style>
</head>
<body>
    <div class="container">
		<div class="left">
			<div class="info-box">
				<div class="receipt">
                    <img alt="logo" class="header-brand-img main-logo" src="{{asset('assets/images/brand/logofortuneonline.png')}}" style="width: 150px;">
                    <br>

					Recibo de
                    <br>
                    <span>
                        @if($operacion->usuario->personal == 1)
                                {{ $operacion->usuario->primernombre }} {{ $operacion->usuario->segundonombre }} {{ $operacion->usuario->primeroapellido }} {{ $operacion->usuario->segundoapellido }}
                        @elseif($operacion->usuario->empresa == 1)
                            {{ $operacion->usuario->razon_social }} - {{ $operacion->usuario->ruc }}
                        @endif
                    </span>
				</div>
				<div class="entry">
					<i class="icon-wallet" aria-hidden="true"></i>
					<p>Monto enviado:
                        <br>
                        <span>
                            <strong>
                                @if($operacion->monedae->moneda_id == 1) 
                                    S/ 
                                @else 
                                    $ 
                                @endif 
                                {{number_format($operacion->monto, 2, '.', ',')}}
                            </strong>
                            @if($operacion->monedae->moneda_id == 1) 
                                Soles 
                            @else 
                                Dólares
                            @endif
                        </span>
                    </p>
				</div>
                <div class="entry">
					<i class="icon-wallet" aria-hidden="true"></i>
					<p>Monto Esperado:
                        <br>
                        <span>
                            <strong>
                                @if($operacion->monedad->moneda_id == 1)
                                    S/
                                @else
                                    $
                                @endif
                                {{number_format($operacion->cambio, 2, '.', ',')}}
                            </strong>
                            @if($operacion->monedad->moneda_id == 1)
                                Soles
                            @else
                                Dólares
                            @endif
                        </span>
                    </p>
				</div>
				<div class="entry">
					<i class="icon-calendar" aria-hidden="true"></i>
					<p>Fecha:
                        <br>
                        <span>
                            {{ $operacion->updated_at }}
                        </span>
                    </p>
				</div>
			</div>
		</div>
		<div class="right">
			<div class="content">
				<div class="message">
					<p>
                        <strong>¡FELICITACIONES!</strong> 
                        <BR>
                        {{$mensaje}}
                    </p>

                    <p>
                        @if(isset($email_cliente))
                            <strong>Email:</strong> {{ $email_cliente }}
                            <br>
                        @endif
                        @isset($operacion->cuentabancariae[0])
                            <strong>Cuenta de Envío:</strong> {{$operacion->cuentabancariae[0]->nrocuenta}} @if(isset($operacion->cuentabancariae[0]->nrocuentacci)) | {{$operacion->cuentabancariae[0]->nrocuentacci}} @endif
                            <br>
                            <strong>Banco de Envío:</strong> {{$operacion->cuentabancariae[0]->banco->nombre}}
                            <br>
                        @endisset
                        @if (isset($operacion->discount_code) && isset($operacion->discount_amount))
                            <strong>Código de descuento:</strong> {{ $operacion->discount_code }}
                            <br>
                            <strong>Monto de descuento:</strong> {{ $operacion->discount_amount }}
                            <br>
                        @endif
                        @isset($operacion->cuentabancariad[0])
                            <strong>Cuenta Destino:</strong> {{$operacion->cuentabancariad[0]->nrocuenta}} @if(isset($operacion->cuentabancariad[0]->nrocuentacci)) | {{$operacion->cuentabancariad[0]->nrocuentacci}} @endif
                            <br>
                            <strong>Banco Destino:</strong> {{ $operacion->cuentabancariad[0]->banco->nombre }}
                            <br>
                            <strong>Tipo de Cuenta | Moneda:</strong> {{$operacion->cuentabancariad[0]->tipo->nombre}} | {{$operacion->cuentabancariad[0]->moneda->nombre}}
                            <br>
                        @endisset
                        <strong>Tipo de Cambio:</strong> {{$operacion->taza}}
                        <br>
                        @isset($operacion->cuentabancariat[0])
                            <strong>Cuenta de Depósito:</strong> {{ $operacion->cuentabancariat[0]->nrocuenta }} @if(isset($operacion->cuentabancariat[0]->nrocuentacci)) | {{ $operacion->cuentabancariat[0]->nrocuentacci }} @endif
                            <br>
                            <strong>Banco de Depósito:</strong> {{ $operacion->cuentabancariat[0]->banco->nombre }}
                            <br>
                            <strong>Tipo de Cuenta | Moneda:</strong> {{ $operacion->cuentabancariat[0]->tipo->nombre }} | {{ $operacion->cuentabancariat[0]->moneda->nombre }}
                            <br>
                        @endisset

                        @if (!is_null($operacion->origen_fondo))
                            <strong>Origen de Fondos:</strong> @if ($operacion->origen_fondo->code == 'otros') {{ $operacion->origen_fondo_otro }} @else {{ $operacion->origen_fondo->name }} @endif
                            <br>
                        @endif
                    <p>
				</div>

				<div class="footer">
					<a></a>
					<h6><strong>Transacción número:</strong> {{ $operacion->operacion_id }}</h6>
				</div>
			</div>
		</div>
	</div>
</body>
</html>