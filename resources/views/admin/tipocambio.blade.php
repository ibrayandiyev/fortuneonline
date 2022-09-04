{{-- //TODO: vistas copiadas de fortune. --}}
@extends('layouts.app')

@push('titulo_completo')
	Tipo de Cambio
@endpush

@push('titulo')
	Tipo de Cambio
@endpush

@push('css')
<link href="{{url('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{url('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{url('assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
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
	@php 
	$tc=\App\Modelo\Tipocambio::orderBy('tipocambio_id', 'DESC')->get();
	@endphp

	<div class="row">
		<div class="col-sm-3">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Agregar Tipo de Cambio</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<form id="ftc" method="post">
							@csrf
							<table class="table" >
								<tr>
									<th>Compra
									<input id="compra" required class="form-control" type="text" name="compra"></th>
								</tr>
								<tr>
									<th>Venta
									<input id="venta" required class="form-control" type="text" name="venta"></th>
								</tr>
								<tr>								
									<th> 
										<center>
											<button class="btn btn-success" type="submit"><i class="fa fa-save fa-5x"></i></button>
											<a href="#" onclick="ctc()" class="btn btn-danger"><i class="fa fa-sign-out-alt fa-5x"></i></a>
										</center>
									</th>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-9">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Movimientos</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table table-bordered key-buttons text-nowrap" >
							<thead>
								<tr>
									<th>Fecha</th>
									<th>Compra</th>
									<th>Venta</th>
									<th>Usuario</th>								
								</tr>
							</thead>
							<tbody>
								@foreach($tc as $t)
								<tr>
									<td>{{$t->created_at}}</td>
									<td>{{$t->compra}}</td>
									<td>{{$t->venta}}</td>
									<td>{{$t->created_by}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script src="{{url('assets/plugins/input-mask/jquery.mask.min.js')}}"></script>
	<script src="{{url('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
	<script src="{{url('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
	<script src="{{url('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{url('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{url('assets/plugins/datatable/js/jszip.min.js')}}"></script>
	<script src="{{url('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
	<script src="{{url('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
	<script src="{{url('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
	<script src="{{url('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
	<script src="{{url('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
	<script src="{{url('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
	<script src="{{url('assets/plugins/datatable/responsive.bootstrap4.min.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/alertify.min.js"></script>
	<script>
		var tabla;
		$(document).ready(function() {
			tabla = $('#example').DataTable( {
				lengthChange: false,
				buttons: ['excel', 'pdf', 'colvis' ]
			});
			tabla.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
			tabla.column( '0:visible' ).order( 'desc' ).draw();
		});
		$(document).on('submit', '#ftc', function (e) {
			e.preventDefault();
			$.post("stipocambio",$("#ftc").serialize(),function (msg) {
				tabla.row.add([
					msg.created_at,
					msg.compra,
					msg.venta,
					msg.created_by				
				]).draw().nodes().to$().attr('id',msg.tipocambio_id);
				ctc();
				alertify.success("Agregado Correctamente");
			});
			
			$.ajax({
				url: '{{route("updateCuantoestaeldolar")}}',
				type: 'post',
				data: {
					compra: $('#compra').val().replace(/\s/g, ""),
					venta: $('#venta').val().replace(/\s/g, ""),
					_token: '{{csrf_token()}}'
				},
				timeout:3000, //3 second timeout
			}).done(function (response){
				if (response['error']) {
					alertify.error("No se pudo actualizar el tipo de cambio en 'cuentoestaeldolar.pe', servicio no disponible.");
				}
			}).fail(function(jqXHR, textStatus){
				if(textStatus === 'timeout')
				{     
					alertify.error("No se pudo actualizar el tipo de cambio en 'cuentoestaeldolar.pe', servicio no disponible.");
				}
			});
		});
		function ctc() {
			$("#compra").val("");
			$("#venta").val("");
		}
	</script>
@endsection