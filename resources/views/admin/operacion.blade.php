@extends('layouts.app')

@push('css')
    <!-- select2 Plugin -->
    <link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet">

    <!--mutipleselect css-->
    <link href="{{asset('assets/plugins/multipleselect/multiple-select.css')}}" rel="stylesheet">
    <link href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/css/alertify.min.css')}}" rel="stylesheet">
@endpush

@push('titulo_completo')
    <h4 class="txtnaranja"> OPERACIÓN</h4>@endpush
@push('titulo')
    Operación
@endpush


@section('content')
    @php
        $ban=\App\Modelo\Cuentabancaria::with("tipo","moneda","banco")->join('banco', 'banco.banco_id', 'cuentabancaria.banco_id')->where('banco.is_active', 1)->where("cuentabancaria.usuario_id",\Auth::User()->usuario_id)->get();
        $mos=\App\Modelo\Moneda::all();
        $cud=\App\Modelo\Cuentabancaria::with("tipo","moneda","banco")->join('banco', 'banco.banco_id', 'cuentabancaria.banco_id')->where('banco.is_active', 1)->where("cuentabancaria.usuario_id",1)->get();
        $origen_fondos = \App\Modelo\OrigenFondo::all();
        $discountCodes = \App\Modelo\CodigoDescuento::where('is_active', 1)->get();
    @endphp

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

    @if (!$enabled_operations)
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <h4 class="m-5 text-center">
                    Las operaciones se encuentran deshabilitadas momentaneamente
                </h4>
            </div>
        </div>
    </div>
    @else

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body" id ="card-body-x">
                    <div class="row">
                        <div class="col-xl-9 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <img src="{{asset('assets/images/boperacion.png')}}">
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form id="form" method="POST" action="{{route('soperacion')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="list-group">

                                            {{-- 1era Solapa: Calcula --}}
                                            <div class="list-group-item py-3" data-acc-step>
                                                <h5 class="mb-0" data-acc-title></h5>
												<img src="{{asset('assets/images/calcula.png')}}">
                                                <div data-acc-content>
                                                    <div class="my-3">
                                                        <div class="card-body overflow-hidden">
                                                            <div class="form-group ">
                                                                <label class="form-label">¿Desde qué banco envías tu dinero?</label>
                                                                <select class="form-control select2 custom-select" id="banco-envio" data-placeholder="Elija uno" required name="baa">
                                                                    <option></option>
                                                                    @foreach($ban as $ba)
                                                                        <option value="{{$ba->cuentabancaria_id}}" data-tipo_moneda="{{$ba->moneda->moneda_id}}">{{$ba->banco->nombre}} | {{$ba->moneda->nombre}} | {{$ba->nrocuenta}} @if(isset($ba->nrocuentacci)) | CCI - {{$ba->nrocuentacci}} @endif</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group ">
                                                                <label class="form-label">¿En qué cuenta deseas recibir tu dinero?</label>
                                                                <select class="form-control select2 custom-select" id="banco-recibo" data-placeholder="Elija uno" name="cuenta" required>
                                                                    <option></option>
                                                                    @foreach($ban as $ba)
                                                                        <option value="{{$ba->cuentabancaria_id}}" data-tipo_moneda="{{$ba->moneda->moneda_id}}">{{$ba->banco->nombre}} | {{$ba->moneda->nombre}} | {{$ba->nrocuenta}} @if(isset($ba->nrocuentacci)) | CCI - {{$ba->nrocuentacci}} @endif</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="form-label">MONTO</label>
                                                                <input type="text" class="form-control" id="monto" name="monto" placeholder="Ingrese el monto" onkeyup="Calcular();" value="0.00">
                                                            </div>

                                                            <button type="button" class="btn btn-primary btn-block" onclick="Calcular()">COTIZA</button>

                                                            <div id="alerta" class="label label-success" style="visibility: hidden;"><br>
                                                                Si vas a transferir <strong>más de U$10,000 (Diez mil dólares americanos)</strong>, <br>por favor comunícate con nosotros por WhatsApp <a href="https://wa.me/51946091321"><strong>AQUÍ</strong></a>. <br>¡Tenemos un cambio preferencial para ti!
                                                            </div>

                                                            <br>
                                                            <br>

                                                            <div class="col-md-12 col-xl-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="dash-widget text-negro">
                                                                            <p>RECIBIRÁS</p>
                                                                            <h3>
                                                                                <span id="reci">
                                                                                </span>

                                                                                <span id="dine">
                                                                                </span>
																			</h3>
                                                                            <p class="mb-0 text-muted">
                                                                                <i class="fas fa-calculator fa-lg bg-warning"></i>
                                                                                Tipo de cambio usado
                                                                                <br>
                                                                                <center><span class="h4 font-weight-bold mb-0" id="tcus"></span></center>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- 2da Solapa: Transfiere --}}
                                            <div class="list-group-item py-3" data-acc-step>
                                                <h5 class="mb-0" data-acc-title> </h5>
												<img src="{{asset('assets/images/transfiere.png')}}">
                                                <div data-acc-content>
                                                    <div class="my-3">
                                                        <div class="mt-3">
                                                            <div class="form-group">
                                                                <label class="form-label">Elige el banco para transferir</label>
                                                                {{-- //TODO: esto estaba en el otro operacion.blade.php --}}
                                                                <input type="text" name="moe" id="moe" hidden>
                                                                <input type="text" name="mor" id="mor" hidden>
                                                                <select class="form-control select2 custom-select" data-placeholder="Elija uno" name="bar" id="bar" style="width: 100% !important;">
                                                                    @foreach($cud as $ba)
                                                                        <option value="{{$ba->cuentabancaria_id}}">{{$ba->banco->nombre}} | {{$ba->nrocuenta}} @if(isset($ba->nrocuentacci)) | CCI: {{$ba->nrocuentacci}} @endif</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                             @if (count($discountCodes) > 0)
                                                                <div class="form-group d-none" id ="div-discount-codes">
                                                                    <label class="form-label">INGRESA EL CÓDIGO DE DESCUENTO</label>
                                                                    <input type="text" class="form-control" id="discount_code" name="discount_code" placeholder="Ingrese el código de descuento">
                                                                </div>
                                                            @endif

                                                            <ul class="list-group">
                                                                <li class="list-group-item">

                                                                </li>
                                                                <li class="list-group-item">
                                                                    Transfiere
                                                                    <span class="badgetext h6 font-weight-bold mb-0">
                                                                        <span id="btra">
                                                                        </span>

                                                                        <span id="bmon">
                                                                        </span>
                                                                    </span>
                                                                    <br><br>
                                                                    a la cuenta
                                                                    <span class="badgetext h5 font-weight-bold mb-0">
                                                                        <span id="tcse">
                                                                        </span>
                                                                        <br><br>
                                                                        <span id="ncse">
                                                                        </span>
                                                                    </span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Recibes
                                                                    <span class="badgetext h4 font-weight-bold mb-0">
                                                                        <span id="atra">
                                                                        </span>

                                                                        <span id="amon">
                                                                        </span>
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- 3era Solapa: Finalizar --}}
                                            <div class="list-group-item py-3" data-acc-step>
                                                <h5 class="mb-0" data-acc-title> </h5>
												<img src="{{asset('assets/images/finalizar.png')}}">
                                                <div data-acc-content>
                                                    <div class="my-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Origen de fondos</label>
                                                            <select class="form-control select2 custom-select" data-placeholder="Elija uno" name="origen_fondo_id" id="origen_fondo_id" style="width: 100% !important;">
                                                                <option></option>
                                                                @foreach($origen_fondos as $origen_fondo)
                                                                    <option value="{{$origen_fondo->id}}">{{$origen_fondo->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group d-none" id="origen_fondo_otro">
                                                            <label class="form-label">Ingresa el origen de los fondos</label>
                                                            <input type="text" class="form-control" name="origen_fondo_otro" id="origen_fondo_otro_input" placeholder="Ingresa el origen de los fondos">
                                                        </div>
                                                        <div class="float-right">
                                                            <a id="mas_vouchers" style="cursor: pointer;">
                                                                Más vouchers&nbsp; <i class="fas fa-plus-circle"></i>
                                                            </a>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="form-label">Adjunta el voucher o captura de tu transferencia</div>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input vouchers" id="vou" name="vou" accept="image/png, .jpeg, .jpg, image/gif">
                                                                <label class="custom-file-label">Elegir archivo</label>
                                                            </div>
                                                        </div>
                                                        <div class="d-none" id="div_vou_2">
                                                            <div class="form-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input vouchers" id="vou2" name="vou2" accept="image/png, .jpeg, .jpg, image/gif">
                                                                    <label class="custom-file-label">Elegir archivo</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-none" id="div_vou_3">
                                                            <div class="form-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input vouchers" id="vou3" name="vou3" accept="image/png, .jpeg, .jpg, image/gif">
                                                                    <label class="custom-file-label">Elegir archivo</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-none" id="div_vou_4">
                                                            <div class="form-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input vouchers" id="vou4" name="vou4" accept="image/png, .jpeg, .jpg, image/gif">
                                                                    <label class="custom-file-label">Elegir archivo</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <label class="form-label">
                                                            Dale click al botón “Grabar” para completar tu operación.


															<br>
                              Recuerda completar correctamente todos los campos para enviar la solicitud.
                              <br>
                           	 <br><strong><b>Tu transacción está en camino.</b></strong><br>

                          Recuerda que las operaciones con BCP e Interbank tardan un máximo de 25 minutos, y solo
                          trabajamos con transferencias interbancarias INMEDIATAS. <br>






                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="text" id="cambio" name="cambio" hidden="true">
                                        <input type="text" id="compra" name="compra" hidden="true">
                                        <input type="text" id="monto_con_descuento" name="monto_con_descuento" hidden="true">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-12 layout-spacing">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        TIPO DE CAMBIO @if(\Auth::User()->regdate==1) (preferencial) @endif
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="col-md-6 col-xl-12 col-lg-3">
                                        <div class="card bg-success text-center">
                                            <div class="card-body">
                                                <p class="mb-0 text-white-50">COMPRA</p>
                                                <i class="fas fa-arrow-alt-circle-up text-cambio fa-lg  mr-1"></i><h2 class=" mb-0 pure">0.00</h2>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xl-12 col-lg-3">
                                        <div class="card bg-info text-center blanco">
                                            <div class="card-body">
                                                <p class="mb-0 text-whiteblanco-50">VENTA</p>
                                                <i class="fas fa-arrow-alt-circle-down text-red mr-1 fa-lg"></i><h2 class=" mb-0 sale">0.00</h2>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xl-12 col-lg-3">
                                        <div class="card bg-warning text-center">
                                            <div class="card-body">
                                                <p class="mb-0 text-white-50">El tipo de cambio variará en:</p><br>
                                                <i class="far fa-clock fa-lg"></i><br>
                                                <h3 class=" mb-0 cronometro">0.00</h3>
                                                <h5 class=" mb-0">Minutos</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('scripts')
    <!--Accordion-Wizard-Form js-->
		<script src="{{asset('assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js')}}"></script>
		<script src="{{asset('assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js')}}"></script>
		<script src="{{asset('assets/js/wizard.js')}}"></script>

	<!--Select2 js -->
		<script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>

		<!--MutipleSelect js-->
		<script src="{{asset('assets/plugins/multipleselect/multiple-select.js')}}"></script>
		<script src="{{asset('assets/plugins/multipleselect/multi-select.js')}}"></script>

		<!-- Inline js -->
        <script src="{{asset('assets/js/select2.js')}}"></script>

        {{-- TODO: esta se usara solamente para notificar que caduco la sesion y eso? --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/alertify.min.js"></script>

        @if(\Auth::User()->regdate==1)
            @php
                $dc = \Auth::User()->timestamp;
                $dv = \Auth::User()->previous_visit;
            @endphp
            <script>
                var dc = eval({{$dc}});
                var dv= eval({{$dv}});
                var cam=0.00;
                var cron=600;
                var pref=true;
                $(".pure").html(dc);
                $(".sale").html(dv);
                //timestamp dc
                //previous_visit dv
                //regdate 1,0
            </script>
        @else
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
                                let img = "{{asset('assets/images/tiempo.jpg')}}";
                                alertify.alert('', '<img src="'+ img +'">', function(){
                                    alertify.success('Ok');
                                    location.reload();
                                });
                                clearInterval(intervalo);
                            });
                        }else{
                            cron-=1;
                            var tim=parseInt(cron/60)+":"+(cron%60);
                            $('.cronometro').html(tim);
                        }
                    }
                    var intervalo = setInterval(tipocambio, 1000);
                });
            </script>
        @endif

        <script>
            $('.vouchers').on('change',function(e){
                //get the file name
                var fileName = e.target.files[0].name;
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
        </script>

        <script>
            var cant_vouchers = 1;
            $('#mas_vouchers').on('click',function(e){

                if(cant_vouchers < 4){
                    cant_vouchers += 1;

                    $('#div_vou_'+cant_vouchers).removeClass('d-none');
                }
                else{
                    alertify.set('notifier','position', 'top-right');
                    alertify.error("No se permite subir mas de 4 vouchers");
                }
            })
        </script>

        <script>
            function numberFormat(numero){
                // Variable que contendra el resultado final
                var resultado = "";

                // Si el numero empieza por el valor "-" (numero negativo)
                if(numero[0]=="-")
                {
                    // Cogemos el numero eliminando los posibles puntos que tenga, y sin
                    // el signo negativo
                    nuevoNumero=numero.replace(/\,/g,'').substring(1);
                }else{
                    // Cogemos el numero eliminando los posibles puntos que tenga
                    nuevoNumero=numero.replace(/\,/g,'');
                }

                // Si tiene decimales, se los quitamos al numero
                if(numero.indexOf(".")>=0)
                    nuevoNumero=nuevoNumero.substring(0,nuevoNumero.indexOf("."));

                // Ponemos un punto cada 3 caracteres
                for (var j, i = nuevoNumero.length - 1, j = 0; i >= 0; i--, j++)
                    resultado = nuevoNumero.charAt(i) + ((j > 0) && (j % 3 == 0)? ",": "") + resultado;

                // Si tiene decimales, se lo añadimos al numero una vez forateado con
                // los separadores de miles
                if(numero.indexOf(".")>=0)
                    resultado+=numero.substring(numero.indexOf("."));

                if(numero[0]=="-")
                {
                    // Devolvemos el valor añadiendo al inicio el signo negativo
                    return "-"+resultado;
                }else{
                    return resultado;
                }
            }
        </script>

        <script type="text/javascript">
            $( document ).ready(function() {
                //Si es una pantalla chiquita, pero no de celular, pongo para que el menu no se alinee al centro y le saco un poco de padding.
                if(window.matchMedia("(min-width:100px) and (max-width: 500px)").matches){
                    $('#side-app').removeClass("side-app");
                    $("#card-body-x").removeClass("card-body");
                }
                else{
                    if(!$('#side-app').hasClass("side-app")){
                        $('#side-app').addClass("side-app");
                    }
                    if(!$('#card-body-x').hasClass("card-body")){
                        $("#card-body-x").removeClass("card-body");
                    }
                }
            });
        </script>

        <script>
            var bancoCliente = @php echo $ban @endphp;
            var bancoSolesCliente = bancoCliente.filter(cuenta => cuenta.moneda.moneda_id==1);
            var bancoDolaresCliente = bancoCliente.filter(cuenta => cuenta.moneda.moneda_id==2);

            $("#banco-envio").on('change', function(){
                let tipo_moneda_envio = $(this).find(':selected').attr('data-tipo_moneda');

                $("#banco-recibo option").remove();
                $("#banco-recibo").append('<option></option>');
                // IF: Envia soles -> recibe dolares. ELSE: Envia dolares -> recibe soles.
                if(tipo_moneda_envio == 1){
                    bancoDolaresCliente.forEach(cuenta => $("#banco-recibo").append('<option value="' + cuenta.cuentabancaria_id + '" data-tipo_moneda="'+cuenta.moneda.moneda_id + '">' + cuenta.banco.nombre +' | ' + cuenta.moneda.nombre+' | '+ cuenta.nrocuenta + (cuenta.nrocuentacci ? ' | CCI - ' + cuenta.nrocuentacci : '') + '</option>'));
                }
                else if(tipo_moneda_envio == 2){
                    bancoSolesCliente.forEach(cuenta => $("#banco-recibo").append('<option value="' + cuenta.cuentabancaria_id + '" data-tipo_moneda="' + cuenta.moneda.moneda_id + '">' + cuenta.banco.nombre + ' | ' + cuenta.moneda.nombre+' | '+ cuenta.nrocuenta + (cuenta.nrocuentacci ? ' | CCI - ' + cuenta.nrocuentacci : '') + '</option>'));
                }

                Calcular();

                if (tipo_moneda_envio == 1 ){
                    $('#div-discount-codes').removeClass('d-none');
                }
                else if(tipo_moneda_envio == 2){
                    $('#div-discount-codes').addClass('d-none');
                }
            });
        </script>

        <script>
            var discountCodes = @php echo $discountCodes @endphp;
            $('#discount_code').on('change', function() {
                if ($(this).val() == null || $(this).val() == "") {
                    $('#monto_con_descuento').val("");
                    $("#btra").html("$");
                    $("#btra").append(numberFormat((parseFloat($('#monto').val().replace(/,/g, ''))).toString()));
                    return;
                }

                let discountCodeFound = discountCodes.findIndex(dc => dc.code == $(this).val());

                if (discountCodeFound == -1) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.error("Código de descuento no encontrado");

                    $('#monto_con_descuento').val("");
                    $("#btra").html("$");
                    $("#btra").append(numberFormat((parseFloat($('#monto').val().replace(/,/g, ''))).toString()));
                    return;
                }

                let discountAmount = discountCodes[discountCodeFound].discount;

                let montoAux = parseFloat($('#monto').val().replace(/,/g, ''));
                let montoAuxFormatted =  numberFormat((montoAux - discountAmount).toString());

                $("#btra").html("S/");
                $("#btra").append(montoAuxFormatted);

                $('#monto_con_descuento').val(montoAux - discountAmount);
                alertify.set('notifier','position', 'top-right');
                alertify.success("Código de descuento aplicado! Has ahorrado: S/" + discountAmount + " Soles");
            });

            function Calcular(){
                $('#monto').val( numberFormat($("#monto").val()) );

                var m_aux = $('#monto').val();
                var m=parseFloat($('#monto').val().replace(/,/g, ''));
                var d=$("#banco-envio").find(':selected').attr('data-tipo_moneda');
                if(d==2){
                    if(!pref && eval(m)>=eval(10000)){
                        $("#alerta").css("visibility","visible");
                    }
                    $("#bar option").remove();
                    $("#bar").append('<option></option>');
                    bd.forEach(cuenta=>$("#bar").append('<option value="'+cuenta.cuentabancaria_id+'">-'+cuenta.tipo.nombre+' | '+cuenta.moneda.nombre+' | '+cuenta.banco.nombre+'- '+cuenta.nrocuenta+'| CCI: '+cuenta.nrocuentacci+'</option>'));
                    cam=(eval(m)*eval(dc)).toFixed(2);
                    $("#reci").html( "S/" );
                    $("#reci").append( numberFormat(cam) );
                    $("#dine").html("Soles");
                    $("#cambio").val(cam);
                    $("#compra").val(dc);
                    $("#tcus").html(dc);
                    $("#atra").html("S/");
                    $("#atra").append(numberFormat(cam));
                    $("#amon").html("Soles");
                    $("#btra").html("$");
                    $("#btra").append(m_aux);
                    $("#bmon").html("Dólares");
                    $("#moe").val(2);
                    $("#mor").val(1);
                }else{
                    $("#bar option").remove();
                    $("#bar").append('<option></option>');
                    bs.forEach(cuenta=>$("#bar").append('<option value="'+cuenta.cuentabancaria_id+'">-'+cuenta.tipo.nombre+' | '+cuenta.moneda.nombre+' | '+cuenta.banco.nombre+'- '+cuenta.nrocuenta+'| CCI: '+cuenta.nrocuentacci+'</option>'));
                    cam=(eval(m)/eval(dv)).toFixed(2);
                    $("#reci").html("$");
                    $("#reci").append( numberFormat(cam) );
                    $("#dine").html("Dólares");
                    $("#cambio").val(cam);
                    $("#tcus").html(dv);
                    $("#atra").html("$");
                    $("#atra").append(numberFormat(cam));
                    $("#amon").html("Dólares");
                    $("#btra").html("S/");
                    $("#btra").append(m_aux);
                    $("#bmon").html("Soles");
                    $("#compra").val(dv);
                    $("#moe").val(1);
                    $("#mor").val(2);
                }
                $("#tcse").empty();
                $("#ncse").empty();
                $('#discount_code').val("");
                $('#monto_con_descuento').val("");
            }
            var banco=<?php echo $cud ?>;
            banco = banco.filter(cuenta => cuenta.banco.is_active == 1);
            var bs=banco.filter(cuenta => cuenta.moneda.moneda_id==1);
            var bd=banco.filter(cuenta => cuenta.moneda.moneda_id==2);

            $(document).ready(function(){
                function selecte() {
                    var select=$("#bar").val();
                    var objeto = banco.find(function(element) {
                        if(element.cuentabancaria_id==select){
                            return element;
                        }else{
                            return false;
                        }
                    });
                    $("#tcse").html(objeto.banco.nombre+"- "+objeto.tipo.nombre+" "+objeto.moneda.nombre);
                    $("#ncse").html(objeto.nrocuenta + '| CCI: '+ objeto.nrocuentacci);
                }
                $("#bar").change(function(){
                    selecte();
                });
                selecte();
            });
            function valida(){
                if($("#monto").val()==""){
                    alertify.error("Ingresa el monto");
                }
                if($("#vou").val()==""){
                    alertify.error("Sube una captura del comprobante");
                }
            }
            $('#origen_fondo_id').on('change', function() {
                if ($(this).val() == 11) {
                    $('#origen_fondo_otro').removeClass('d-none');
                }
                else{
                    $('#origen_fondo_otro').addClass('d-none');
                }
            })
            $(document).on('submit', '#form', function (e) {
                if($("#bar option:selected").val() === "" ){
                    alertify.error("Debe seleccionar a que cuenta nos transfiere");
                    e.preventDefault();
                    return false;
                }
                if ($('#origen_fondo_id').val() == null || $('#origen_fondo_id').val() == "") {
                    alertify.set('notifier','position', 'top-right');
                    alertify.error("Debe seleccionar el origen de los fondos");
                    e.preventDefault();
                    return;
                }
                if ($('#origen_fondo_id').val() == 11 && ($('#origen_fondo_otro_input').val() == null || $('#origen_fondo_otro_input').val() == "")) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.error("Debe ingresar el origen de los fondos");
                    e.preventDefault();
                    return;
                }

                $('#monto').val( parseFloat($('#monto').val().replace(/,/g, '')) );
                if ($('#monto').val() <= 0) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.error("Debe ingresar un monto válido");
                    e.preventDefault();
                    return false;
                }

                var input = ($("#vou"))[0];
                var file = input.files[0];
                var zz=eval(cam)<1;
                var yy=eval(file.size>8000000);
                if(zz){
                    alertify.error("Aplique la taza de Cambio");
                    e.preventDefault();
                }
                if(yy){
                    $("#imagen").css("visibility","visible");
                    alertify.error("Error al cargar archivo");
                    e.preventDefault();
                }
                if(!zz&&!yy){
                    $("#global-loader").show();
                }
            });
        </script>
@endsection
