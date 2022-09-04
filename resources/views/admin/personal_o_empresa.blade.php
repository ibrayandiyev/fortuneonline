@php
    $pas=\App\Modelo\Pais::all();
    $doc=\App\Modelo\Tiposdocumento::all();
    $ocs=\App\Modelo\Ocupacion::all();
@endphp

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registro Fortune Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- LINEARICONS -->
    <link rel="stylesheet" href="{{ asset('assets/registro_persona_o_empresa/fonts/linearicons/style.css') }}">

    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet" href="{{ asset('assets/registro_persona_o_empresa/fonts/material-design-iconic-font/css/material-design-iconic-font.css') }}">

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="{{ asset('assets/registro_persona_o_empresa/css/style.css') }}">

    <!-- Plugin -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/css/alertify.min.css">
</head>

<body>
    <div class="wrapper" style="overflow: auto;">
        <div class="inner">
            <div class="image-holder">
                <img src="{{ asset('assets/registro_persona_o_empresa/images/form-wizard.jpg') }}" alt="">
                <h3>
                    <center><img src="{{ asset('assets/registro_persona_o_empresa/images/logo-white_b.png') }}">REGISTRO</center>
                </h3>
            </div>
            <form action="" method="POST" id="saveUserForm" enctype="multipart/form-data">
                @csrf
                <div id="wizard">
                    <!-- SECTION 1 -->
                    <h4>Tipo de perfil</h4>
                    <section>
                        <div class="form-row">
                            <div class="form-holder">
                                <div class="card shadow-sm" style="border: solid 1px white; border-radius: 5px; padding: 2px;">
                                    <div class="card-body">
                                        <h5 class="card-title txtazul">REGISTRO PERSONA NATURAL</h5>
                                        <p class="card-text">Las cuentas bancarias deben ser a tu nombre.</p>
                                        <div style="text-align: center;">
                                            <a class="btn btn-primary" href="#" id="tipo_perfil_personal" style="padding: 2px; color: black">Seleccionar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-holder">
                                <div class="card shadow-sm" style="border: solid 1px white; border-radius: 5px; padding: 2px;">
                                    <div class="card-body">
                                        <h5 class="card-title txtazul">REGISTRO EMPRESA</h5>
                                        <p class="card-text">Las cuentas bancarias deben ser a nombre de la empresa</p>
                                        <div style="text-align: center;">
                                            <a class="btn btn-primary" href="#" id="tipo_perfil_empresa" style="padding: 2px; color: black">Seleccionar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="forward">
                            Siguiente
                            <i class="zmdi zmdi-long-arrow-right"></i>
                        </button>
                    </section>

                    <!-- SECTION 2 -->
                    <h4></h4>
                    <section class="section-style"></section>

                    <!-- SECTION 3 -->
                    <h4></h4>
                    <section></section>

                    <!-- SECTION 4 -->
                    <h4></h4>
                    <section></section>

                    <!-- SECTION 5 FOR ONLY COMPANY -->
                    <h4></h4>
                    <section></section>

                    <!-- SECTION 6 -->
                    <h4></h4>
                    <section class="section-style">
                    </section>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/registro_persona_o_empresa/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/registro_persona_o_empresa/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('assets/registro_persona_o_empresa/js/main.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/alertify.min.js"></script>

    <script>
        let personal = false;
        let empresa = false;
        let alreadyExists = false;
        $(document).ready(function() {
            $("#tipo_perfil_personal").click();
        });

        // PERFIL PERSONAL
        $("body").on('click', '#tipo_perfil_personal', function(){
            personal = true;
            empresa = false;
            $(this).parent().parent().parent().css('border-color', '#ffffff');
            $("#tipo_perfil_empresa").parent().parent().parent().css('border-color', 'transparent');

            $("#saveUserForm").attr('action', "{{ route('susuario') }}");

            $("#wizard-t-1").html('<span class="number">2.</span> Datos');
            $("#wizard-t-2").html('<span class="number">3.</span> Domicilio');
            $("#wizard-t-3").html('<span class="number">4.</span> Ocupación');
            $("#wizard-t-4").html('<span class="number">5.</span> Términos y condiciones');
            $("#wizard-t-5").parent('li').hide();

            let solapa_datos = crearSolapaDatos_usuario();
            $("#wizard-p-1").empty();
            $("#wizard-p-1").html(solapa_datos);

            //Consulto departamentos, provincias y distritos llamando a ese get y despues las funciones en cadena.
            getDepartamentos();

            let solapa_domicilio = crearSolapaDomicilio_usuario();
            $("#wizard-p-2").empty();
            $("#wizard-p-2").html(solapa_domicilio);

            let solapa_ocupacion = crearSolapaOcupacion_usuario();
            $("#wizard-p-3").empty();
            $("#wizard-p-3").html(solapa_ocupacion);

            let solapa_terminosCondiciones = crearSolapaTerminosCondiciones();
            $("#wizard-p-4").empty();
            $("#wizard-p-4").html(solapa_terminosCondiciones);

            $("#wizard-p-5").hide().empty();
        });

        // PERFIL EMPRESA
        $("body").on('click', '#tipo_perfil_empresa', function(){
            empresa = true;
            personal = false;
            $(this).parent().parent().parent().css('border-color', '#ffffff');
            $("#tipo_perfil_personal").parent().parent().parent().css('border-color', 'transparent');

            $("#saveUserForm").attr('action', "{{route('susuario_empresa')}}");

            $("#wizard-t-1").html('<span class="number">2.</span> Datos');
            $("#wizard-t-2").html('<span class="number">3.</span> Legal');
            $("#wizard-t-3").html('<span class="number">4.</span> Contacto');
            $("#wizard-t-4").html('<span class="number">5.</span> Información beneficiarios finales');
            $("#wizard-t-5").html('<span class="number">6.</span> Términos y condiciones');
            $("#wizard-t-5").parent('li').show();

            let solapa_datos = crearSolapaDatos_empresa();
            $("#wizard-p-1").empty();
            $("#wizard-p-1").html(solapa_datos);

            getDepartamentos();

            let solapa_legal = crearSolapaLegal_empresa();
            $("#wizard-p-2").empty();
            $("#wizard-p-2").html(solapa_legal);

            let solapa_contacto = crearSolapaContacto_empresa();
            $("#wizard-p-3").empty();
            $("#wizard-p-3").html(solapa_contacto);


            let solapa_beneficiarios = crearSolapaInformacionBeneficiarios();
            $("#wizard-p-4").empty();
            $("#wizard-p-4").html(solapa_beneficiarios);
            $('#beneficiarios_questao_1_si, #beneficiarios_questao_2_no').on('change', function(e) {
                if (e.target.checked) {
                    reconfirmacionAlert();
                }

                if ($('input[name="no_participacion"]').is(':checked') === true) {
                    $('#beneficiarios_questao_1_required').hide();
                }
                if ($('input[name="more_participacion"]').is(':checked') === true) {
                    $('#beneficiarios_questao_2_required').hide();
                }
            });

            $('input[name="more_participacion"]').on('change', function(e) {
                if ($('input[name="more_participacion"]:checked').val() === 'si') {
                    $('input, select', '#beneficiario-form').attr('disabled', false);
                    $('#beneficiario-form').show();
                } else {
                    $('input, select', '#beneficiario-form').attr('disabled', true);
                    $('#beneficiario-form').hide();
                }
            });


            let solapa_terminosCondiciones = crearSolapaTerminosCondiciones();
            $("#wizard-p-5").empty();
            $("#wizard-p-5").html(solapa_terminosCondiciones);
        });

        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test( $email );
        }

        function isNumber(number){
            if (isNaN(number)) {
                return false;
            } else {
                return true;
            }
        }

        $("#terminos_y_condiciones").on('click', function(){
            $("#error-tyc").addClass('d-none');
        });

        $(document).on('change', 'input', function(e){
            $("#error-required").addClass('d-none');
        });

        $(document).on('change', '.persona-expuesta', function(e){
            if($('input[name=pe]:checked').val() == 1){
                //Expuesta
                var elem = document.getElementById('pe-fields');
                elem.style.display = "flex";
            }
            else{
                //No expuesta
                var elem = document.getElementById('pe-fields');
                elem.style.display = "none";
            }
        });

        $(document).on('change', '.persona-expuesta-fam', function(e){
            if($('input[name=exp_fam]:checked').val() == 1){
                //Expuesta
                var elem = document.getElementById('pe-fam-fields');
                elem.style.display = "block";
            }
            else{
                //No expuesta
                var elem = document.getElementById('pe-fam-fields');
                elem.style.display = "none";
            }
        });

        $(document).ready(function() {
            $('input').on('change', function() {
                $(this).attr('type') != "file" ? $(this).css('border-color', '#5d718e') : $(this).css('color', 'white');
            });

            $('select').on('change', function() {
                $(this).css('border-color', '#5d718e')
            });
        });

        function showUserExistsError() {
            alertify.set('notifier','position', 'top-right');
            alertify.error('El usuario ya esta registrado');
        }

        $("body").on('click', '#button-finish', function(e){
            if($("#terminos_y_condiciones").is(":checked")){
                $("#error-tyc").css('display', 'none');

                let inputError = false;
                $('.required-step2').each(function( index ) {
                    $(this).css('border-color', '#ced4da');
                    if($(this).hasClass('email')){
                        if( !validateEmail($(this).val())) {
                            $(this).css('border-color', 'red');
                            inputError = true;
                        }
                    }

                    if(!$(this).val()){
                        $(this).css('border-color', 'red');
                        inputError = true;
                    }
                });
                $('.required-step3').each(function( index ) {
                    $(this).css('border-color', '#ced4da');
                    if(!$(this).val()){
                        $(this).css('border-color', 'red');
                        inputError = true;
                    }
                });
                $('.required-step4').each(function( index ) {
                    $(this).css('border-color', '#ced4da');
                    if(!$(this).val()){
                        $(this).css('border-color', 'red');
                        inputError = true;
                    }
                });
                if(!inputError){
                    if (!alreadyExists) {
                        $("#saveUserForm").submit();
                    }
                    else {
                        showUserExistsError()
                    }
                }
                else{
                    $("#error-required").css('display', 'flex');
                }
            }
            else{
                $("#error-tyc").css('display', 'flex');
            }
        });

        function getDepartamentos(){
            $.get("{{url('api/departamento')}}",function(ls){
                for (var i =  0; i < ls.length; i++) {
                    $("#dep").append('<option value="'+ls[i].dDepartamento+'">'+ls[i].Descripcion+'</option>');
                }
                //DEJO SELECCIONADA LA OPCION DE LIMA
                $('#dep option[value="15"]').attr("selected", "selected");
                provincia($("#dep").val());
            });
        }

        function provincia(i) {
            $("#pro option").remove();
            $.get("{{url('api/provincia')}}/"+i,function(ls){
                for (var i =  0; i < ls.length; i++) {
                    $("#pro").append('<option value="'+ls[i].codProvincia+'">'+ls[i].Descripcion+'</option>');
                }
                //DEJO SELECCIONADA LA OPCION DE LIMA
                $('#pro option[value="0"]').attr("selected", "selected");
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
        $(document).on("change", "#dep", function() {
            provincia($("#dep").val());
        });
        $(document).on("change", "#pro", function() {
            distrito($("#dep").val(),$("#pro").val());
        });

        // CREACION DE STEPS
        // ===================================== Steps para empresa =====================================
        function crearSolapaDatos_empresa(){
            return '<div class="multisteps-form__content">\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Número de RUC<span class="required-mark">*</span></label>\
                                <input type="text" class="form-control required-step2 integer" name="nr" id="nr" placeholder="Número de RUC" required>\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Razón Social<span class="required-mark">*</span></label>\
                                <input type="text" class="form-control required-step2" name="rz" id="rz" placeholder="Razón Social">\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Giro del negocio<span class="required-mark">*</span></label>\
                                <input type="text" class="form-control required-step2" name="gn" id="gn" placeholder="Giro del negocio">\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Dirección<span class="required-mark">*</span></label>\
                                <input type="text" class="form-control required-step2" name="dirf" id="dirf" placeholder="Dirección">\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Ficha RUC<span class="required-mark">*</span></label>\
                                <div class="custom-file">\
                                    <input type="file" class="custom-file-input required-step2" id="ficha_ruc" name="ficha_ruc" accept="image/png, .jpeg, .jpg, image/gif, .pdf">\
                                </div>\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Nacionalidad<span class="required-mark">*</span></label>\
                                <select class="form-control select2 custom-select required-step2" data-placeholder="Elija uno" name="pad" id="select-countries">\
                                    <option label="Elija uno">\
                                    </option>\
                                        @foreach ($pas as $pa)\
                                            <option value="{{ $pa->pais_id }}">{{ $pa->nombre }}</option>\
                                        @endforeach\
                                </select>\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Departamento</label>\
                                <select class="form-control select2 custom-select" name="dep" id="dep" data-placeholder="Elija uno"></select>\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Provincia</label>\
                                <select class="form-control select2 custom-select" name="pro" id="pro" data-placeholder="Elija uno"></select>\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Distrito</label>\
                                <select class="form-control select2 custom-select" name="dis" id="dis" data-placeholder="Elija uno"></select>\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Correo Electrónico<span class="required-mark">*</span></label>\
                                <input type="text" class="form-control required-step2 email" name="correo" id="correo" maxlength="35" placeholder="Correo Electrónico">\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Teléfono<span class="required-mark">*</span></label>\
                                <input type="text" class="form-control required-step2" name="tel" maxlength="50" placeholder="Teléfono">\
                            </div>\
                        </div>\
                        <button type="button" class="forward validate">\
                            Siguiente\
                            <i class="zmdi zmdi-long-arrow-right"></i>\
                        </button>\
                    </div>';
        }

        function crearSolapaLegal_empresa(){
            return '<div class="multisteps-form__content">\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Tipo de documento</label>\
                                <select class="form-control select2 custom-select" name="td" data-placeholder="Elija uno">\
                                    @foreach($doc as $do)\
                                        <option value="{{$do->tiposdocumento_id}}">{{$do->nombre}}</option>\
                                    @endforeach\
                                </select>\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Número de documento</label>\
                                <input type="text" class="form-control required-step3" name="nd" id="nd" placeholder="Número de documento" required>\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Documento (frente)<span class="required-mark">*</span></label>\
                                <div class="custom-file">\
                                    <input type="file" class="custom-file-input required-step3" id="documento_frente" name="documento_frente" accept="image/png, .jpeg, .jpg, image/gif, .pdf">\
                                </div>\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Documento (dorso)<span class="required-mark">*</span></label>\
                                <div class="custom-file">\
                                    <input type="file" class="custom-file-input required-step3" id="documento_dorso" name="documento_dorso" accept="image/png, .jpeg, .jpg, image/gif, .pdf">\
                                </div>\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Primer nombre<span class="required-mark">*</span></label>\
                                <input type="text" class="form-control required-step3" name="pn" id="pn" placeholder="Primer nombre">\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Segundo nombre</label>\
                                <input type="text" class="form-control" name="sn" id="sn" placeholder="Segundo nombre">\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Primer Apellido<span class="required-mark">*</span></label>\
                                <input type="text" class="form-control required-step3" name="ap" id="ap" placeholder="Primer Apellido">\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Segundo Apellido</label>\
                                <input type="text" class="form-control" name="am" id="am" placeholder="Segundo Apellido">\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Ocupación</label>\
                                <select class="form-control select2 custom-select" name="oc" data-placeholder="Elija uno">\
                                    @foreach($ocs as $oc)\
                                        <option value="{{$oc->ocupacion_id}}">{{$oc->nombre}}</option>\
                                    @endforeach\
                                </select>\
                            </div>\
                        </div>\
                        <button type="button" class="forward validate">\
                            Siguiente\
                            <i class="zmdi zmdi-long-arrow-right"></i>\
                        </button>\
                    </div>';
        }

        function crearSolapaContacto_empresa(){
            return '<div class="multisteps-form__content">\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Tipo de documento</label>\
                                <select class="form-control select2 custom-select" name="tdc" data-placeholder="Elija uno">\
                                    @foreach ($doc as $do)\
                                        <option value="{{ $do->tiposdocumento_id }}">{{ $do->nombre }}</option>\
                                    @endforeach\
                                </select>\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Número de documento<span class="required-mark">*</span></label>\
                                <input type="text" class="form-control required-step4" name="ndc" id="ndc" placeholder="Número de documento">\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Primer nombre<span class="required-mark">*</span></label>\
                                <input type="text" class="form-control required-step4" name="pnc" id="pnc" placeholder="Primer nombre">\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Segundo nombre</label>\
                                <input type="text" class="form-control" name="snc" id="snc" placeholder="Segundo nombre">\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Primer Apellido<span class="required-mark">*</span></label>\
                                <input type="text" class="form-control required-step4" name="apc" id="apc" placeholder="Primer Apellido">\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Segundo Apellido</label>\
                                <input type="text" class="form-control" name="amc" id="amc" placeholder="Segundo Apellido">\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Télefono</label>\
                                <input type="text" class="form-control" name="telc" id="telc" maxlength="35" placeholder="Télefono" required>\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Ocupación</label>\
                                <select class="form-control select2 custom-select" name="oc_c" data-placeholder="Elija uno">\
                                    @foreach($ocs as $oc)\
                                        <option value="{{$oc->ocupacion_id}}">{{$oc->nombre}}</option>\
                                    @endforeach\
                                </select>\
                            </div>\
                        </div>\
                        <button type="button" class="forward validate">\
                            Siguiente\
                            <i class="zmdi zmdi-long-arrow-right"></i>\
                        </button>\
                    </div>';
        }

        function crearSolapaInformacionBeneficiarios() {
            return '<div class="multisteps-form__content">\
                        <div class="form-row" style="margin-bottom: 17px;">\
                            <label class="form-label"><b>1.</b>&nbsp;&nbsp;&nbsp;¿Es usted el único beneficiario final con el 100% de participación, es decir no existe participación de otras personas en la empresa?</label>\
                        </div>\
                        <div class="form-row" style="display: block">\
                            <div class="form-holder" style="display: flex;">\
                                <label class="custom-control custom-radio" style="margin-right:1.3rem">\
                                    <input type="radio" class="custom-control-input" name="no_participacion" id="beneficiarios_questao_1_si" value="si">\
                                    <span class="custom-control-label">Si</span>\
                                </label>\
                                <label class="custom-control custom-radio">\
                                    <input type="radio" class="custom-control-input" name="no_participacion" value="no">\
                                    <span class="custom-control-label">No</span>\
                                </label>\
                            </div>\
                            <div id="beneficiarios_questao_1_required" style="display: none"><span style="color: #f3e105">O campo é obrigatório.</span></div>\
                        </div>\
                        <div class="form-row" style="margin-bottom: 17px;">\
                            <label class="form-label"><b>2.</b>&nbsp;&nbsp;&nbsp;¿Existen beneficiarios finales o encargados del control de la empresa con más del 25% de participación?</label>\
                        </div>\
                        <div class="form-row" style="display: block;">\
                            <div class="form-holder" style="display: flex;">\
                                <label class="custom-control custom-radio" style="margin-right:1.3rem">\
                                    <input type="radio" class="custom-control-input" name="more_participacion" id="beneficiarios_questao_2_si" value="si">\
                                    <span class="custom-control-label">Si</span>\
                                </label>\
                                <label class="custom-control custom-radio">\
                                    <input type="radio" class="custom-control-input" name="more_participacion" id="beneficiarios_questao_2_no" value="no">\
                                    <span class="custom-control-label">No</span>\
                                </label>\
                            </div>\
                            <div id="beneficiarios_questao_2_required" style="display: none"><span style="color: #f3e105">O campo é obrigatório.</span></div>\
                        </div>\
                        <div id="beneficiario-form" style="display: none">\
                            <div class="beneficiario-form-top">\
                                <h5>NOTA LEGAL EN ESTA SECCIÓN ES OBLIGATORIA:</h5>\
                                <h5>INFORMACION de BENEFICIARIOS FINALES</h5>\
                                <p>La Resolución Nº SBS 789-2018, en el capítulo III, Artículo 14 y 16 solicita identificar los beneficiarios finales o encargados del control de la empresa con más de 25% de participación.</p>\
                            </div>\
                            <h5 style="background-color: #81acee;color: #000;">Accionista, Socio o asociado (SOLO PARA 4 ACCIONISTAS – 25% CADA UNO)</h5>\
                            <div id="beneficiario-form-content">\
                                <div class="beneficiario-row js-beneficiario-row">\
                                    <div class="form-row mt-4">\
                                        <div class="form-holder w-full">\
                                            <label class="form-label">Nombre completo</label>\
                                            <input type="text" class="form-control required-step5 w-full" name="beneficiario_nombre[]" placeholder="Escreva nombre completo" required>\
                                        </div>\
                                    </div>\
                                    <div class="form-row mt-4">\
                                        <div class="form-holder">\
                                            <label class="form-label">Tipo de documento</label>\
                                            <select class="form-control select2 custom-select required-step5" name="beneficiario_documento_tipo[]" data-placeholder="Elija uno" required>\
                                                @foreach ($doc as $do)\
                                                    <option value="{{ $do->tiposdocumento_id }}">{{ $do->nombre }}</option>\
                                                @endforeach\
                                            </select>\
                                        </div>\
                                        <div class="form-holder">\
                                            <label class="form-label">Número de documento</label>\
                                            <input type="number" class="form-control required-step5" name="beneficiario_documento_numero[]" placeholder="Número de documento" required>\
                                        </div>\
                                    </div>\
                                    <div class="form-row mt-4">\
                                        <div class="form-holder">\
                                            <label class="form-label">Nacionalidad</label>\
                                            <select class="form-control select2 custom-select required-step5" data-placeholder="Elija uno" name="beneficiario_nacionalidad[]" required>\
                                                <option label="Elija uno">\
                                                </option>\
                                                @foreach ($pas as $pa)\
                                                    <option value="{{ $pa->pais_id }}">{{ $pa->nombre }}</option>\
                                                @endforeach\
                                            </select>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>\
                            <div style="margin-top: .27rem">\
                                <button type="button" class="beneficiario-remove-btn js-beneficiario-remove-btn" onclick="retirarBeneficiario()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">\
                                        <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z"/>\
                                    </svg>\
                                </button>\
                                <button type="button" class="beneficiario-add-btn js-beneficiario-add-btn" onclick="agregarBeneficiario()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">\
                                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>\
                                    </svg>\
                                </button>\
                            </div>\
                        </div>\
                        <button type="button" class="forward validate">Siguiente<i class="zmdi zmdi-long-arrow-right"></i></button>\
                    </div>';
        }


        // ================================================================================================


        // ===================================== Steps para usuario =====================================
        function crearSolapaDatos_usuario(){
            return '<div class="multisteps-form__content">\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Tipo de documento</label>\
                                <select class="form-control select2 custom-select required-step2" name="td" data-placeholder="Elija uno">\
                                    @foreach($doc as $do)\
                                        <option value="{{$do->tiposdocumento_id}}">{{$do->nombre}}</option>\
                                    @endforeach\
                                </select>\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Número de documento</label>\
                                <input type="text" class="form-control required-step2" name="nd" id="nd" placeholder="Número de documento">\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Documento (frente)</label>\
                                <div class="custom-file">\
                                    <input type="file" class="custom-file-input required-step2" id="documento_frente" name="documento_frente" accept="image/png, .jpeg, .jpg, image/gif, .pdf">\
                                </div>\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Documento (dorso)</label>\
                                <div class="custom-file">\
                                    <input type="file" class="custom-file-input required-step2" id="documento_dorso" name="documento_dorso" accept="image/png, .jpeg, .jpg, image/gif, .pdf">\
                                </div>\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Primer nombre</label>\
                                <input type="text" class="form-control required-step2" name="pn" id="pn" placeholder="Primer nombre">\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Segundo nombre</label>\
                                <input type="text" class="form-control" name="sn" id="sn" placeholder="Segundo nombre">\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Primer Apellido</label>\
                                <input type="text" class="form-control required-step2" name="ap" id="ap" placeholder="Primer Apellido">\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Segundo Apellido</label>\
                                <input type="text" class="form-control" name="am" id="am" placeholder="Segundo Apellido">\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Fecha de nacimiento</label>\
                                <input type="date" class="form-control" name="fn" id="fn" value="{{date('Y-m-d')}}">\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Teléfono</label>\
                                <input type="text" class="form-control" name="cel" id="cel" placeholder="Teléfono">\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Celular</label>\
                                <input type="text" class="form-control" name="cel1" id="cel1" placeholder="Celular">\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Otro celular</label>\
                                <input type="text" class="form-control" name="cel2" id="cel2" placeholder="Otro celular">\
                            </div>\
                        </div>\
                        <button type="button" class="forward validate">\
                            Siguiente\
                            <i class="zmdi zmdi-long-arrow-right"></i>\
                        </button>\
                    </div>';
        }

        function crearSolapaDomicilio_usuario(){
            return '<div class="multisteps-form__content">\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Nacionalidad</label>\
                                <select class="form-control select2 custom-select required-step3" data-placeholder="Elija uno" name="pa" id="select-countries">\
                                    <option label="Elija uno">\
                                    </option>\
                                        @foreach($pas as $pa)\
                                            <option value="{{$pa->pais_id}}">{{$pa->nombre}}</option>\
                                        @endforeach\
                                </select>\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Departamento</label>\
                                <select class="form-control select2 custom-select" name="dep" id="dep" data-placeholder="Elija uno"></select>\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Provincia</label>\
                                <select class="form-control select2 custom-select" name="pro" id="pro" data-placeholder="Elija uno"></select>\
                            </div>\
                            <div class="form-holder">\
                            <label class="form-label">Distrito</label>\
                                <select class="form-control select2 custom-select" name="dis" id="dis" data-placeholder="Elija uno"></select>\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Dirección</label>\
                                <input type="text" class="form-control required-step3" name="dir" id="dir" placeholder="Dirección">\
                            </div>\
                        </div>\
                        <button type="button" class="forward validate">\
                            Siguiente\
                            <i class="zmdi zmdi-long-arrow-right"></i>\
                        </button>\
                    </div>';
        }

        function crearSolapaOcupacion_usuario(){
            return '<div class="multisteps-form__content">\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="form-label">Ocupación</label>\
                                <select class="form-control select2 custom-select" name="oc" data-placeholder="Elija uno">\
                                    @foreach($ocs as $oc)\
                                        <option value="{{$oc->ocupacion_id}}">{{$oc->nombre}}</option>\
                                    @endforeach\
                                </select>\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder mt-3">\
                                <label class="form-label">Confirme por favor si usted es una persona políticamente expuesta.</label>\
                            </div>\
                            <div class="form-holder">\
                                <label class="custom-control custom-radio">\
                                    <input required type="radio" class="custom-control-input required persona-expuesta" name="pe" value="1" checked>\
                                    <span class="custom-control-label">Si SOY</span>\
                                </label>\
                                <label class="custom-control custom-radio">\
                                    <input required type="radio" class="custom-control-input required persona-expuesta" name="pe" value="0">\
                                    <span class="custom-control-label">NO SOY</span>\
                                </label>\
                            </div>\
                        </div>\
                        <div class="form-row mt-4" id="pe-fields">\
                            <div class="form-holder">\
                                <label class="form-label">Cargo</label>\
                                <input type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo">\
                            </div>\
                            <div class="form-holder">\
                                <label class="form-label">Lugar de trabajo</label>\
                                <input type="text" class="form-control" name="lugar_de_trabajo" id="lugar_de_trabajo" placeholder="Lugar de trabajo">\
                            </div>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder mt-3">\
                                <label class="form-label">Confirme por favor si usted tiene familiar hasta tercer grado políticamente expuesta.</label>\
                            </div>\
                            <div class="form-holder">\
                                <label class="custom-control custom-radio">\
                                    <input required type="radio" class="custom-control-input required persona-expuesta-fam" name="exp_fam" value="1" checked>\
                                    <span class="custom-control-label">Si</span>\
                                </label>\
                                <label class="custom-control custom-radio">\
                                    <input required type="radio" class="custom-control-input required persona-expuesta-fam" name="exp_fam" value="0">\
                                    <span class="custom-control-label">No</span>\
                                </label>\
                            </div>\
                        </div>\
                        <div id="pe-fam-fields">\
                            <div class="form-row mt-4">\
                                <div class="form-holder">\
                                    <label class="form-label">Tipo de documento</label>\
                                    <select class="form-control select2 custom-select" name="tipo_doc_fam" data-placeholder="Elija uno">\
                                        @foreach($doc as $do)\
                                            <option value="{{$do->tiposdocumento_id}}">{{$do->nombre}}</option>\
                                        @endforeach\
                                    </select>\
                                </div>\
                                <div class="form-holder">\
                                    <label class="form-label">Número de documento</label>\
                                    <input type="text" class="form-control" name="num_doc_fam" id="num_doc_fam" placeholder="Número de documento">\
                                </div>\
                            </div>\
                            <div class="form-row mt-4">\
                                <div class="form-holder">\
                                    <label class="form-label">Nombre/s</label>\
                                    <input type="text" class="form-control" name="nombre_fam" id="nombre_fam" placeholder="Nombre/s">\
                                </div>\
                                <div class="form-holder">\
                                    <label class="form-label">Apellido/s</label>\
                                    <input type="text" class="form-control" name="apellido_fam" id="apellido_fam" placeholder="Apellido/s">\
                                </div>\
                            </div>\
                            <div class="form-row mt-4">\
                                <div class="form-holder">\
                                    <label class="form-label">Cargo</label>\
                                    <input type="text" class="form-control" name="cargo_fam" id="cargo_fam" placeholder="Cargo">\
                                </div>\
                                <div class="form-holder">\
                                    <label class="form-label">Lugar de trabajo</label>\
                                    <input type="text" class="form-control" name="lugar_de_trabajo_fam" id="lugar_de_trabajo_fam" placeholder="Lugar de trabajo">\
                                </div>\
                            </div>\
                        </div>\
                        <button type="button" class="forward validate">\
                            Siguiente\
                            <i class="zmdi zmdi-long-arrow-right"></i>\
                        </button>\
                    </div>';
        }


        // ====================================================================================================
        function crearSolapaTerminosCondiciones(){
            return '<div class="multisteps-form__content">\
                        <div class="form-row mt-4">\
                            <label class="form-label"><strong><a href="https://www.fortuneonline.com.pe/terminos-y-condiciones/">Leer términos y condiciones aquí</a></strong>.<br> Si elije SI, esta aceptando todas nuestras póliticas y términos</label>\
                        </div>\
                        <div class="form-row mt-4">\
                            <div class="form-holder">\
                                <label class="custom-control custom-radio">\
                                    <input type="radio" class="custom-control-input" name="tyc" checked>\
                                    <span class="custom-control-label">No</span>\
                                </label>\
                                <label class="custom-control custom-radio">\
                                    <input type="radio" class="custom-control-input" name="tyc" id="terminos_y_condiciones">\
                                    <span class="custom-control-label">Si</span>\
                                </label>\
                            </div>\
                        </div>\
                        <div class="form-row" id="error-required" style="display: none;">\
                            <div class="form-holder">\
                                <label class="form-label" style="color: #77c258">*Debe rellenar campos obligatorios en pasos anteriores</label>\
                            </div>\
                        </div>\
                        <div class="form-row" id="error-tyc" style="display: none;">\
                            <div class="form-holder">\
                                <label class="form-label" style="color: #77c258">*Debe aceptar los términos y condiciones</label>\
                            </div>\
                        </div>\
                        <button type="button" style="width: 195px; margin-top: 45px;" id="button-finish">\
                            Finalizar\
                            <i class="zmdi zmdi-long-arrow-right"></i>\
                        </button>\
                    </div>';
        }

        // $(function() {
        //     $('#beneficiarios_questao_1_si, #beneficiarios_questao_2_no').on('change', function(e) {
        //         if (e.target.checked) {
        //             reconfirmacionAlert();
        //         }
        //     });
        // })

        // Reconfirmation alert
        function reconfirmacionAlert() {
            swal({
                title: "",
                text: 'Mensaje para confirmar la acción de las preguntas anteriores. Entonces usted, reconfirma que no existen beneficiarios finales o encargados del control de la empresa con más de 25% de participación?',
                html: true,
                confirmButtonColor: "#77c258",
                confirmButtonText: "Si, confirmo"
            });
        }

        function agregarBeneficiario() {
            var beneficiarioHtml = '<div class="beneficiario-row js-beneficiario-row">\
                                        <div class="form-row mt-4">\
                                            <div class="form-holder w-full">\
                                                <label class="form-label">Nombre completo</label>\
                                                <input type="text" class="form-control required-step3 w-full" name="beneficiario_nombre[]" placeholder="Escreva nombre completo" required>\
                                            </div>\
                                        </div>\
                                        <div class="form-row mt-4">\
                                            <div class="form-holder">\
                                                <label class="form-label">Tipo de documento</label>\
                                                <select class="form-control select2 custom-select" name="beneficiario_documento_tipo[]" data-placeholder="Elija uno" required>\
                                                    @foreach ($doc as $do)\
                                                        <option value="{{ $do->tiposdocumento_id }}">{{ $do->nombre }}</option>\
                                                    @endforeach\
                                                </select>\
                                            </div>\
                                            <div class="form-holder">\
                                                <label class="form-label">Número de documento</label>\
                                                <input type="number" class="form-control required-step3" name="beneficiario_documento_numero[]" placeholder="Número de documento" required>\
                                            </div>\
                                        </div>\
                                        <div class="form-row mt-4">\
                                            <div class="form-holder">\
                                                <label class="form-label">Nacionalidad</label>\
                                                <select class="form-control select2 custom-select required-step3" data-placeholder="Elija uno" name="beneficiario_nacionalidad[]" required>\
                                                    <option label="Elija uno">\
                                                    </option>\
                                                    @foreach ($pas as $pa)\
                                                        <option value="{{ $pa->pais_id }}">{{ $pa->nombre }}</option>\
                                                    @endforeach\
                                                </select>\
                                            </div>\
                                        </div>\
                                    </div>';

            var count = $('#beneficiario-form-content .js-beneficiario-row').length;
            if (count < 4) {
                $('#beneficiario-form-content').append(beneficiarioHtml);
            }
            if (count === 3) {
                $('.js-beneficiario-add-btn').attr('disabled', 'disabled');
                $('.js-beneficiario-add-btn').css('cursor', 'not-allowed');
            }
            $('.js-beneficiario-remove-btn').css('cursor', 'pointer');
            $('.js-beneficiario-remove-btn').css('disabled', false);
        }

        function retirarBeneficiario() {
            var count = $('#beneficiario-form-content .js-beneficiario-row').length;
            if (count > 1)
                $('#beneficiario-form-content .js-beneficiario-row')[count - 1].remove();
            if (count === 2) {
                $('.js-beneficiario-remove-btn').css('cursor', 'not-allowed');
                $('.js-beneficiario-remove-btn').css('disabled', 'disabled');
            }
            $('.js-beneficiario-add-btn').attr('disabled', false);
            $('.js-beneficiario-add-btn').css('cursor', 'pointer');
        }
    </script>

    <script>
        $(document).on('change', '#documento_frente', function(){
            //get the file name
            var fileName = $(this).val().replace('C:\\fakepath\\', '');
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
        $(document).on('change', '#documento_dorso', function(){
            //get the file name
            var fileName = $(this).val().replace('C:\\fakepath\\', '');
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
        $(document).on('change', '#ficha_ruc', function(){
            //get the file name
            var fileName = $(this).val().replace('C:\\fakepath\\', '');
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>

    <script>
        // Person & legal person data
        $(document).on('change', '#nd', function() {
            let userAlreadyExists = false;

            if (personal) {
                let url = "{{ route('user-already-exists', ":dni") }}";
                url = url.replace(":dni", $(this).val());

                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "JSON",
                    async: false,
                }).done(function( response ) {
                    userAlreadyExists = response['exists'];
                    alreadyExists = response['exists'];
                });
            }

            if (userAlreadyExists) {
                showUserExistsError()
                return;
            }

            let url = "{{ route('peru-consultas-query-dni', ":dni") }}";
            url = url.replace(":dni", $(this).val());

            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
            }).done(function( response ) {
                if (response['success']) {
                    names = response['data']['nombres'];
                    lastName1 = response['data']['apellidoPaterno'];
                    lastName2 = response['data']['apellidoMaterno'];

                    if (names != null && names != "") {
                        namesArray = names.split(" ");

                        if (namesArray[0] != null && namesArray[0] != "") {
                            $("#pn").val(namesArray[0]);
                        }
                        if (namesArray[1] != null && namesArray[1] != "") {
                            $("#sn").val(namesArray[1]);
                        }
                    }

                    if (lastName1 != null && lastName1 != "") {
                        $("#ap").val(lastName1);
                    }

                    if (lastName2 != null && lastName2 != "") {
                        $("#am").val(lastName2);
                    }
                }
            });
        });

        // Company data
        $(document).on('change', '#nr', function() {
            if (!empresa) {
                return;
            }

            let userAlreadyExists = false;

            let url = "{{ route('userempresa-already-exists', ":ruc") }}";
            url = url.replace(":ruc", $(this).val());

            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
                async: false,
            }).done(function( response ) {
                userAlreadyExists = response['exists'];
                alreadyExists = response['exists'];
            });

            if (userAlreadyExists) {
                showUserExistsError()
                return;
            }

            url = "{{ route('peru-consultas-query-ruc', ":ruc") }}";
            url = url.replace(":ruc", $(this).val());

            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
            }).done(function( response ) {
                if (response['success']) {
                    businessName = response['data']['razonSocial'];
                    businessTurn = response['data']['actEconomicas']
                    address = response['data']['direccion'];
                    department = response['data']['departamento'];
                    province = response['data']['provincia'];
                    district = response['data']['distrito'];

                    if (businessName != null && businessName != "") {
                        $("#rz").val(businessName);
                    }

                    if (businessTurn != null && businessTurn.length > 0) {
                        mainBusinessTurn = businessTurn[0].split(' - ');
                        if (mainBusinessTurn.length > 0 && mainBusinessTurn[2] != null) {
                            $("#gn").val(mainBusinessTurn[2]);
                        }
                    }

                    if (address != null && address != "") {
                        $("#dirf").val(address);
                    }

                    if (department != null && department != "") {
                        $("#dep option").filter(function() {
                            return $(this).text() == department;
                        }).prop("selected", true);

                        if (province != null && province != "") {
                            $("#pro option").filter(function() {
                                return $(this).text() == province;
                            }).prop("selected", true);

                            if (district != null && district != "") {
                                $("#dis option").filter(function() {
                                    return $(this).text() == district;
                                }).prop("selected", true);
                            }
                        }
                    }

                }
            });
        });

        // Contact person data
        $(document).on('change', '#ndc', function() {
            if (!empresa) {
                return;
            }

            let url = "{{ route('peru-consultas-query-dni', ":dni") }}";
            url = url.replace(":dni", $(this).val());

            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
            }).done(function( response ) {
                if (response['success']) {
                    names = response['data']['nombres'];
                    lastName1 = response['data']['apellidoPaterno'];
                    lastName2 = response['data']['apellidoMaterno'];

                    if (names != null && names != "") {
                        namesArray = names.split(" ");

                        if (namesArray[0] != null && namesArray[0] != "") {
                            $("#pnc").val(namesArray[0]);
                        }
                        if (namesArray[1] != null && namesArray[1] != "") {
                            $("#snc").val(namesArray[1]);
                        }
                    }

                    if (lastName1 != null && lastName1 != "") {
                        $("#apc").val(lastName1);
                    }

                    if (lastName2 != null && lastName2 != "") {
                        $("#amc").val(lastName2);
                    }
                }
            });
        });

        $(document).on('change', '#num_doc_fam', function() {
            let url = "{{ route('peru-consultas-query-dni', ":dni") }}";
            url = url.replace(":dni", $(this).val());

            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
            }).done(function( response ) {
                if (response['success']) {
                    $("#nombre_fam").val( response['data']['nombres']);
                    $("#apellido_fam").val( response['data']['apellidoPaterno'] + " " + response['data']['apellidoMaterno']);
                }
            });
        });
    </script>
</body>

</html>
