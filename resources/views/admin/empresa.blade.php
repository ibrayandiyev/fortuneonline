{{-- //TODO: vistas copiadas de fortune. Parece que solo se usa si entras por URL --}}

@extends('layouts.app')

@push('titulo_completo')
	Empresa
@endpush

@push('titulo')
	Empresa
@endpush

@push('css')
	<link href="{{url('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
	<link href="{{url('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
	<link href="{{url('assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
@endpush

@section('content')
	<div class="row">
		<div class="col-xl-9 col-md-12 col-lg-12">
			<div class="card overflow-hidden">
				<div class="card-header">
					<h3 class="card-title">Flujo del tipo de cambio por mes</h3>
				</div>
				<div class="card-body">
					<canvas id="chart" class="h-350"></canvas>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-12 col-lg-12">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="dash-widget text-center">
								<h3 class="font-weight-extrabold">Tipo de cambio</h3>
								<p>del dia</p>

							</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="dash-widget text-center">
								<p>COMPRA</p>
								<div class="col">
									<p class="mt-1 mb-1"><i class="fas fa-arrow-circle-down text-danger"></i> <h3 class="font-weight-extrabold">3.282</h3> </p>
								</div>


							</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="dash-widget text-center">
								<p>VENTA</p>
								<div class="col">
									<p class="mt-1 mb-1"><i class="fas fa-arrow-circle-up text-success"></i> <h3 class="font-weight-extrabold">3.286</h3></p>
								</div>


							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Últimos movimientos</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table table-bordered key-buttons text-nowrap" >
							<thead>
								<tr>
									<th class="border-bottom-0">Fecha</th>
									<th class="border-bottom-0">Banco Origen</th>
									<th class="border-bottom-0">Banco destino</th>
									<th class="border-bottom-0">Moneda origen</th>
									<th class="border-bottom-0">Moneda destino</th>
									<th class="border-bottom-0">Estado</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>12/07/2019</td>
									<td>Banco de Crédito del Perú</td>
									<td>Banco de Comercio</td>
									<td>S/1,145.00</td>
									<td>$350.00</td>
									<td>Completado</td>
								</tr>
								<tr>
									<td>11/07/2019</td>
									<td>Scotiabank Perú</td>
									<td>Citibank Perú</td>
									<td>$345.00</td>
									<td>S/1,145.00</td>
									<td>Cancelado</td>
								</tr>
								<tr>
									<td>11/06/2019</td>
									<td>Banco de Crédito del Perú</td>
									<td>Interbank</td>
									<td>$500.00</td>
									<td>1,640.00</td>
									<td>En proceso</td>
								</tr>
								<tr>
									<td>23/06/2019</td>
									<td>Interbank</td>
									<td>MiBanco</td>
									<td>$800</td>
									<td>S/2,624.00</td>
									<td>En proceso</td>
								</tr>
								<tr>
									<td>28/05/2019</td>
									<td>Interbank</td>
									<td>Interbank</td>
									<td>$450.00</td>
									<td>S/1,476.00</td>
									<td>Completado</td>
								</tr>
								<tr>
									<td>22/05/2019</td>
									<td>Banco de Crédito del Perú</td>
									<td>Citibank Perú</td>
									<td>S/328.00</td>
									<td>$50.00</td>
									<td>Completado</td>
								</tr>
								<tr>
									<td>22/05/2019</td>
									<td>Banco Pichincha</td>
									<td>Banco Pichincha</td>
									<td>S/1,145.00</td>
									<td>$350.00</td>
									<td>Completado</td>
								</tr>
								<tr>
									<td>29/04/2019</td>
									<td>BBVA</td>
									<td>Interbank</td>
									<td>S/328.00</td>
									<td>$100.00</td>
									<td>Completado</td>
								</tr>
								<tr>
									<td>27/04/2019</td>
									<td>Interbank</td>
									<td>Banco de Crédito del Perú</td>
									<td>S/328.00</td>
									<td>$100.00</td>
									<td>Cancelado</td>
								</tr>
							<tr>
									<td>20/04/2019</td>
									<td>MiBanco</td>
									<td>Banco Falabella</td>
									<td>$100</td>
									<td>S/228.00</td>
									<td>Completado</td>
								</tr>
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
	<script src="{{url('assets/js/datatable.js')}}"></script>
	<script src="{{url('assets/js/apexcharts.js')}}"></script>
	<script src="{{url('assets/plugins/chart.js/chart.min.js')}}"></script>
	<script src="{{url('assets/plugins/chart.js/chart.extension.js')}}"></script>
	<script src="{{url('assets/js/index4.js')}}"></script>
@endsection