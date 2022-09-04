{{-- //TODO: vistas copiadas de fortune. --}}
@extends('layouts.app')

@push('titulo_completo')
	Bancos
@endpush

@push('titulo')
    Bancos
@endpush

@push('css')
<link href="{{url('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{url('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{url('assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/css/alertify.min.css">
@endpush

@section('content')
	@php 
        $banks=\App\Modelo\Banco::get();
	@endphp

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Bancos</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table table-bordered key-buttons text-nowrap" >
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Activo</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach($banks as $bank)
								<tr>
									<td>{{$bank->nombre}}</td>
									<td>
                                        @if ($bank->is_active)
                                            <span class="p-1 bg-success text-white" style="background-color: #d4edda!important; color: #155724!important; border: 1px solid transparent">SI</span>
                                        @else
                                            <span class="p-1 bg-danger text-white" style="background-color: #f8d7da!important; color: #721c24!important; border: 1px solid transparent">NO</span>
                                        @endif
                                    </td>
									<td>
                                        <a href="" class="btn btn-primary btn-sm mr-2 btn-active" data-id="{{ $bank->banco_id }}" data-is_active="{{ $bank->is_active }}">{{$bank->is_active ? 'Desactivar' : 'Activar'}}</a>
                                        <a href="" class="btn btn-primary btn-sm mr-2 btn-edit" data-id="{{ $bank->banco_id }}">Editar</a>
                                    </td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- Modal edit bank -->
    <div class="modal fade" id="modal-edit-bank" tabindex="-1" role="dialog" aria-labelledby="modal-edit-bank-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar banco</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row mx-auto">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="bank-name">Nombre</label>
                                <input type="text" class="form-control" id="bank-name" placeholder="Ingrese el nombre del banco">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>Estado</label>
                            <div class="form-group">
                                <label class="radio">
                                    <input type="radio" name="bank-is-active" id="bank-active" value="1">
                                    Activo
                                </label>
                                <br>
                                <label class="radio">
                                    <input type="radio" name="bank-is-active" id="bank-inactive" value="0">
                                    Inactivo
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id='btn-save-bank'>Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <form class="d-none" method="POST" action="{{ route('bancos.update') }}" id="form-edit">
        @csrf
        <input type="text" name="bank_id" id="form-bank-id">
        <input type="text" name="name" id="form-bank-name">
        <input type="text" name="is_active" id="form-bank-is-active">
    </form>
@endsection

@section('scripts')
	<script src="{{url('assets/plugins/input-mask/jquery.mask.min.js')}}"></script>
	<script src="{{url('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
	<script src="{{url('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
	<script src="{{url('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
	<script src="{{url('assets/plugins/datatable/responsive.bootstrap4.min.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/alertify.min.js"></script>
	<script>
		var tabla;
        let bankId;
        let banks = @php echo $banks @endphp;
		$(document).ready(function() {
			tabla = $('#example').DataTable( {});
		});

        $('.btn-active').on('click', function(e) {
            e.preventDefault();
            bankId = $(this).attr('data-id');
            let isActive = $(this).attr('data-is_active');

            $('#form-bank-id').val(bankId);
            if (isActive == '1') {
                $('#form-bank-is-active').val('0')
            }
            else {
                $('#form-bank-is-active').val('1')
            }

            $('#form-edit').submit();
        });

        $('.btn-edit').on('click', function(e) {
            e.preventDefault();
            bankId = $(this).attr('data-id');
            let bank = banks.find(bank => bank.banco_id == bankId);
            $('#bank-name').val(bank.nombre);
            bank.is_active ? $('#bank-active').prop("checked", true) : $('#bank-inactive').prop("checked", true);
            $('#modal-edit-bank').modal('toggle');
        });

        $('#btn-save-bank').on('click', function (e) {
            e.preventDefault();

            $('#form-bank-id').val(bankId);
            $('#form-bank-name').val($('#bank-name').val());
            if ($("#bank-active").is(":checked")) {
                $('#form-bank-is-active').val('1')
            }
            else if ($("#bank-inactive").is(":checked")) {
                $('#form-bank-is-active').val('0')
            }

            $('#form-edit').submit();
        });
	</script>
@endsection