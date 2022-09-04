<?php
$pas=\App\Modelo\Pais::all();
$doc=\App\Modelo\Tiposdocumento::all();
$ocs=\App\Modelo\Ocupacion::all();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-TileColor" content="#0061da">
        <meta name="theme-color" content="#1643a3">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <link rel="icon" href="{{url('assets/images/brand/favicon.ico')}}" type="image/x-icon"/>
        <link rel="shortcut icon" type="image/x-icon" href="{{url('assets/images/brand/favicon.ico')}}" />
        <title>Fortune Online - Casa de cambio digital</title>
        <link rel="stylesheet" href="{{url('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
        <link href="{{url('assets/css/dashboard.css')}}" rel="stylesheet" />
        <link href="{{url('assets/plugins/iconfonts/plugin.css')}}" rel="stylesheet" />
        <link href="{{url('assets/plugins/fontawesome-free/css/all.css')}}" rel="stylesheet">
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
            .ajs-content{
                text-align: justify;
            }
            .label,.ajs-message{color: white;}
            .label-warning{background-color: #a98307;padding: 2px 4px;border-radius: 5px;}
            .label-primary{background-color: #2271b3;padding: 2px 4px;border-radius: 5px;}
            .label-success{background-color: #00bb2d;padding: 2px 4px;border-radius: 5px;}
            .label-danger{background-color: #dc3545;padding: 2px 4px;border-radius: 5px;}
        </style>
    </head>
    <body class="login-img custom-bg">
        <div id="global-loader"><img src="{{url('assets/images/loader.svg')}}" alt="cargando"></div>
        <div class="page">
            <div class="custompage">
                <div class="custom-content  mt-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    <img src="{{url('assets/images/brand/logo.png')}}" class="header-brand-img mb-2 mt-2 mt-lg-0 " alt="logo">
                                        Crear nueva cuenta - Personal
                                    </div>
                                    </div>
                                    <div class="card-body">
                                    <form id="form" method="post" action="{{url('susuario')}}">
                                    @csrf
                                    <div class="list-group">
                                    <div class="list-group-item py-3" data-acc-step>
                                    <h5 class="mb-0" data-acc-title>Documento de identidad</h5>
                                    <div data-acc-content>
                                    <div class="my-3">
                                    <div class="form-group ">

                                    <select class="form-control select2 custom-select" name="td" >
                                        @foreach($doc as $do)
                                        <option value="{{$do->tiposdocumento_id}}">{{$do->nombre}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Número de documento</label>
                                        <input required type="text" class="form-control" name="nd" id="nd" placeholder="número de documento">
                                    </div>
                                    <div class="form-group">
                                    <label class="form-label">País</label>
                                    <select name="pa" id="select-countries" class="form-control custom-select">
                                        @foreach($pas as $pa)
                                        <option value="{{$pa->pais_id}}">{{$pa->nombre}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="list-group-item py-3" data-acc-step>
                                    <h5 class="mb-0" data-acc-title>Datos Personales</h5>
                                    <div data-acc-content>

                                    <div class="my-3">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Primer nombre</label>
                                                <input required type="text" class="form-control" name="pn" id="pn" placeholder="Primer nombre">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Segundo nombre</label>
                                                <input type="text" class="form-control" name="sn" placeholder="Segundo nombre">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Primer Apellido</label>
                                                <input type="text" class="form-control" name="ap" placeholder="Primer apellido">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Segundo Apellido</label>
                                                <input type="text" class="form-control" name="am" placeholder="Segundo apellido">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Celular</label>
                                                <input type="text" class="form-control" name="cel1" id="cel1" maxlength="35"  placeholder="Número de Celular" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Celular 2</label>
                                                <input type="text" class="form-control" name="cel2" maxlength="50"  placeholder="Otro Número">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Teléfono</label>
                                                <input type="text" class="form-control" name="cel" maxlength="30"  placeholder="Teléfonos de contacto">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Fecha de Nacimiento</label>
                                                <div class="col-12">
                                                    <input required class="form-control" type="date" name="fn" value="{{date('Y-m-d')}}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="list-group-item py-3" data-acc-step>
                                    <h5 class="mb-0" data-acc-title>Datos Domiciliarios</h5>
                                    <div data-acc-content>
                                    <div class="my-3">

                                        <div class="row">

                                                <div class="form-group col-md-6">
                                                    <label class="form-label">País</label>
                                                    <select name="pad" id="select-countries" class="form-control custom-select">
                                                        @foreach($pas as $pa)
                                                        <option value="{{$pa->pais_id}}">{{$pa->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label">Departamento</label>
                                                    <select name="dep" class="form-control custom-select" id="dep"></select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label">Provincia</label>
                                                    <select name="pro" class="form-control custom-select" id="pro"></select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label">Distrito</label>
                                                    <select name="dis" class="form-control custom-select" id="dis"></select>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label class="form-label">Dirección</label>
                                                    <input required type="text" class="form-control" name="dir" id="dir" placeholder="Dirección">
                                                </div>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                        <div class="list-group-item py-3" data-acc-step>
                                            <h5 class="mb-0" data-acc-title>Ocupación</h5>
                                            <div data-acc-content>
                                                <div class="my-3">
                                                    <div class="form-group ">
                                                        <select class="form-control select2 custom-select" name="oc">
                                                            @foreach($ocs as $oc)
                                                            <option value="{{$oc->ocupacion_id}}">{{$oc->nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="form-label">Confirme por favor si usted es una persona políticamente expuesta.</div>
                                                        <div class="custom-controls-stacked">
                                                            <label class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input required" name="pe" value="1" checked>
                                                                <span class="custom-control-label">SI SOY</span>
                                                            </label>
                                                            <label class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input required" name="pe" value="0">
                                                                <span class="custom-control-label">NO SOY</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    {{--
                                        <div style="display: flex;margin-top: 20px; justify-content: space-around;">
                                            <label class="custom-control custom-radio">
                                                <a href="#" onclick="aviso()" class="btn btn-success">Hacerlo en otro momento</a>
                                            </label>
                                        </div>
                                    --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <script src="{{url('assets/js/vendors/jquery-3.2.1.min.js')}}"></script>
        <script src="{{url('assets/js/vendors/jquery.sparkline.min.js')}}"></script>
        <script src="{{url('assets/js/vendors/selectize.min.js')}}"></script>
        <script src="{{url('assets/js/vendors/jquery.tablesorter.min.js')}}"></script>
        <script src="{{url('assets/js/vendors/circle-progress.min.js')}}"></script>
        <script src="{{url('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
        <script src="{{url('assets/plugins/bootstrap/popper.min.js')}}"></script>
        <script src="{{url('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{url('assets/plugins/peitychart/jquery.peity.min.js')}}"></script>
        <script src="{{url('assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
        <script src="{{url('assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js')}}"></script>
        <script src="{{url('assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js')}}"></script>
        <script src="{{url('assets/js/wizard.js')}}"></script>
        <script src="{{url('assets/plugins/counters/counterup.min.js')}}"></script>
        <script src="{{url('assets/plugins/counters/waypoints.min.js')}}"></script>
        <script src="{{url('assets/js/custom.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/alertify.min.js"></script>
        <script>
            $(document).ready(function(){
                $.get("{{url('api/departamento')}}",function(ls){
                    for (var i =  0; i < ls.length; i++) {
                        $("#dep").append('<option value="'+ls[i].dDepartamento+'">'+ls[i].Descripcion+'</option>');
                    }
                    provincia($("#dep").val());
                });
                function provincia(i) {
                    $("#pro option").remove();
                    $.get("{{url('api/provincia')}}/"+i,function(ls){
                        for (var i =  0; i < ls.length; i++) {
                            $("#pro").append('<option value="'+ls[i].codProvincia+'">'+ls[i].Descripcion+'</option>');
                        }
                        distrito($("#dep").val(),$("#pro").val());
                    });
                }
                function distrito(i,j) {
                    $("#dis option").remove();
                    $.get("{{url('api/distrito')}}/"+i+"/"+j,function(ls){
                        for (var i =  0; i < ls.length; i++) {
                            $("#dis").append('<option value="'+ls[i].codDistrito+'">'+ls[i].Descripcion+'</option>');
                        }
                    });
                }
                $('#dep').on('change', function(){
                    provincia($("#dep").val());
                });
                $('#pro').on('change', function(){
                    distrito($("#dep").val(),$("#pro").val());
                });
            });
            $( document ).ready(function(){
                $("input[type=submit]").on('click',function(){
                    if(this.value=='Registrar'){
                        valida();
                    }
                });
            });
            function valida(){
                if($("#pn").val()==""){
                    alertify.error("Primer Nombre es Obligatorio");
                }
                if($("#cel1").val()==""){
                    alertify.error("Celular Obligatorio");
                }
                if($("#dir").val()==""){
                    alertify.error("Dirección Obligatorio");
                }
                if($("#nd").val()==""){
                    alertify.error("Numero de Documento es Obligatorio");
                }
            }
            function aviso() {
                alertify.confirm("Saltar Registro","<p>Por el momento solo tenemos tu Correo Electrónico, debes llenar todo el formulario para poder realizar alguna transaccion, no se te permitira realizar movimientos ni registrar ninguna cuenta.</p> <p>Y tampoco guardamos el avance del registro.</p> <h4><strong>¿Esta seguro de hacerlo en otro momento?</strong></h4>",
                    function(){
                        window.location="{{url('home')}}";
                    },
                    function(){
                        alertify.success("Por favor, Continua con el registro");
                    }
                );
            }
        </script>
    </body>
</html>
