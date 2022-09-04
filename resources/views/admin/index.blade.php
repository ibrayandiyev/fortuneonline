@extends('layouts.app')

@push('titulo')
Bienvenido
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
    .label{color: white;font-weight: bold; font-size: 0.75em;}
    .label-warning{background-color: #a98307;padding: 2px 4px;border-radius: 5px;}
    .label-primary{background-color: #2271b3;padding: 2px 4px;border-radius: 5px;}
    .label-success{background-color: #00bb2d;padding: 2px 4px;border-radius: 5px;}
    .label-danger{background-color: #dc3545;padding: 2px 4px;border-radius: 5px;}
</style>
@endpush
@section('content')
@if(\Auth::User()->hasRole('Administrators'))
<?php
$ls=\App\Modelo\Operacion::with("cuentabancariae","cuentabancariat","cuentabancariad","cuentabancariat","monedae","monedad","usuario")->get();
 ?>
@else
<?php
$ls=\App\Modelo\Operacion::with("cuentabancariae","cuentabancariat","cuentabancariad","cuentabancariat","monedae","monedad","usuario")->where("usuario_id",\Auth::User()->usuario_id)->get();
 ?>
@endif
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
                  <div class="card-header">
                      <div class="card-title text-negro">
                          TIPO DE CAMBIO DEL DÍA
                      </div>
                  </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card bg-success text-center">
                    <div class="card-body">
                        <div class="dash-widget text-center">

                            <div class="col">
                                <p class="mt-1 mb-1"><i class="fas fa-arrow-circle-down text-cambio fa-lg text-danger"></i> <h3 class="font-weight-extrabold pure">0.00</h3> </p>
                            <p>FORTUNE COMPRA</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card bg-info text-center blanco">
                    <div class="card-body">
                        <div class="dash-widget text-center">

                            <div class="col">
                                <p class="mt-1 mb-1"><i class="fas fa-arrow-circle-up text-success text-red fa-lg"></i> <h3 class="font-weight-extrabold sale">0.00</h3></p>
                                <p>FORTUNE VENDE</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            use Illuminate\Support\Facades\DB;

            $enabled_operations = DB::table('configuration')->where('config_name', 'enabled_operations')->first();

            if (!$enabled_operations) {
                $enabled_operations = true;
            }
            else {
                $enabled_operations = $enabled_operations->config_value == '1' ? true : false;
            }
        @endphp

		@if(\Auth::User()->hasRole('Administrators'))
            <div class="row">
                <div class="col-12 align-items-center">
                    <div class="card">
                        <div class="card-body bg-{{ $enabled_operations ? 'danger' : 'success' }}">
                            <div class="dash-widget text-center">
                                @if ($enabled_operations)
                                    <a href="{{ route('desactivar-operaciones') }}" class="mb-0 text-white">Deshabilitar operaciones</a>
                                @else
                                    <a href="{{ route('activar-operaciones') }}" class="mb-0 text-white">Habilitar operaciones</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
                                <th class="border-bottom-0">Nombre</th>
                                <th class="border-bottom-0">Moneda origen</th>
                                <th class="border-bottom-0">Enviado</th>
                                <th class="border-bottom-0">Moneda destino</th>
                                <th class="border-bottom-0">Esperado</th>
                                <th class="border-bottom-0">Tasa</th>
                                <th class="border-bottom-0">Estado</th>
                                <th class="border-bottom-0">Actualizado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ls as $l)
                            <tr id="{{$l->operacion_id}}">
                                <td>{{$l->created_at}}</td>
                                <td>{{$l->usuario->primernombre}} {{$l->usuario->segundonombre}} {{$l->usuario->primerapellido}} {{$l->usuario->segundoapellido}}</td>
                                <td>{{$l->monedae->nombre}}</td>
                                <td>{{$l->monto}}</td>
                                <td>{{$l->monedad->nombre}}</td>
                                <td>{{$l->cambio}}</td>
                                <td>{{$l->taza}}</td>
                                <td>
                                    @if($l->estado==0) <span class="label label-warning">Enviado</span> @endif
                                    @if($l->estado==1) <span class="label label-primary">Procesando</span> @endif
                                    @if($l->estado==2) <span class="label label-success">Terminado</span> @endif
                                    @if($l->estado==3) <span class="label label-danger">Anulado</span> @endif
                                </td>
                                <td>{{$l->last_user}}</td>
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
<script src="{{url('assets/plugins/chart.js/chart.min.js')}}"></script>
<script src="{{url('assets/plugins/chart.js/chart.extension.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/alertify.min.js"></script>
<script>
    "use strict";
    var tabla;
    var dcompra=[];
    var dventa=[];
    var dlabel=[];

    $(document).ready(function() {
        tabla = $('#example').DataTable( {
            lengthChange: false,
            buttons: ['excel', 'pdf', 'colvis' ]
        });
        tabla.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
        tabla.column( '0:visible' ).order( 'desc' ).draw();

        $.get("{{url('ltipocambio')}}",function(r){
            for (var i = 1; i < r.length; i++) {
                dcompra.push(r[i].compra);
                dventa.push(r[i].venta);
                dlabel.push(r[i].created_at);
            }
            grafica();
        });
    });

    function grafica(){
        var ctx = document.getElementById( "chart" );
        var myChart = new Chart( ctx, {
            type: 'line',
            data: {
                labels: dlabel,
                datasets: [
                    {
                        label: "Compra",
                        data: dcompra,
                        borderColor: "blue",
                        borderWidth: "1",
                        pointRadius:"2",
                        pointBorderColor: 'transparent',
                        pointBackgroundColor: 'blue',
                        backgroundColor: "rgb(0,0,255,0.05)"
                    },{
                        label: "Venta",
                        data: dventa,
                        borderColor: "red",
                        borderWidth: "1",
                        pointRadius:"2",
                        pointBorderColor: 'transparent',
                        pointBackgroundColor: 'red',
                        backgroundColor: "rgb(255,0,0,0.05)"
                    }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                barRoundness: 1,
                scales: {
                    yAxes: [ {
                        ticks: {
                            beginAtZero: true
                            }
                        }]
                }
            }
        });
    }
</script>
<script>
	var dc=0.00;
    var dv=0.00;
    var cam=0.00;
    var cron=600;
    var pref=false;
    $(document).ready(function(){
        $.get("ftipocambio",function (msg) {
            dc=eval(msg.compra);
            dv=eval(msg.venta);
            $(".pure").html(dc);
            $(".sale").html(dv);
        });
        function tipocambio() {
            if(cron===0){
                $.get("ftipocambio",function (msg) {
                    dc=eval(msg.compra);
                    dv=eval(msg.venta);
                    $(".pure").html(dc);
                    $(".sale").html(dv);
                    alertify.alert('Ha caducado el tiempo', '¡Actualizaremos las tasas!', function(){
                        alertify.success('Ok');
                        location.reload();
                    });
                });
            }else{
                cron-=1;
                var tim=parseInt(cron/60)+":"+(cron%60);
                $('.cronometro').html(tim);
            }
        }
        setInterval(tipocambio, 1000);
    });
</script>
@endsection
