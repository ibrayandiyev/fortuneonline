{{-- //TODO: vistas copiadas de fortune. --}}
@extends('layouts.app')

@push('titulo_completo')
	Códigos de descuento
@endpush

@push('titulo')
Códigos de descuento
@endpush

@push('css')
<link href="{{url('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{url('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{url('assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/css/alertify.min.css">
@endpush

@section('content')
	@php 
        $discountCodes=\App\Modelo\CodigoDescuento::get();
	@endphp

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">Códigos de descuento</div>
                    <div class="card-toolbar">
                        <a href="return false;" class="btn btn-primary btn-sm font-weight-bolder" data-toggle="modal" data-target="#modal-new-discount-code">
                            Crear código de descuento
                        </a>
                    </div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table table-bordered key-buttons text-nowrap" >
							<thead>
								<tr>
									<th>Código</th>
									<th>Descuento</th>
									<th>Activo</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach($discountCodes as $discountCode)
								<tr>
									<td>{{$discountCode->code}}</td>
									<td>S/{{$discountCode->discount}}</td>
									<td>
                                        @if ($discountCode->is_active)
                                            <span class="p-1 bg-success text-white" style="background-color: #d4edda!important; color: #155724!important; border: 1px solid transparent">SI</span>
                                        @else
                                            <span class="p-1 bg-danger text-white" style="background-color: #f8d7da!important; color: #721c24!important; border: 1px solid transparent">NO</span>
                                        @endif
                                    </td>
									<td>
                                        <a href="" class="btn btn-primary btn-sm mr-2 btn-active" data-id="{{ $discountCode->id }}" data-is_active="{{ $discountCode->is_active }}">{{$discountCode->is_active ? 'Desactivar' : 'Activar'}}</a>
                                        <a href="" class="btn btn-primary btn-sm mr-2 btn-edit" data-id="{{ $discountCode->id }}">Editar</a>
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

    <!-- Modal create discount code -->
    <div class="modal fade" id="modal-new-discount-code" tabindex="-1" role="dialog" aria-labelledby="modal-new-discount-code-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear código de descuento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row mx-auto">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="new-discount-code-code">Código</label>
                                <input type="text" class="form-control" id="new-discount-code-code" placeholder="Ingrese el código de descuento">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="new-discount-code-discount">Descuento</label>
                                <input type="text" class="form-control" id="new-discount-code-discount" placeholder="Ingrese el porcentaje de descuento" maxlength="3" pattern="[0-9]+" oninput="this.value = this.value.replace(/[^\d]+/g, '')">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>Estado</label>
                            <div class="form-group">
                                <label class="radio">
                                    <input type="radio" name="new-discount-code-is-active" id="new-discount-code-active" value="1">
                                    Activo
                                </label>
                                <br>
                                <label class="radio">
                                    <input type="radio" name="new-discount-code-is-active" id="new-discount-code-inactive" value="0">
                                    Inactivo
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id='btn-save-new-discount-code'>Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit discount code -->
    <div class="modal fade" id="modal-edit-discount-code" tabindex="-1" role="dialog" aria-labelledby="modal-edit-discount-code-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar código de descuento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row mx-auto">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="discount-code-code">Código</label>
                                <input type="text" class="form-control" id="discount-code-code" placeholder="Ingrese el código de descuento">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="discount-code-discount">Porcentaje de descuento</label>
                                <input type="text" class="form-control" id="discount-code-discount" placeholder="Ingrese el porcentaje de descuento" maxlength="3" pattern="[0-9]+" oninput="this.value = this.value.replace(/[^\d]+/g, '')">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>Estado</label>
                            <div class="form-group">
                                <label class="radio">
                                    <input type="radio" name="discount-code-is-active" id="discount-code-active" value="1">
                                    Activo
                                </label>
                                <br>
                                <label class="radio">
                                    <input type="radio" name="discount-code-is-active" id="discount-code-inactive" value="0">
                                    Inactivo
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id='btn-save-discount-code'>Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <form class="d-none" method="POST" action="{{ route('codigos_descuento.update') }}" id="form-edit">
        @csrf
        <input type="text" name="discount_code_id" id="form-discount-code-id">
        <input type="text" name="code" id="form-discount-code-code">
        <input type="text" name="discount" id="form-discount-code-discount">
        <input type="text" name="is_active" id="form-discount-code-is-active">
    </form>

    <form class="d-none" method="POST" action="{{ route('codigos_descuento.store') }}" id="form-store">
        @csrf
        <input type="text" name="code" id="form-new-discount-code-code">
        <input type="text" name="discount" id="form-new-discount-code-discount">
        <input type="text" name="is_active" id="form-new-discount-code-is-active">
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
        let discountCodeId;
        let discountCodes = @php echo $discountCodes @endphp;
		$(document).ready(function() {
			tabla = $('#example').DataTable( {});
		});

        $('.btn-active').on('click', function(e) {
            e.preventDefault();
            discountCodeId = $(this).attr('data-id');
            let isActive = $(this).attr('data-is_active');

            $('#form-discount-code-id').val(discountCodeId);
            if (isActive == '1') {
                $('#form-discount-code-is-active').val('0')
            }
            else {
                $('#form-discount-code-is-active').val('1')
            }

            $('#form-edit').submit();
        });

        $('.btn-edit').on('click', function(e) {
            e.preventDefault();
            discountCodeId = $(this).attr('data-id');
            let discountCode = discountCodes.find(discountCode => discountCode.id == discountCodeId);
            $('#discount-code-code').val(discountCode.code);
            $('#discount-code-discount').val(discountCode.discount);
            discountCode.is_active ? $('#discount-code-active').prop("checked", true) : $('#discount-code-inactive').prop("checked", true);
            $('#modal-edit-discount-code').modal('toggle');
        });

        $('#btn-save-discount-code').on('click', function (e) {
            e.preventDefault();

            $('#form-discount-code-id').val(discountCodeId);
            $('#form-discount-code-code').val($('#discount-code-code').val());
            $('#form-discount-code-discount').val($('#discount-code-discount').val());
            if ($("#discount-code-active").is(":checked")) {
                $('#form-discount-code-is-active').val('1')
            }
            else if ($("#discount-code-inactive").is(":checked")) {
                $('#form-discount-code-is-active').val('0')
            }

            $('#form-edit').submit();
        });

        $('#btn-save-new-discount-code').on('click', function (e) {
            e.preventDefault();

            $('#form-new-discount-code-code').val($('#new-discount-code-code').val());
            $('#form-new-discount-code-discount').val($('#new-discount-code-discount').val());
            if ($("#new-discount-code-active").is(":checked")) {
                $('#form-new-discount-code-is-active').val('1')
            }
            else if ($("#new-discount-code-inactive").is(":checked")) {
                $('#form-new-discount-code-is-active').val('0')
            }

            $('#form-store').submit();
        });
	</script>
@endsection