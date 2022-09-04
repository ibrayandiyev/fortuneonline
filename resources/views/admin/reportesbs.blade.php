@extends('layouts.app')
@push('css')
	<link href="{{url('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
	<link href="{{url('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
	<link href="{{url('assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
	<style>
		.table-responsive{
			height: ;
		}
	</style>
@endpush

@push('titulo_completo')
	Reporte SBS
@endpush

@push('titulo')
	Reportes: SBS 
@endpush

@section('content')
	@php 
		use Illuminate\Support\Facades\Cache;

		function departamento($id){
			if (Cache::has('departmento_' . $id)) {
				return Cache::get('departmento_' . $id);
			}
			else {
				$dp=\App\Modelo\Ubigeo::where("dDepartamento",$id)->where("codProvincia",0)->where("codDistrito",0)->first();

				Cache::put('departmento_' . $id, $dp->Descripcion, now()->addDay());

				return $dp->Descripcion;
			}
		}
		function provincia($dp,$pr){
			if (Cache::has('provincia_' . $dp . '_' . $pr)) {
				return Cache::get('provincia_' . $dp . '_' . $pr);
			}
			else {
				$pro=\App\Modelo\Ubigeo::where("dDepartamento",$dp)->where("codProvincia",$pr)->where("codDistrito",0)->first();
				Cache::put('provincia_' . $dp . '_' . $pr, $pro->Descripcion, now()->addDay());

				return $pro->Descripcion;
			}
		}
		function distrito($dp,$pr,$ds){
			if (Cache::has('distrito_' . $dp . '_' . $pr . '_' . $ds)) {
				return Cache::get('distrito_' . $dp . '_' . $pr . '_' . $ds);
			}
			else {
				$dis=\App\Modelo\Ubigeo::where("dDepartamento",$dp)->where("codProvincia",$pr)->where("codDistrito",$ds)->first();
				Cache::put('distrito_' . $dp . '_' . $pr . '_' . $ds, $dis->Descripcion, now()->addDay());

				return $dis->Descripcion;
			}
		}
	@endphp

	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">TODAS LAS TRANSACCIONES</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table table-bordered key-buttons text-nowrap" >
							<thead>
								<tr>
									<th>Fecha Solicitud</th>
									<th>Fecha Operación</th>
									<th>Departamento</th>
									<th>Provincia</th>
									<th>Distrito</th>
									<th>Tipo Doc</th>
									<th>N° Doc</th>
									<th>Ap. Paterno</th>
									<th>Ap. Materno</th>
									<th>Nombres</th>
									<th>Pais</th>
									<th>Ocupación</th>

									<th>Dirección</th>
									<th>Teléfono</th>
									<th>Correo electrónico</th>

									<th>N° RUC</th>
									<th>Razón social</th>
									<th>Giro de negocio</th>
									<th>Ap. Paterno de contacto.</th>
									<th>Ap. Materno de contacto.</th>
									<th>Nombres de contacto.</th>

									<th>Tipo Doc de contacto.</th>
									<th>N° Doc de contacto.</th>
									<th>Teléfono de contacto.</th>
									<th>Ocupación de contacto.</th>
									
									<th>Tipo Fondo</th>
									<th>Tipo Operación</th>

									<th>Origen de Fondos</th>
									<th>De: Moneda</th>
									<th>De: Monto</th>
									<th>A: Moneda</th>
									<th>A: Monto</th>
									<th>N°. Comprobante</th>

									<th>1. UB Final?</th>
									<th>2. Beneficiarios Finales</th>
								</tr>
							</thead>
							<tbody>
								@foreach($ls as $l)
								<tr id="{{$l->operacion_id}}">
									<td>{{$l->created_at}}</td>
									<td>{{$l->updated_at}}</td>
									<td>{{departamento($l->usuario->departamento_id)}}</td>
									<td>{{provincia($l->usuario->departamento_id,$l->usuario->provincia_id)}}</td>
									<td>{{distrito($l->usuario->departamento_id,$l->usuario->provincia_id,$l->usuario->distrito_id)}}</td>
									
									<td>{{$l->usuario->tiposdocumento->nombre}}</td>
									
									<td>{{$l->usuario->nrodocumento}}</td>
									<td>{{$l->usuario->primeroapellido}}</td>
									<td>{{$l->usuario->segundoapellido}}</td>
									<td>{{$l->usuario->primernombre}} {{$l->usuario->segundonombre}}</td>

									<td>{{$l->usuario->pais->nombre}}</td>
									<td>{{$l->usuario->ocupacion->nombre}}</td>


									<td>{{$l->usuario->Direccion}}</td>

									@if($l->usuario->empresa==1)
										<td>{{$l->usuario->telefono}}</td>
										<td>{{$l->usuario->correo_electronico}}</td>
									@else
										<td>{{$l->usuario->user->userid ?? ''}} - {{$l->usuario->user->actkey ?? ''}} - {{$l->usuario->user->user_home_path ?? ''}}</td>
										<td>{{$l->usuario->user->email}}</td>
									@endif

									@if($l->usuario->empresa==1)
										<td>{{$l->usuario->ruc}}</td>
										<td>{{$l->usuario->razon_social}}</td>
										<td>{{$l->usuario->giro_negocio}}</td>
										<td>{{$l->usuario->primerapellido_c}}</td>
										<td>{{$l->usuario->segundoapellido_c}}</td>
										<td>{{$l->usuario->primernombre_c}} {{$l->usuario->segundonombre_c}}</td>
										<td>{{$l->usuario->tiposdocumentoc_id}}</td>
										<td>{{$l->usuario->nrodocumento_c}}</td>
										<td>{{$l->usuario->telefono_c}}</td>
										<td>{{ isset($l->usuario->ocupacion_c) ? $l->usuario->ocupacion_c->nombre : ''}}</td>
										<td></td>
									@else
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									@endif
									
									<td></td>
									<td></td>
									<td>
										@if (!is_null($l->origen_fondo))
											@if ($l->origen_fondo->code == 'otros')
												{{ $l->origen_fondo_otro }}
											@else
												{{ $l->origen_fondo->name }}
											@endif
										@endif
									</td>
									<td>{{$l->monedae->nombre}}</td>
									<td>{{number_format($l->monto, 2, '.', ',')}}</td>
									<td>{{$l->monedad->nombre}}</td>
									<td>{{number_format($l->cambio, 2, '.', ',')}}</td>
									<td></td>
									@if($l->usuario->empresa==1)
									<td class="text-capitalize">{{ $l->usuario->unico_beneficiario_final }}</td>
									<td class="text-capitalize">{{ $l->usuario->beneficiario_participacion }}</td>
									@else
									<td></td>
									<td></td>
									@endif
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
	<script>
		$(document).ready(function() {
			var tabla=$('#example').DataTable( {
				lengthChange: false,
				buttons: [ 'copy',
				{
					extend: 'excelHtml5',
					orientation: 'landscape',
					pageSize: 'LEGAL',
					exportOptions: {
						format: {
							header: function ( data, columnIdx ) {
								return data.toUpperCase();
							},
							body: function ( data, columnIdx ) {
								return data.toUpperCase();
							},
						},
					}
				},
				{
					extend: 'pdfHtml5',
					orientation: 'landscape',
					pageSize: 'LEGAL',
					exportOptions: {
						columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34]
					}
				}
				, 'colvis' ],
				"columnDefs": [
					{"targets": [ 24 ],"visible": false},
					{"targets": [ 25 ],"visible": false},
					{"targets": [ 26 ],"visible": false},
					{"targets": [ 31 ],"visible": false}]
				});
			tabla.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
			tabla.column( '0:visible' ).order( 'desc' ).draw();
			
			//Escondo el boton de PDF
			var buttons=document.getElementsByClassName('btn btn-primary buttons-pdf buttons-html5');
			for (var i = 0; i < buttons.length; i++) {
				buttons[0].style.display = "none";
			}
		});
	</script>
@endsection