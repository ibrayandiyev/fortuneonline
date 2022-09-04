@extends('layouts.app')

@push('css')
    <link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <!-- select2 Plugin -->
    <link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
    <!--mutipleselect css-->
    <link href="{{asset('assets/plugins/multipleselect/multiple-select.css')}}" rel="stylesheet">

    <link href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/css/alertify.min.css')}}" rel="stylesheet">

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
        .ajs-message{color: white;}
        .label{color: white;font-weight: bold;font-size: 0.75em;}
        .label-warning{background-color: #a98307;padding: 2px 4px;border-radius: 5px;}
        .label-primary{background-color: #2271b3;padding: 2px 4px;border-radius: 5px;}
        .label-success{background-color: #00bb2d;padding: 2px 4px;border-radius: 5px;}
        .label-danger{background-color: #dc3545;padding: 2px 4px;border-radius: 5px;}
    </style>
@endpush

@push('titulo_completo')
        <h4 class="txtnaranja"> MOVIMIENTOS</h4>
@endpush

@push('titulo')
    Movimientos
@endpush

@section('content')

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <img src="{{asset('assets/images/movimientos.png')}}" alt="img">
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered key-buttons text-nowrap" >
                        <thead>
                            <tr>
                                <th class="border-bottom-0 text-negro">ID</th>
                                <th class="border-bottom-0 text-negro">Fecha</th>
                                <th class="border-bottom-0 text-negro">Nombre</th>
                                <th class="border-bottom-0 text-negro">Enviado</th>
                                <th class="border-bottom-0 text-negro">Recibido</th>
                                <th class="border-bottom-0 text-negro">T/C</th>
                                <th class="border-bottom-0 text-negro">Estado</th>
                                @if(\Auth::User()->hasRole('Administrators'))
                                    <th class="border-bottom-0 text-negro">N° OP y voucher</th>
                                @endif
                                <th class="border-bottom-0 text-negro">Ver</th>
                                @if(\Auth::User()->hasRole('Administrators'))
                                    <th class="border-bottom-0 text-negro">Cancelar</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($ls as $l)
                                <tr id="{{$l->operacion_id}}">
                                    <td>{{$l->operacion_id}}</td>
                                    <td>{{$l->created_at}}</td>
                                    @if($l->usuario->personal == 1)
                                        <td>{{$l->usuario->primernombre}} {{$l->usuario->segundonombre}} {{$l->usuario->primeroapellido}} {{$l->usuario->segundoapellido}}</td>
                                    @elseif($l->usuario->empresa == 1)
                                        <td>{{$l->usuario->razon_social}} </td>
                                    @endif
                                    <td>@if($l->moneda_id == 1) S/ @else $ @endif  {{number_format($l->monto, 2, '.', ',')}}</td>
                                    <td>@if($l->tmoneda_id == 1) S/ @else $ @endif {{number_format($l->cambio, 2, '.', ',')}}</td>
                                    <td>{{$l->taza}}</td>

                                    @if(\Auth::User()->hasRole('Usuario'))
                                        <td>
                                            @if($l->estado==0) <button type="button" class="btn btn-info btn-sm"><i class="far fa-bell"></i> Pendiente</button> @endif
                                            @if($l->estado==1) <button type="button" class="btn btn-info btn-sm"><i class="far fa-bell"></i> Procesando</button> @endif
                                            @if($l->estado==2) <button type="button" class="btn btn-primary btn-sm"><i class="far fa-thumbs-up"></i> Terminado</button> @endif
                                            @if($l->estado==3) <button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-exclamation-triangle"></i> Cancelado</button> @endif
                                        </td>
                                    @endif
                                    @if(\Auth::User()->hasRole('Administrators'))
                                        <td>
                                            @if($l->estado==0) <button type="button" class="btn btn-info btn-sm" onclick="update({{$l->operacion_id}})"><i class="far fa-bell"></i> Pendiente</button> @endif
                                            @if($l->estado==1) <button type="button" class="btn btn-info btn-sm" onclick="update({{$l->operacion_id}})"><i class="far fa-bell"></i> Procesando</button> @endif
                                            @if($l->estado==2) <button type="button" class="btn btn-primary btn-sm"><i class="far fa-thumbs-up"></i> Terminado</button> @endif
                                            @if($l->estado==3) <button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-exclamation-triangle"></i> Cancelado</button> @endif
                                        </td>
                                    @endif

                                    @if(\Auth::User()->hasRole('Administrators'))
                                        <td>
                                            @if( !(isset($l->voucher) && isset($l->voucher2) && isset($l->voucher3) && isset($l->voucher4)) )
                                                <center>
                                                    <a href="#" onclick="formularioNumerosOperacionYVouchers({{$l->operacion_id}})"><i class="fas fa-upload"></i></a>
                                                </center>
                                            @else
                                                <center>
                                                    Ya cargados
                                                </center>
                                            @endif
                                        </td>
                                    @endif

                                    <td>
                                        <center>
                                            <a href="#" onclick="contenido({{$l->operacion_id}})" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i></a>
                                        </center>
                                    </td>
                                    @if(\Auth::User()->hasRole('Administrators'))
                                        <td>
                                            @if($l->estado!=2 && $l->estado!=3)
                                                <center>
                                                    <a href="#" onclick="anular({{$l->operacion_id}})"><i class="fas fa-window-close"></i></a>
                                                </center>
                                            @endif
                                        </td>
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

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div id="contenido">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div id="contenido2">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updateVoucher()">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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

    @if( \Auth::User()->hasRole('Administrators'))
        <script>
            //Guardo el id de la operacion a la que se le esta agregando vouchers y numeros de operacion.
            var id_actual_operacion;

            var tabla;
            $(document).ready(function() {
                tabla = $('#example').DataTable( {
                    lengthChange: false,
                    buttons: [ 'copy', 'excel','pdf', 'colvis' ]
                });
                tabla.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
                tabla.column( '0:visible' ).order( 'desc' ).draw();
            });

            function contenido(i) {
                $("#contenido").load("foperacion/"+i);
            }

            function formularioNumerosOperacionYVouchers(id){
                id_actual_operacion = id;

                $('#myModal2').modal('toggle');

                $("#contenido2").load("noperacionyvouchers/"+id);
            }
        </script>
    @else
        <script>
            //Guardo el id de la operacion a la que se le esta agregando vouchers y numeros de operacion.
            var id_actual_operacion;

            var tabla;
            $(document).ready(function() {
                tabla = $('#example').DataTable( {
                    lengthChange: false,
                    buttons: [ 'copy', 'excel','pdf' ]
                });
                tabla.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
                tabla.column( '0:visible' ).order( 'desc' ).draw();
            });

            function contenido(i) {
                $("#contenido").load("foperacion/"+i);
            }

            function formularioNumerosOperacionYVouchers(id){
                id_actual_operacion = id;

                $('#myModal2').modal('toggle');

                $("#contenido2").load("noperacionyvouchers/"+id);
            }
        </script>
    @endif

    @if(\Auth::User()->hasRole('Administrators'))
        <script>
            function update(i) {
                alertify.confirm("Procesar Cuenta","¿Esta seguro con procesar esta cuenta?",
                    function(){
                        $.get("uoperacion/"+i,function(msg){
                            var index = tabla.row($("tr[id=" + i + "]")).index();
                            tabla.cell(index, 6).data(function (data, type, row, meta) {
                                if (msg.estado === 0) { return '<button type="button" class="btn btn-info btn-sm" onclick="update('+msg.operacion_id+')"><i class="far fa-bell"></i> Pendiente</button>'}
                                if (msg.estado === 1) { return '<button type="button" class="btn btn-info btn-sm" onclick="update('+msg.operacion_id+')"><i class="far fa-bell"></i> Procesando</button>'}
                                if (msg.estado === 2) { return '<button type="button" class="btn btn-primary btn-sm"><i class="far fa-thumbs-up"></i> Terminado</button>'}
                            });
                            tabla.cell(index, 9).data(function (data, type, row, meta) {
                                if (msg.estado === 2) { return ''}
                            });
                            alertify.success("Se actualizó el estado de la transacción");
                        });
                    },
                    function(){
                        alertify.error("Eliminación cancelada");
                    }
                );
            }
            function anular(i) {
                alertify.confirm("Cancelar Transacción","¿Esta seguro que desea cancelar esta transacción? No se podrá revertir esta acción",
                    function(){
                        $.get("doperacion/"+i,function(msg){
                            var index = tabla.row($("tr[id=" + i + "]")).index();
                            tabla.cell(index, 6).data(function (data, type, row, meta) {
                                return '<button type="button" class="btn btn-danger btn-sm"><i class="far fa-thumbs-up"></i> Anulado</button>';
                            });
                            tabla.cell(index, 9).data(function (data, type, row, meta) {
                                return ''
                            });
                            alertify.success(msg);
                        });
                    },
                    function(){
                        alertify.error("No se canceló la transacción");
                    }
                );
            }

            function updateVoucher() {
                let i = id_actual_operacion;

                var token = '{{csrf_token()}}';

                var fd = new FormData();
                var files = $('#vou')[0].files[0];
                var files2 = $('#vou2')[0].files[0];
                var files3 = $('#vou3')[0].files[0];
                var files4 = $('#vou4')[0].files[0];

                fd.append('id_operacion', i);

                fd.append('vou', files);
                fd.append('vou2', files2);
                fd.append('vou3', files3);
                fd.append('vou4', files4);
                fd.append('num_ope', $("#num_ope").val());
                fd.append('num_ope2', $("#num_ope2").val());
                fd.append('num_ope3', $("#num_ope3").val());
                fd.append('num_ope4', $("#num_ope4").val());
                fd.append('_token', token);

                $.ajax({
                    url: '{{route("svoucher")}}',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response){
                        if(response['success']){
                            alertify.success(response['mensaje']);
                            $('#myModal2').modal('hide');
                            $('body').removeClass('modal-open');
                        }
                        else{
                            alertify.error(response['mensaje']);
                        }
                    },
                });
            }
        </script>
    @endif
@endsection
