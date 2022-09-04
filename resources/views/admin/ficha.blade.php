<div>
	<table class="table">
		<tr>
			<th colspan="2"><img src="{{asset('assets/images/operacionheader.png')}}"></th>
		</tr>
		<tr>
			<th>Fecha de Operación</th>
			<td>{{$op->created_at}}</td>
		</tr>
		<tr>
			<th>Fecha de Actualización</th>
			<td>{{$op->updated_at}} {{$op->last_user}}</td>
		</tr>
		@if($op->usuario->personal == 1)
			<tr>
				<th>Nombres</th>
				<td>{{$op->usuario->primernombre}} {{$op->usuario->segundonombre}}</td>
			</tr>
			<tr>
				<th>Apellidos</th>
				<td>{{$op->usuario->primeroapellido}} {{$op->usuario->segundoapellido}}</td>
			</tr>
			<tr>
				<th>{{$op->usuario->tiposdocumento->nombre}}</th>
				<td>{{$op->usuario->nrodocumento}}</td>
			</tr>
		@elseif($op->usuario->empresa == 1)
			<tr>
				<th>Nombre</th>
				<td>{{$op->usuario->razon_social}}</td>
			</tr>
			<tr>
				<th>RUC</th>
				<td>{{$op->usuario->ruc}}</td>
			</tr>
		@endif
		@if(isset($op->usuario->correo_electronico))
			<tr>
				<th>Correo</th>
				<td>{{$op->usuario->correo_electronico}}</td>
			</tr>
		@else
			<tr>
				<th>Correo</th>
				<td>{{$op->usuario->user->email}}</td>
			</tr>
		@endif
		@isset($op->usuario->telefono)
			<tr>
				<th>Teléfono</th>
				<td>{{$op->usuario->telefono}}</td>
			</tr>
		@endisset
		@if (!isset($op->usuario->telefono))
			@if(isset($op->usuario->user->userid) || isset($op->usuario->user->actkey) || isset($op->usuario->user->user_home_path))
				<tr>
					<th>Teléfono</th>
					<td>
						@if(isset($op->usuario->user->userid))
							{{$op->usuario->user->userid}}
							@if(isset($op->usuario->user->actkey))
							| {{$op->usuario->user->actkey}} 
							@endif
							@if(isset($op->usuario->user->user_home_path))
							| {{$op->usuario->user->user_home_path}} 
							@endif
						@else
							@if(isset($op->usuario->user->actkey))
								{{$op->usuario->user->actkey}} 
							@endif
							@if(isset($op->usuario->user->user_home_path))
							| {{$op->usuario->user->user_home_path}} 
							@endif
						@endif
					</td>
				</tr>
			@endif
		@endif
		<tr>
			<th>Tipo de cambio</th>
			<td>{{$op->taza}}</td>
		</tr>
		<tr>
			<th>Cuenta de Envio</th>
			<td>-
				@if (isset($op->cuentabancariae) && count($op->cuentabancariae) > 0)
					{{$op->cuentabancariae[0]->banco->nombre}}- {{$op->cuentabancariae[0]->nrocuenta}} @if(isset($op->cuentabancariae[0]->nrocuentacci)) | {{$op->cuentabancariae[0]->nrocuentacci}}@endif
				@else
					NO DATA
				@endif
			</td>
		</tr>
		<tr>
			<th>Monto Enviado</th>
			<td><strong>@if($op->monedae->moneda_id == 1) S/ @else $ @endif {{number_format($op->monto, 2, '.', ',')}}</strong> @if($op->monedae->moneda_id == 1) Soles @else Dólares @endif</td>
		</tr>
		@if (isset($op->discount_code) && isset($op->discount_amount))
			<tr>
				<th>Código de descuento</th>
				<td><strong>{{ $op->discount_code }}</strong></td>
			</tr>
			<tr>
				<th>Monto de descuento</th>
				<td><strong>S/{{ $op->discount_amount }} Soles</strong></td>
			</tr>
		@endif
		<tr>
			<th>Cuenta Destino</th>
			<td>-
				@if (isset($op->cuentabancariad) && count($op->cuentabancariad) > 0)
					{{$op->cuentabancariad[0]->banco->nombre}}- {{$op->cuentabancariad[0]->nrocuenta}} @if(isset($op->cuentabancariad[0]->nrocuentacci)) | {{$op->cuentabancariad[0]->nrocuentacci}}@endif
				@else
					NO DATA
				@endif
			</td>
		</tr>
		<tr>
			<th>Monto Esperado</th>
			<td><strong>@if($op->monedad->moneda_id == 1) S/ @else $ @endif {{number_format($op->cambio, 2, '.', ',')}}</strong> @if($op->monedad->moneda_id == 1) Soles @else Dólares @endif</td>
		</tr>
		<tr>
			<th>Cuenta de Depósito</th>
			<td>-
				@if (isset($op->cuentabancariat) && count($op->cuentabancariat) > 0)
					{{$op->cuentabancariat[0]->banco->nombre}}- {{$op->cuentabancariat[0]->nrocuenta}} @if(isset($op->cuentabancariat[0]->nrocuentacci)) | {{$op->cuentabancariat[0]->nrocuentacci}}@endif
				@else
					NO DATA
				@endif
			</td>
		</tr>
		<tr>
			<th>Origen de Fondos</th>
			<td>
				@if (!is_null($op->origen_fondo))
					@if ($op->origen_fondo->code == 'otros')
						{{ $op->origen_fondo_otro }}
					@else
						{{ $op->origen_fondo->name }}
					@endif
				@endif
			</td>
		</tr>
		@if($op->voucher)
			<tr>
				<th colspan="2">
					<img src="{{asset('assets/voucher/'.$op->voucher)}}" alt="">
				</th>
			</tr>
		@endif
		@if($op->voucher2)
			<tr>
				<th colspan="2">
					<img src="{{asset('assets/voucher/'.$op->voucher2)}}" alt="">
				</th>
			</tr>
		@endif
		@if($op->voucher3)
			<tr>
				<th colspan="2">
					<img src="{{asset('assets/voucher/'.$op->voucher3)}}" alt="">
				</th>
			</tr>
		@endif
		@if($op->voucher4)
			<tr>
				<th colspan="2">
					<img src="{{asset('assets/voucher/'.$op->voucher4)}}" alt="">
				</th>
			</tr>
		@endif
		<tr>
			<th colspan="2"><img src="{{asset('assets/images/operacion-pie.png')}}"></th>
		</tr>
	</table>
</div>