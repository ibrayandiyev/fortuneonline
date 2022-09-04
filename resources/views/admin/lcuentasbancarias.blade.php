@extends('layouts.app')
@push('titulo')
Lista de Cuentas Bancarias
@endpush
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/css/alertify.min.css">
<style>
	.ajs-ok{
		border: none;
		background-color: green;
		color: white;
		border-radius: 5px;
	}
	.ajs-cancel{
		border: none;
		background-color: red;
		color: white;
		border-radius: 5px;
	}
</style>
@endpush
@section('content')
<div class="card-body">
	<div class="btn-list">
		<a href="{{url('cuentasbancarias')}}" class="btn btn-outline-success">Agregar nueva cuenta bancaria</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-lg-12">
		<table class="table table-hover table-bordered">
			<thead class="bg-primary">
				<tr>
					<th>Alias</th>
					<th>Banco</th>
					<th>Moneda</th>
					<th>Tipo</th>
					<th>Número de Cuenta</th>
					<th></th>
				</tr>
			</thead>
			@foreach($ls as $l)
				<tr id="{{$l->cuentabancaria_id}}">
					<th>{{$l->alias}}</th>
					<th>{{$l->banco->nombre}}</th>
					<th>{{$l->moneda->nombre}}</th>
					<th>{{$l->tipo->nombre}}</th>
					<th>{{$l->nrocuenta}}</th>
					<th>
						<div class="btn-group" role="group" aria-label="Basic example">
						  <a href="{{url('fcuentasbancaria/'.$l->cuentabancaria_id)}}"  class="btn btn-primary"><i class="fas fa-edit"></i></a>
						  <button type="button" onclick="remove({{$l->cuentabancaria_id}})" class="btn btn-danger"><i class="fas fa-trash"></i></button>
						</div>
					</th>
				</tr>
			@endforeach
		</table>
	</div>
</div>
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/alertify.min.js"></script>
<script>
	function remove(i) {
		alertify.confirm("Eliminar Cuenta","¿Esta seguro con eliminar su cuenta?",
			function(){
				$.get("dcuentasbancaria/"+i,function(msg){
					$("tr[id="+i+"]").remove();
					alertify.success(msg);
				});
			},
			function(){
				alertify.error("Cancelado la Eliminacion");
			});
	}
</script>
@endpush
