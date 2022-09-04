<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<title>Document</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		.sep,.sep>th,.sep>td{
			border-top: 1px solid gray;
		}
		.th{
			text-align: right;

		}




	</style>
</head>
<body>

<div class="container-fluid">
	<center>
		<table class="voucher">
			<tr>
				<th colspan="2">
	<img src="{{asset('assets/images/header-mail.jpg')}}" alt="img" class="sticky-logo" data-retina="{{asset('assets/images/header-mail.jpg')}}" alt="FortuneOnline" width="730" height="136">
</td>
			</tr>
			<tr>
			<th colspan="2">
			<span class="text-dark app-sidebar__user-name font-weight-semibold">Se realizó la transferencia</span>
			</th>
			</tr>
			<tr>
				<th align="right">FECHA DE OPERACIÓN</th>
				<td>{{$operacion->created_at}}</td>
			</tr>
			<tr>
				<th align="right">Fecha de Actualización</th>
				<td>{{$operacion->updated_at}} {{$operacion->last_user}}</td>
			</tr>
			<tr>
				<th align="right">Nombres</th>
				<td>{{$operacion->usuario->primernombre}} {{$operacion->usuario->segundonombre}}</td>
			</tr>
			<tr>
				<th align="right">Apellidos</th>
				<td>{{$operacion->usuario->primeroapellido}} {{$operacion->usuario->segundoapellido}}</td>
			</tr>
			<tr class="sep">
				<th align="right">Cuenta de Envío</th>
				<td>{{$operacion->cuentabancariae[0]->nrocuenta}}</td>
			</tr>
			<tr>
				<th align="right">Banco de Envío</th>
				<td>{{$operacion->cuentabancariae[0]->banco->nombre}}</td>
			</tr>
			<tr>
				<th align="right">Monto Enviado</th>
				<td><strong>{{number_format($operacion->monto, 2, '.', ',')}}</strong> {{$operacion->monedae->nombre}}</td>
			</tr>
			<tr class="sep">
				<th align="right">Cuenta Destino</th>
				<td>{{$operacion->cuentabancariad[0]->nrocuenta}}</td>
			</tr>
			<tr>
				<th align="right">Banco Destino</th>
				<td><strong>{{$operacion->cuentabancariad[0]->banco->nombre}}</strong></td>
			</tr>
			<tr>
				<th align="right">Tipo de Cuenta | Moneda</th>
				<td><strong>{{$operacion->cuentabancariad[0]->tipo->nombre}} | {{$operacion->cuentabancariad[0]->moneda->nombre}}</strong></td>
			</tr>
			<tr>
				<th align="right">Monto Esperado</th>
				<td><strong>{{number_format($operacion->cambio, 2, '.', ',')}}</strong> {{$operacion->monedad->nombre}}</td>
			</tr>
			<tr class="sep">
				<th align="right">Tipo de Cambio</th>
				<td><strong>{{$operacion->taza}}</strong></td>
			</tr>
			<tr>
				<th align="right">Cuenta de Depósito</th>
				<td>{{$operacion->cuentabancariat[0]->nrocuenta}}</td>
			</tr>
			<tr>
				<th align="right">Banco Depositado</th>
				<td><strong>{{$operacion->cuentabancariat[0]->banco->nombre}}</strong></td>
			</tr>
			<tr>
				<th align="right">Tipo de Cuenta | Moneda</th>
				<td><strong>{{$operacion->cuentabancariat[0]->tipo->nombre}} | {{$operacion->cuentabancariat[0]->moneda->nombre}}</strong></td>
			</tr>

			<tr>
				<th colspan="2"><img src="https://www.fortuneonline.com.pe/footer-mail.jpg" class="sticky-logo" data-retina="https://www.fortuneonline.com.pe/footer-mail.jpg" alt="Fortune Online" width="730" height="136"></td>
			</tr>

			<tr>
				<th colspan="2">
					<img src="http://sistema.fortuneonline.com.pe/fortunec/public/assets/voucher/{{$operacion->voucher}}" alt="" width='500'>
				</th>
			</tr>
		</table>
	</center>
</div>


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
