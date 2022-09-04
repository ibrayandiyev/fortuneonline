@extends('layouts.app')

@push('css')
    <link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <!-- select2 Plugin -->
    <link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
    <!--mutipleselect css-->
    <link rel="stylesheet" href="{{asset('assets/plugins/multipleselect/multiple-select.css')}}">
    
    <link href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/css/alertify.min.css')}}" rel="stylesheet">
@endpush

@push('titulo_completo')
    Listado de Usuarios
@endpush

@push('titulo')
    Usuarios
@endpush


@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">CONTROL DE USUARIOS</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example-usuarios" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0 all">Nombre</th>
                                    <th class="border-bottom-0 all">Apellido</th>
                                    <th class="border-bottom-0 all">Tipo</th>
                                    <th class="border-bottom-0 all">N° Documento</th>
                                    <th class="border-bottom-0 all">RUC</th>
                                    <th class="border-bottom-0 all">Razón Social</th>
                                    <th class="border-bottom-0 all">N° Ctas</th>
                                    <th class="border-bottom-0 all">Preferencial</th>
                                    {{-- <th class="border-bottom-0 all">Estado</th> --}}
                                    <th class="border-bottom-0">E-mail</th>
                                    <th class="border-bottom-0">Teléfono</th>
                                    <th class="border-bottom-0 all">Dirección</th>
                                    <th class="border-bottom-0 all">Documento (Frente)</th>
                                    <th class="border-bottom-0 all">Documento (Dorso)</th>
                                    <th class="border-bottom-0 all">Ficha RUC</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ls as $l)
                                    <tr id="{{$l->usuario_id}}">
                                       <td>{{$l->primernombre ?? '' . ' ' . $l->segundonombre ?? ''}}</td>
                                        <td>{{$l->primeroapellido ?? '' . ' ' . $l->segundoapellido ?? ''}}</td>
                                        <td>{{isset($l->tiposdocumento) ? $l->tiposdocumento->nombre : ''}}</td>
                                        <td>{{$l->nrodocumento}}</td>
                                        <td>{{$l->ruc}}</td>
                                        <td>{{$l->razon_social}}</td>
                                        <td>{{$l->cuenta->count()}}</td>
                                        
                                        <td>
                                            <a href="#" id="preferencial" data-toggle="modal" data-target="#pref" onclick="Prefencia({{$l->usuario_id}})">
                                                <i class="fas fa-users"></i>
                                            </a>
                                        </td>

                                        {{-- <td>
                                            @if(isset($l->user->userlevel))
                                                @if($l->user->userlevel == 1)
                                                    Activo
                                                    <a href="#" onclick="dusuario({{$l->usuario_id}})"><i class="fas fa-edit"></i></a>
                                                @else
                                                    Inactivo
                                                @endif
                                            @endif
                                        </td> --}}

                                        <td>
                                            @if(isset($l->user->email))
                                                {{$l->user->email}}
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            @if(isset($l->user->userid) || isset($l->user->actkey) || isset($l->user->user_home_path))
                                                @if(isset($l->user->userid))
                                                    {{$l->user->userid}}
                                                    @if(isset($l->user->actkey))
                                                    | {{$l->user->actkey}} 
                                                    @endif
                                                    @if(isset($l->user->user_home_path))
                                                    | {{$l->user->user_home_path}} 
                                                    @endif
                                                @else
                                                    @if(isset($l->user->actkey))
                                                    {{$l->user->actkey}} 
                                                    @endif
                                                    @if(isset($l->user->user_home_path))
                                                    | {{$l->user->user_home_path}} 
                                                    @endif
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{$l->Direccion}}</td>
                                        <td>
                                            @if (!is_null($l->documento_frente))
                                                <div class="text-center">
                                                    <a href="{{asset('assets/documentos/'.$l->documento_frente)}}" target="_blank" class="mr-3">
                                                        <span><i class="fa fa-eye"></i></span>
                                                    </a>
                                                    <a href="{{asset('assets/documentos/'.$l->documento_frente)}}" target="_blank" download="documento_frente_{{ $l->primernombre.'_'.$l->segundonombre.'_'.$l->primeroapellido.' '.$l->segundoapellido }}">
                                                        <span><i class="fa fa-download"></i></span>
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!is_null($l->documento_dorso))
                                                <div class="text-center">
                                                    <a href="{{asset('assets/documentos/'.$l->documento_dorso)}}" target="_blank" class="mr-3">
                                                        <span><i class="fa fa-eye"></i></span>
                                                    </a>
                                                    <a href="{{asset('assets/documentos/'.$l->documento_dorso)}}" target="_blank" download="documento_dorso_{{ $l->primernombre.'_'.$l->segundonombre.'_'.$l->primeroapellido.' '.$l->segundoapellido }}">
                                                        <span><i class="fa fa-download"></i></span>
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!is_null($l->ficha_ruc))
                                                <div class="text-center">
                                                    <a href="{{asset('assets/documentos/'.$l->ficha_ruc)}}" target="_blank" class="mr-3">
                                                        <span><i class="fa fa-eye"></i></span>
                                                    </a>
                                                    <a href="{{asset('assets/documentos/'.$l->ficha_ruc)}}" target="_blank" download="ficha_ruc_{{ $l->ruc.'_'.$l->razon_social }}">
                                                        <span><i class="fa fa-download"></i></span>
                                                    </a>
                                                </div>
                                            @endif
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

    <div class="modal fade" id="pref" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="example-Modal3">Tipo de Cambio Prefencial</h5>
                    <button type="button" class="close boton_cerrar_preferencial" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="tipo">
                        
                    </div>				
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger boton_cerrar_preferencial" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('assets/js/select2.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/responsive.bootstrap4.min.js')}}"></script>

    {{-- //TODO: este archivo se ve que es el que pagina todas las filas y hasta las ordena asc o desc dependiendo la opcion que elijas --}}
    <!-- Data table js -->
    <script src="{{asset('assets/js/datatable.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/alertify.min.js"></script>
    
    <script>
        $(document).ready(function() {
            var tabla= $('#example-usuarios').DataTable( {
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
						columns: [0,1,2,3,4,5,6,8,9,10]
					}
				},
				{
					extend: 'pdfHtml5',
					orientation: 'landscape',
					pageSize: 'LEGAL',
					exportOptions: {
						columns: [0,1,2,3,4,5,6,8,9,10]
					}
				}
				, 'colvis' ],
				});
			tabla.buttons().container().appendTo( '#example-usuarios_wrapper .col-md-6:eq(0)' );
			tabla.column( '0:visible' ).order( 'desc' ).draw();
			
			//Escondo el boton de PDF
			var buttons=document.getElementsByClassName('btn btn-primary buttons-pdf buttons-html5');
			for (var i = 0; i < buttons.length; i++) {
				buttons[0].style.display = "none";
			}
        });

        function Update(i){
            $("#data").load("{{url('pusuario')}}/"+i);
        }
        function dusuario(i) {
            $.get("{{url('dusuario')}}/"+i,function(e){
                alertify.success("Se actualizo el estado del usuario a: INACTIVO");
            });
        }
        function Actuliza(i){
            $.get("{{url('ausuario')}}/"+i,{ps:$("#ps").val()},function(r){
                $("#msg").html(r);
                $("#msg").css('background-color','green');
            });
        }
        function Prefencia(i) {
            $("#tipo").load("{{url('putipo')}}/"+i);
        }
        $(document).on("submit","#tc",function (e) {
            e.preventDefault();
            $.get("{{url('uutipo')}}/"+$("#id").val(),$("#tc").serialize(),function(r){
                $("#msg").html("Actualizado Correctamente");
                $("#msg").css('background-color','green');
            });
        });

        $(document).on("click","#preferencial",function (e) {
            $('.dtr-bs-modal').remove();
        });

        $(document).on("click",".boton_cerrar_preferencial",function (e) {
            $('.modal-backdrop').remove();

        });
    </script>
@endsection