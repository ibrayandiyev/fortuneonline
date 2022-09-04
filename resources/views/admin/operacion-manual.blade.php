@extends('layouts.app')

@push('css')
    <!-- select2 Plugin -->
    <link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/css/alertify.min.css')}}" rel="stylesheet">
@endpush

@push('titulo_completo')
    <h4 class="txtnaranja"> OPERACIÓN MANUAL</h4>@endpush
@push('titulo')
    Operación manual
@endpush


@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('guardar-operacion-manual') }}" method="POST" id="form-save-operation" enctype="multipart/form-data">
                        @csrf
                        <div class="row m-1">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label class="form-label">Usuario</label>
                                <select class="form-control" name="user_id" id="select-user" required style="width: 100%!important">
                                    <option value="">Seleccione el usuario</option>
                                    @foreach($users as $user)
                                        @if ($user->personal == 1)
                                            <option value="{{$user->usuario_id}}">{{isset($user->primernombre) ? $user->primernombre . ' ' : ''}}{{isset($user->segundonombre) ? $user->segundonombre . ' ' : ''}}{{isset($user->primeroapellido) ? $user->primeroapellido . ' ' : ''}}{{isset($user->segundoapellido) ? $user->segundoapellido . ' ' : ''}}</option>
                                        @else
                                            <option value="{{$user->usuario_id}}">{{isset($user->razon_social) ? $user->razon_social . ' ' : ''}}-{{isset($user->ruc) ? $user->ruc . ' ' : ''}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 text-left">
                                <label class="form-label">¿El usuario no existe?</label>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-new-user">
                                    Crear nuevo usuario
                                </button>
                            </div>
                        </div>

                        <div class="row m-1">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label class="form-label">Cuenta de envío</label>
                                <select class="form-control select2" name="cuenta_envio_id" id="select-account-send" required style="width: 100%!important">
                                    <option value="">Seleccione la cuenta de envio</option>
                                </select>
                            </div>

                            <input type="hidden" name="moneda_envia" id="coin-send" required>
                            <input type="hidden" name="moneda_recibe" id="coin-receive" required>

                            <div class="col-lg-6 col-md-6 col-sm-12 text-left">
                                <label class="form-label">¿La cuenta no existe?</label>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-new-account">
                                    Crear nueva cuenta
                                </button>
                            </div>
                        </div>

                        <div class="row m-1">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label class="form-label">Cuenta de deposito</label>
                                <select class="form-control select2" name="cuenta_deposito_id" id="select-account-to-deposit" required style="width: 100%!important">
                                    <option value="">Seleccione la cuenta de deposito</option>
                                </select>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                            </div>
                        </div>

                        <div class="row m-1">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label class="form-label">Cuenta a la que transfiere</label>
                                <select class="form-control select2" name="cuenta_transfiere_id" id="select-account-transfer" required style="width: 100%!important">
                                    <option value="">Seleccione la cuenta a la que trasnfiere</option>
                                    {{-- @foreach($cuentasBancarias as $cuentaBancaria)
                                        <option value="{{$cuentaBancaria->cuentabancaria_id}}">{{$cuentaBancaria->banco->nombre}} | {{$cuentaBancaria->nrocuenta}} @if(isset($cuentaBancaria->nrocuentacci)) | CCI: {{$cuentaBancaria->nrocuentacci}} @endif</option>
                                    @endforeach --}}
                                </select>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                            </div>
                        </div>

                        <div class="row m-1 mt-3">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h5>Tipo de cambio y monto</h5>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                                <label class="form-label">Compra</label>
                                <input type="text" class="form-control" name="tipo_cambio_compra" id="tipo_cambio_compra" placeholder="Compra" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                                <label class="form-label">Venta</label>
                                <input type="text" class="form-control" name="tipo_cambio_venta" id="tipo_cambio_venta" placeholder="Venta" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                                <label class="form-label">Monto</label>
                                <input type="text" class="form-control" name="monto" id="amount" placeholder="Monto" required value="0.00">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                                @if (count($discountCodes) > 0)
                                    <div class="d-none" id ="div-discount-codes">
                                        <label class="form-label">Código de descuento</label>
                                        <input type="text" class="form-control" id="discount_code" name="discount_code" placeholder="Ingrese el código de descuento">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row m-1 mt-3">
                            <input type="hidden" name="cambio" id="cambio" required>
                            <input type="hidden" name="taza" id="taza" required>
                            <input type="hidden" id="monto_con_descuento" name="monto_con_descuento">

                            <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                                <span class="form-label d-inline">El cliente transfiere: </span>
                                <span class="d-inline" type="text" id="transfiere"></span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                                <span class="form-label d-inline">El cliente recibe: </span>
                                <span class="d-inline" type="text" id="recibe"></span>
                            </div>
                        </div>

                        <div class="row m-1 mt-3">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <br>
                                <div class="form-group">
                                    <label class="form-label">Seleccione de donde provienen los fondos</label>
                                    <select class="form-control select2 custom-select" data-placeholder="Elija uno" name="origen_fondo_id" id="origen_fondo_id" style="width: 100% !important;">
                                        <option></option>
                                        @foreach($origenFondos as $origenFondo)
                                            <option value="{{$origenFondo->id}}">{{$origenFondo->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group d-none" id="origen_fondo_otro">
                                    <label class="form-label">Ingresa el origen de los fondos</label>
                                    <input type="text" class="form-control" name="origen_fondo_otro" id="origen_fondo_otro_input" placeholder="Ingresa el origen de los fondos">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="float-right">
                                    <a id="mas_vouchers" style="cursor: pointer;">
                                        Más vouchers&nbsp; <i class="fas fa-plus-circle"></i>
                                    </a>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="form-label">Adjunta el voucher o captura de la transferencia</div>
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
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary" id="save-operation">
                                    GUARDAR OPERACIÓN
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal new user -->
    <div class="modal fade" id="modal-new-user" tabindex="-1" role="dialog" aria-labelledby="modal-new-user-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row" id="user-basic-register-form">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="user-username">Usuario</label>
                                <input type="text" class="form-control basic-user-info" id="user-username" placeholder="Usuario">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="user-email">Email</label>
                                <input type="email" class="form-control basic-user-info" id="user-email" placeholder="Email">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="user-password">Password</label>
                                <input type="password" class="form-control basic-user-info" id="user-password" placeholder="Password">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr class="mt-2 mb-2">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-mg-12 col-sm-12">
                            <label>Seleccione el tipo de usuario</label>
                            <br>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="usuario_personal" name="user_type" value="personal" class="custom-control-input">
                                <label class="custom-control-label" for="usuario_personal">Personal</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="usuario_empresa" name="user_type" value="empresa" class="custom-control-input">
                                <label class="custom-control-label" for="usuario_empresa">Empresa</label>
                            </div>
                            <hr class="mt-2 mb-2">
                        </div>
                    </div>

                    @include('admin.operacion-manual-personal-form')

                    @include('admin.operacion-manual-empresa-form')
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id='btn-save-user'>Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal new account -->
    <div class="modal fade" id="modal-new-account" tabindex="-1" role="dialog" aria-labelledby="modal-new-account-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nueva cuenta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                            <label class="form-label">Banco</label>
                            <select class="form-control select2 custom-select" data-placeholder="Elija uno" name="account-bank" id="account-bank" style="width: 100%!important">
                                <option>Seleccione el banco</option>
                                @foreach($bancos as $banco)
                                    <option value="{{$banco->banco_id}}">{{$banco->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="account-number">*Número de cuenta</label>
                                <input type="text" class="form-control" id="account-number" placeholder="Ingrese el número de cuenta">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                            <label class="form-label">Tipo de cuenta</label>
                            <select class="form-control select2 custom-select" data-placeholder="Elija uno" name="account-type" id="account-type" style="width: 100%!important">
                                <option>Seleccione el tipo de cuenta</option>
                                @foreach($tiposDeCuenta as $tipoDeCuenta)
                                    <option value="{{$tipoDeCuenta->tipocuenta_id}}">{{$tipoDeCuenta->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="account-number-cci">Número de cuenta CCI</label>
                                <input type="text" class="form-control" id="account-number-cci" placeholder="Ingrese el número de cuenta CCI">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                            <label class="form-label">Moneda</label>
                            <select class="form-control select2 custom-select" data-placeholder="Elija uno" name="account-coin" id="account-coin" style="width: 100%!important">
                                <option>Seleccione el tipo de moneda</option>
                                @foreach($tiposDeMoneda as $tipoDeMoneda)
                                    <option value="{{$tipoDeMoneda->moneda_id}}">{{$tipoDeMoneda->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                            <div class="form-group">
                                <label for="account-number-cci">Alias</label>
                                <input type="text" class="form-control" id="account-alias" placeholder="Ingrese un alias">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-mg-12 col-sm-12">
                            <label>¿Esta cuenta es propia?</label>
                            <br>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="account-own" name="cuenta_propia" value="1" class="custom-control-input cuenta_propia" checked>
                                <label class="custom-control-label" for="account-own">Si</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="account-not-own" name="cuenta_propia" value="0" class="custom-control-input cuenta_propia">
                                <label class="custom-control-label" for="account-not-own">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="row d-none" id="div_cuenta_propia">
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                            <br>
                            <div class="form-group">
                                <label class="custom-switch">
                                    <input type="checkbox" name="autorizo_deposito" id="autorizo_deposito" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Autorizo que se deposite a esta cuenta</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                            <div class="form-group">
                                <label class="form-label">¿A nombre de quien esta la cuenta?</label>
                                <input type="text" class="form-control" name="account-name" id="account-name" placeholder="Ingresar nombre">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                            <label class="form-label">Tipo de documento</label>
                            <select class="form-control select2 custom-select" name="account-document_type" id="account-document_type" style="width: 100%!important">
                                <option>Seleccione el tipo de documento</option>
                                @foreach($tiposDeDocumento as $tipoDeDocumento)'
                                    <option value="{{$tipoDeDocumento->tiposdocumento_id}}">{{$tipoDeDocumento->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                            <div class="form-group">
                                <label class="form-label">Número documento</label>
                                <input type="text" class="form-control" name="account-document_number" id="account-document_number" placeholder="Ingrese el número de documento">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id='btn-save-account'>Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!--Select2 js -->
    <script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>

    <!--MutipleSelect js-->
    <script src="{{asset('assets/plugins/multipleselect/multiple-select.js')}}"></script>
    <script src="{{asset('assets/plugins/multipleselect/multi-select.js')}}"></script>

    {{-- Alertify --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/alertify.min.js"></script>

    <script>
        let accounts;
        let adminAccounts = @php echo $cuentasBancarias @endphp;
        adminAccounts = adminAccounts.filter(account => account.banco.is_active == 1);
    </script>


    <script>
        $('.select2').select2({
            minimumResultsForSearch: Infinity
        });

        $('#select-user').select2({
            minimumResultsForSearch: null
        });

        $("input[name='user_type']").on('click', function() {
            let user_type = $("input[name='user_type']:checked").val();
            if (user_type == 'personal') {
                showPersonalForm();
            }
            else if (user_type == 'empresa') {
                showCompanyForm();
            }
        });

        function showPersonalForm() {
            $('#user-empresa-form').addClass('d-none');
            if ($('#user-personal-form').hasClass('d-none')) {
                $('#user-personal-form').removeClass('d-none');
            }
        }

        function showCompanyForm() {
            $('#user-personal-form').addClass('d-none');
            if ($('#user-empresa-form').hasClass('d-none')) {
                $('#user-empresa-form').removeClass('d-none');
            }
        }
    </script>

    <script>
        $(document).on('change', '.persona-expuesta', function(e){
            if($('input[name=p-persona_expuesta]:checked').val() == 1){
                //Expuesta
                $("#pe-fields").removeClass("d-none")
            }
            else{
                //No expuesta
                $("#pe-fields").addClass("d-none")
            }
        });

        $(document).on('change', '.persona-expuesta-fam', function(e){
            if($('input[name=p-persona_expuesta_fam]:checked').val() == 1){
                //Expuesta
                $("#pe-fam-fields").removeClass("d-none")
            }
            else{
                //No expuesta
                $("#pe-fam-fields").addClass("d-none")
            }
        });

        $(".cuenta_propia").on("change", function(){
            let cuenta_propia = $('input[name=cuenta_propia]:checked').val();

            //Si no es cuenta propia, habilito que ingrese datos de la cuenta NO propia
            if( cuenta_propia == 0 ){
                $("#div_cuenta_propia").removeClass("d-none");
            }
            else if (cuenta_propia == 1){
                $("#div_cuenta_propia").addClass("d-none");
            }
        })
    </script>

    <script>
        getDepartamentos();

        function getDepartamentos(){
            $.get("{{url('api/departamento')}}",function(ls){
                for (var i =  0; i < ls.length; i++) {
                    $("#p-personal-departamento").append('<option value="'+ls[i].dDepartamento+'">'+ls[i].Descripcion+'</option>');
                    $("#e-empresa-departamento").append('<option value="'+ls[i].dDepartamento+'">'+ls[i].Descripcion+'</option>');
                }
                //DEJO SELECCIONADA LA OPCION DE LIMA
                $('#p-personal-departamento option[value="15"]').attr("selected", "selected");
                $('#e-empresa-departamento option[value="15"]').attr("selected", "selected");
                pProvincia($("#p-personal-departamento").val());
                eProvincia($("#e-empresa-departamento").val());
            });
        }

        function pProvincia(i) {
            $("#p-personal-provincia option").remove();
            $.get("{{url('api/provincia')}}/"+i,function(ls){
                for (var i =  0; i < ls.length; i++) {
                    $("#p-personal-provincia").append('<option value="'+ls[i].codProvincia+'">'+ls[i].Descripcion+'</option>');
                }
                //DEJO SELECCIONADA LA OPCION DE LIMA
                $('#p-personal-provincia option[value="0"]').attr("selected", "selected");
                pDistrito($("#p-personal-departamento").val(),$("#p-personal-provincia").val());
            });
        }
        function pDistrito(i,j) {
            $("#p-personal-distrito option").remove();
            $.get("{{url('api/distrito')}}/"+i+"/"+j,function(ls){
                for (var i =  0; i < ls.length; i++) {
                    $("#p-personal-distrito").append('<option value="'+ls[i].codDistrito+'">'+ls[i].Descripcion+'</option>');
                }
            });
        }
        function eProvincia(i) {
            $("#e-empresa-provincia option").remove();
            $.get("{{url('api/provincia')}}/"+i,function(ls){
                for (var i =  0; i < ls.length; i++) {
                    $("#e-empresa-provincia").append('<option value="'+ls[i].codProvincia+'">'+ls[i].Descripcion+'</option>');
                }
                //DEJO SELECCIONADA LA OPCION DE LIMA
                $('#e-empresa-provincia option[value="0"]').attr("selected", "selected");
                eDistrito($("#e-empresa-departamento").val(),$("#e-empresa-provincia").val());
            });
        }
        function eDistrito(i,j) {
            $("#e-empresa-distrito option").remove();
            $.get("{{url('api/distrito')}}/"+i+"/"+j,function(ls){
                for (var i =  0; i < ls.length; i++) {
                    $("#e-empresa-distrito").append('<option value="'+ls[i].codDistrito+'">'+ls[i].Descripcion+'</option>');
                }
            });
        }
        $(document).on("change", "#p-personal-departamento", function() {
            pProvincia($("#p-personal-departamento").val());
        });
        $(document).on("change", "#p-personal-provincia", function() {
            pDistrito($("#p-personal-departamento").val(),$("#p-personal-provincia").val());
        });

        $(document).on("change", "#e-empresa-departamento", function() {
            eProvincia($("#e-empresa-departamento").val());
        });
        $(document).on("change", "#e-empresa-provincia", function() {
            eDistrito($("#e-empresa-departamento").val(),$("#e-empresa-provincia").val());
        });
    </script>

    <script>
        $('#btn-save-user').on('click', function (event) {
            event.preventDefault();
            if (!$('#user-username').val() || !$('#user-email').val() || !$('#user-password').val()) {
                return alert('El usuario, email y password son obligatorios');
            }

            if (!$("input[name='user_type']:checked").val()) {
                return alert('El tipo de usuario es obligatorio');
            }

            let newUserData = {};
            let url = "{{ route('save-user-operacion-manual') }}";

            let user_type = $("input[name='user_type']:checked").val();
            if (user_type == 'personal') {
                newUserData = {
                    username: $('#user-username').val(),
                    email: $('#user-email').val(),
                    password: $('#user-password').val(),
                    user_type: user_type,
                    p_primer_nombre: $('#p-primer_nombre').val(),
                    p_segundo_nombre: $('#p-segundo_nombre').val(),
                    p_primero_apellido: $('#p-primer_apellido').val(),
                    p_segundo_apellido: $('#p-segundo_apellido').val(),
                    p_tipo_documento: $('#p-tipo_documento').val(),
                    p_numero_documento: $('#p-numero_documento').val(),
                    p_fecha_nacimiento: $('#p-fecha_nacimiento').val(),
                    p_celular: $('#p-celular').val(),
                    p_celular1: $('#p-celular1').val(),
                    p_celular2: $('#p-celular2').val(),

                    p_pais: $('#p-personal-pais').val(),
                    p_departamento: $('#p-personal-departamento').val(),
                    p_provincia: $('#p-personal-provincia').val(),
                    p_distrito: $('#p-personal-distrito').val(),
                    p_direccion: $('#p-direccion').val(),

                    p_ocupacion: $('#p-ocupacion').val(),
                    p_persona_expuesta: $('input[name=p-persona_expuesta]:checked').val(),
                    p_cargo: $('#p-cargo').val(),
                    p_lugar_de_trabajo: $('#p-lugar_de_trabajo').val(),

                    p_persona_expuesta_fam: $('input[name=p-persona_expuesta_fam]:checked').val(),
                    p_tipo_doc_fam: $('#p-tipo_doc_fam').val(),
                    p_num_doc_fam: $('#p-num_doc_fam').val(),
                    p_nombre_fam: $('#p-nombre_fam').val(),
                    p_apellido_fam: $('#p-apellido_fam').val(),
                    p_cargo_fam: $('#p-cargo_fam').val(),
                    p_lugar_de_trabajo_fam: $('#p-lugar_de_trabajo_fam').val(),

                    _token: "{{csrf_token()}}"
                }

                if (!newUserData.p_primer_nombre || newUserData.p_primer_nombre == "" || !newUserData.p_primero_apellido ||
                    newUserData.p_primero_apellido == "" || newUserData.p_numero_documento == "" || !newUserData.p_numero_documento ||
                    !newUserData.p_pais || newUserData.p_pais == "" || !newUserData.p_direccion || newUserData.p_direccion == "" ||
                    $('#p-documento_frente').get(0).files.length === 0 || $('#p-documento_dorso').get(0).files.length === 0
                ) {
                    alert('Faltan datos requeridos, pueden ser: Primer nombre, Primer apellido, Número de documento, País, Dirección, Documento (frente) o Documento (dorso)');
                    return false;
                }
            }
            else if (user_type == 'empresa') {
                newUserData = {
                    username: $('#user-username').val(),
                    email: $('#user-email').val(),
                    password: $('#user-password').val(),
                    user_type: user_type,
                    e_numero_ruc: $('#e-numero_ruc').val(),
                    e_razon_social: $('#e-razon_social').val(),
                    e_giro_negocio: $('#e-giro_negocio').val(),
                    e_direccion_fiscal: $('#e-direccion_fiscal').val(),
                    e_pais: $('#e-empresa-pais').val(),
                    e_departamento: $('#e-empresa-departamento').val(),
                    e_provincia: $('#e-empresa-provincia').val(),
                    e_distrito: $('#e-empresa-distrito').val(),
                    e_correo: $('#e-correo').val(),
                    e_telefono: $('#e-telefono').val(),

                    e_primer_nombre: $('#e-primer_nombre').val(),
                    e_segundo_nombre: $('#e-segundo_nombre').val(),
                    e_primero_apellido: $('#e-primer_apellido').val(),
                    e_segundo_apellido: $('#e-segundo_apellido').val(),
                    e_tipo_documento: $('#e-tipo_documento').val(),
                    e_numero_documento: $('#e-numero_documento').val(),
                    e_ocupacion: $('#e-ocupacion').val(),

                    e_primer_nombre_contacto: $('#e-primer_nombre_contacto').val(),
                    e_segundo_nombre_contacto: $('#e-segundo_nombre_contacto').val(),
                    e_primero_apellido_contacto: $('#e-primer_apellido_contacto').val(),
                    e_segundo_apellido_contacto: $('#e-segundo_apellido_contacto').val(),
                    e_tipo_documento_contacto: $('#e-tipo_documento_contacto').val(),
                    e_numero_documento_contacto: $('#e-numero_documento_contacto').val(),
                    e_telefono_contacto: $('#e-telefono_contacto').val(),
                    e_ocupacion_contacto: $('#e-ocupacion_contacto').val(),

                    _token: "{{csrf_token()}}"
                }

                if (!newUserData.e_numero_ruc || newUserData.e_numero_ruc == "" || !newUserData.e_razon_social ||
                    newUserData.e_razon_social == "" || !newUserData.e_giro_negocio || newUserData.e_giro_negocio == "" ||
                    !newUserData.e_direccion_fiscal || newUserData.e_direccion_fiscal == "" || !newUserData.e_pais ||
                    newUserData.e_pais == "" || !newUserData.e_correo || newUserData.e_correo == "" || 
                    !newUserData.e_telefono || newUserData.e_telefono == "" ||
                    !newUserData.e_primer_nombre || newUserData.e_primer_nombre == "" || !newUserData.e_primero_apellido ||
                    newUserData.e_primero_apellido == "" || !newUserData.e_numero_documento || newUserData.e_numero_documento == "" || 
                    !newUserData.e_primer_nombre_contacto || newUserData.e_primer_nombre_contacto == "" || !newUserData.e_primero_apellido_contacto ||
                    newUserData.e_primero_apellido_contacto == "" || !newUserData.e_numero_documento_contacto || newUserData.e_numero_documento_contacto == "" || 
                    $('#ficha_ruc').get(0).files.length === 0 || $('#e-documento_frente').get(0).files.length === 0 || $('#e-documento_dorso').get(0).files.length === 0
                ) {
                    alert('Faltan datos requeridos, pueden ser: Ruc, Razon Social, Giro de negocio, Direccion fiscal, Pais, Correo, Teléfono, Primer nombre, Primer apellido, Número de documento, Primer nombre del contacto, Primer apellido del contacto, Número de documento del contacto, Ficha RUC, Documento (frente) o Documento (dorso)');
                    return false;
                }
            }

            var formData = new FormData();

            // Convert new user data object to form data
            for ( var key in newUserData ) {
                formData.append(key, newUserData[key]);
            }

            // Append files to form data
            if ($('#p-documento_frente').get(0).files.length > 0) {
                formData.append("documento_frente", $('#p-documento_frente').get(0).files[0]);
            }
            if ($('#p-documento_dorso').get(0).files.length > 0) {
                formData.append("documento_dorso", $('#p-documento_dorso').get(0).files[0]);
            }
            if ($('#e-documento_frente').get(0).files.length > 0) {
                formData.append("documento_frente", $('#e-documento_frente').get(0).files[0]);
            }
            if ($('#e-documento_dorso').get(0).files.length > 0) {
                formData.append("documento_dorso", $('#e-documento_dorso').get(0).files[0]);
            }
            if ($('#ficha_ruc').get(0).files.length > 0) {
                formData.append("ficha_ruc", $('#ficha_ruc').get(0).files[0]);
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $.ajax({
                url: url,
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
            }).done(function( response ) {
                if (response['success']) {
                    let text = '';

                    if (response['usuario'].personal == 1) {
                        text += response['usuario'].primernombre ?? '';
                        text += ' ';
                        text += response['usuario'].segundonombre ?? '';
                        text += ' ';
                        text += response['usuario'].primeroapellido ?? '';
                        text += ' ';
                        text += response['usuario'].segundoapellido ?? '';
                    }
                    else {
                        text += response['usuario'].razon_social ?? '';
                        text += ' - ';
                        text += response['usuario'].ruc ?? '';
                    }
                    let newUserOption = new Option(text, response['usuario'].usuario_id, true, true);

                    $('#select-user').append(newUserOption).trigger('change');

                    $('#modal-new-user').modal('toggle');

                    $('#user-username').val('');
                    $('#user-email').val('');
                    $('#user-password').val('');
                    $('#p-primer_nombre').val('');
                    $('#p-segundo_nombre').val('');
                    $('#p-primer_apellido').val('');
                    $('#p-segundo_apellido').val('');
                    $('#p-tipo_documento').val('');
                    $('#p-numero_documento').val('');
                    $('#p-fecha_nacimiento').val('');
                    $('#p-celular').val('');
                    $('#p-celular1').val('');
                    $('#p-celular2').val('');
                    $('#p-personal-pais').val('');
                    $('#p-personal-departamento').val('');
                    $('#p-personal-provincia').val('');
                    $('#p-personal-distrito').val('');
                    $('#p-direccion').val('');
                    $('#p-ocupacion').val('');
                    $('input[name=p-persona_expuesta]:checked').val('');
                    $('#p-cargo').val('');
                    $('#p-lugar_de_trabajo').val('');
                }
                else {
                    if (!response['usuario']) {
                        $('#modal-new-user').modal('toggle');
                        alertify.set('notifier','position', 'top-right');
                        alertify.error(response['message']);
                    }
                    else {
                        if ($('#select-user').find("option[value='" + response['usuario'].usuario_id + "']").length) {
                            $('#select-user').val(response['usuario'].usuario_id).trigger('change');
                        }
                        $('#modal-new-user').modal('toggle');
                        alertify.set('notifier','position', 'top-right');
                        alertify.error(response['message']);
                    }
                }
            });
        });
    </script>

    <script>
        $('#select-user').on('change', function() {
            let url = "{{ route('get-accounts-operacion-manual', ":userId") }}";
            url = url.replace(':userId', $('#select-user').val());

            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
            }).done(function( response ) {
                if (response['success']) {
                    accounts = response['accounts'];
                    $("#select-account-send option").remove();
                    $("#select-account-send").append('<option>Seleccione la cuenta de envio</option>');
                    $("#select-account-to-deposit option").remove();
                    $("#select-account-to-deposit").append('<option>Seleccione la cuenta de deposito</option>');

                    for (let i = 0; i < response['accounts'].length; i++) {
                        $("#select-account-send").append('<option value="' + response['accounts'][i].cuentabancaria_id + '" data-tipo_moneda="'+response['accounts'][i].moneda.moneda_id + '">' + response['accounts'][i].banco.nombre +' | ' + response['accounts'][i].moneda.nombre+' | '+ response['accounts'][i].nrocuenta + (response['accounts'][i].nrocuentacci ? ' | CCI - ' + response['accounts'][i].nrocuentacci : '') + '</option>')
                        $("#select-account-to-deposit").append('<option value="' + response['accounts'][i].cuentabancaria_id + '" data-tipo_moneda="'+response['accounts'][i].moneda.moneda_id + '">' + response['accounts'][i].banco.nombre +' | ' + response['accounts'][i].moneda.nombre+' | '+ response['accounts'][i].nrocuenta + (response['accounts'][i].nrocuentacci ? ' | CCI - ' + response['accounts'][i].nrocuentacci : '') + '</option>')
                    }
                }
            });
        });
    </script>

    <script>
        $('#btn-save-account').on('click', function (event) {
            let url = "{{ route('save-account-operacion-manual') }}";

            let ownAccount = $("input[name='cuenta_propia']:checked").val();

            let newAccountData = {
                usuario_id: $('#select-user').val(),
                banco_id: $('#account-bank').val(),
                tipo_cuenta_id: $('#account-type').val(),
                moneda_id: $('#account-coin').val(),
                numero_cuenta: $('#account-number').val(),
                numero_cuenta_cci: $('#account-number-cci').val(),
                alias: $('#account-alias').val(),
                cuenta_propia: ownAccount,
                autorizo_deposito: ownAccount == 0 ? $('#autorizo_deposito').val() : null,
                nombre: ownAccount == 0 ? $('#account-name').val() : null,
                tipo_documento_id: ownAccount == 0 ? $('#account-document_type').val() : null,
                numero_documento: ownAccount == 0 ? $('#account-document_number').val() : null,
                _token: "{{csrf_token()}}"
            }

            $.ajax({
                url: url,
                type: "POST",
                dataType: "JSON",
                data: newAccountData,
            }).done(function( response ) {
                if (response['success']) {
                    $("#select-account-send").append('<option value="' + response['account'].cuentabancaria_id + '" data-tipo_moneda="'+response['account'].moneda.moneda_id + '">' + response['account'].banco.nombre +' | ' + response['account'].moneda.nombre+' | '+ response['account'].nrocuenta + (response['account'].nrocuentacci ? ' | CCI - ' + response['account'].nrocuentacci : '') + '</option>')
                    $("#select-account-to-deposit").append('<option value="' + response['account'].cuentabancaria_id + '" data-tipo_moneda="'+response['account'].moneda.moneda_id + '">' + response['account'].banco.nombre +' | ' + response['account'].moneda.nombre+' | '+ response['account'].nrocuenta + (response['account'].nrocuentacci ? ' | CCI - ' + response['account'].nrocuentacci : '') + '</option>')
                    accounts.push(response['account']);

                    $('#modal-new-account').modal('toggle');

                    $('#account-bank').val('').trigger('change');
                    $('#account-type').val('').trigger('change');
                    $('#account-coin').val('').trigger('change');
                    $('#account-number').val('');
                    $('#account-number-cci').val('');
                    $('#account-alias').val('');
                    $('#autorizo_deposito').val('');
                    $('#account-name').val('');
                    $('#account-document_type').val('');
                    $('#account-document_number').val('');
                }
            });
        });
    </script>

    <script>
        let tipo_moneda_envio = null;
        $("#select-account-send").on('change', function(){
            tipo_moneda_envio = $(this).find(':selected').attr('data-tipo_moneda');

            $('#coin-send').val(tipo_moneda_envio);
            $('#coin-receive').val(tipo_moneda_envio == 1 ? 2 : 1);

            $("#select-account-to-deposit option").remove();
            $("#select-account-to-deposit").append('<option>Seleccione la cuenta de deposito</option>');

            $("#select-account-transfer option").remove();
            $("#select-account-transfer").append('<option>Seleccione la cuenta a la que trasnfiere</option>');

            let accountsSoles = accounts.filter(cuenta => cuenta.moneda.moneda_id == 1);
            let accountsDolares = accounts.filter(cuenta => cuenta.moneda.moneda_id == 2);

            let adminAccountsSoles = adminAccounts.filter(cuenta => cuenta.moneda.moneda_id == 1);
            let adminAccountsDolares = adminAccounts.filter(cuenta => cuenta.moneda.moneda_id == 2);

            if(tipo_moneda_envio == 1){
                accountsDolares.forEach(cuenta => $("#select-account-to-deposit").append('<option value="' + cuenta.cuentabancaria_id + '" data-tipo_moneda="'+cuenta.moneda.moneda_id + '">' + cuenta.banco.nombre +' | ' + cuenta.moneda.nombre+' | '+ cuenta.nrocuenta + (cuenta.nrocuentacci ? ' | CCI - ' + cuenta.nrocuentacci : '') + '</option>'));
                adminAccountsSoles.forEach(cuenta=>$("#select-account-transfer").append('<option value="'+cuenta.cuentabancaria_id+'">-'+cuenta.tipo.nombre+' | '+cuenta.moneda.nombre+' | '+cuenta.banco.nombre+'- '+cuenta.nrocuenta+'| CCI: '+cuenta.nrocuentacci+'</option>'));
            }
            else if(tipo_moneda_envio == 2){
                accountsSoles.forEach(cuenta => $("#select-account-to-deposit").append('<option value="' + cuenta.cuentabancaria_id + '" data-tipo_moneda="' + cuenta.moneda.moneda_id + '">' + cuenta.banco.nombre + ' | ' + cuenta.moneda.nombre+' | '+ cuenta.nrocuenta + (cuenta.nrocuentacci ? ' | CCI - ' + cuenta.nrocuentacci : '') + '</option>'));
                adminAccountsDolares.forEach(cuenta=>$("#select-account-transfer").append('<option value="'+cuenta.cuentabancaria_id+'">-'+cuenta.tipo.nombre+' | '+cuenta.moneda.nombre+' | '+cuenta.banco.nombre+'- '+cuenta.nrocuenta+'| CCI: '+cuenta.nrocuentacci+'</option>'));
            }
            
            if (tipo_moneda_envio == 1 ){
                $('#div-discount-codes').removeClass('d-none');
            }
            else if(tipo_moneda_envio == 2){
                $('#div-discount-codes').addClass('d-none');
            }
        });
    </script>

    <script>
        $('#amount').on('keyup', function() {
            if (tipo_moneda_envio != null) {
                let monto = parseFloat($('#amount').val().replace(/,/g, ''));
                let recibe = 0;

                if (tipo_moneda_envio == 1) {
                    $('#transfiere').html('S/' + numberFormat($('#amount').val()) + ' Soles');
                    recibe = (eval(monto) / eval($('#tipo_cambio_venta').val())).toFixed(2);
                    $('#recibe').html('$' + numberFormat(recibe) + ' Dólares');

                    $('#cambio').val(recibe);
                    $('#taza').val(eval($('#tipo_cambio_venta').val()));
                }
                else if (tipo_moneda_envio == 2) {
                    $('#transfiere').html('$' + numberFormat($('#amount').val()) + ' Dólares');
                    recibe = (eval(monto) * eval($('#tipo_cambio_compra').val())).toFixed(2);
                    $('#recibe').html('S/' + numberFormat(recibe) + ' Soles');

                    $('#cambio').val(recibe);
                    $('#taza').val(eval($('#tipo_cambio_compra').val()));
                }
            }

            $('#amount').val( numberFormat($("#amount").val()) );
        })

        var discountCodes = @php echo $discountCodes @endphp;
        $('#discount_code').on('change', function() {
            if ($(this).val() == null || $(this).val() == "") {
                $('#monto_con_descuento').val("");
                $('#transfiere').html('S/' + numberFormat($('#amount').val()) + ' Soles');
                return;
            }

            let discountCodeFound = discountCodes.findIndex(dc => dc.code == $(this).val());

            if (discountCodeFound == -1) {
                alertify.set('notifier','position', 'top-right');
                alertify.error("Código de descuento no encontrado");

                $('#monto_con_descuento').val("");
                $('#transfiere').html('S/' + numberFormat($('#amount').val()) + ' Soles');
                return;
            }

            let discountAmount = discountCodes[discountCodeFound].discount;

            let montoAux = parseFloat($('#amount').val().replace(/,/g, ''));
            let montoAuxFormatted =  numberFormat((montoAux - discountAmount).toString());

            $('#transfiere').html('S/' + montoAuxFormatted + ' Soles');

            $('#monto_con_descuento').val(montoAux - discountAmount);
            alertify.set('notifier','position', 'top-right');
            alertify.success("Código de descuento aplicado! Has ahorrado: S/" + discountAmount + " Soles");
        });
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
        $('.vouchers').on('change',function(e){
            //get the file name
            var fileName = e.target.files[0].name;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
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

    <script>
        $(document).on('change', '#p-numero_documento', function() {
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
                            $("#p-primer_nombre").val(namesArray[0]); 
                        }
                        if (namesArray[1] != null && namesArray[1] != "") {
                            $("#p-segundo_nombre").val(namesArray[1]); 
                        }
                    }

                    if (lastName1 != null && lastName1 != "") {
                        $("#p-primer_apellido").val(lastName1); 
                    }

                    if (lastName2 != null && lastName2 != "") {
                        $("#p-segundo_apellido").val(lastName2); 
                    }
                }
            });
        });

        $(document).on('change', '#e-numero_ruc', function() {
            let url = "{{ route('peru-consultas-query-ruc', ":ruc") }}";
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
                        $("#e-razon_social").val(businessName); 
                    }

                    if (businessTurn != null && businessTurn.length > 0) {
                        mainBusinessTurn = businessTurn[0].split(' - ');
                        if (mainBusinessTurn.length > 0 && mainBusinessTurn[2] != null) {
                            $("#e-giro_negocio").val(mainBusinessTurn[2]); 
                        }
                    }

                    if (address != null && address != "") {
                        $("#e-direccion_fiscal").val(address); 
                    }

                    if (department != null && department != "") {
                        $("#e-empresa-departamento option").filter(function() {
                            return $(this).text() == department;
                        }).prop("selected", true);

                        if (province != null && province != "") {
                            $("#e-empresa-provincia option").filter(function() {
                                return $(this).text() == province;
                            }).prop("selected", true);

                            if (district != null && district != "") {
                                $("#e-empresa-distrito option").filter(function() {
                                    return $(this).text() == district;
                                }).prop("selected", true);
                            }
                        }
                    }

                }
            });
        });

        $(document).on('change', '#e-numero_documento', function() {
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
                            $("#e-primer_nombre").val(namesArray[0]); 
                        }
                        if (namesArray[1] != null && namesArray[1] != "") {
                            $("#e-segundo_nombre").val(namesArray[1]); 
                        }
                    }

                    if (lastName1 != null && lastName1 != "") {
                        $("#e-primer_apellido").val(lastName1); 
                    }

                    if (lastName2 != null && lastName2 != "") {
                        $("#e-segundo_apellido").val(lastName2); 
                    }
                }
            });
        });

        $(document).on('change', '#e-numero_documento_contacto', function() {
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
                            $("#e-primer_nombre_contacto").val(namesArray[0]); 
                        }
                        if (namesArray[1] != null && namesArray[1] != "") {
                            $("#e-segundo_nombre_contacto").val(namesArray[1]); 
                        }
                    }

                    if (lastName1 != null && lastName1 != "") {
                        $("#e-primer_apellido_contacto").val(lastName1); 
                    }

                    if (lastName2 != null && lastName2 != "") {
                        $("#e-segundo_apellido_contacto").val(lastName2); 
                    }
                }
            });
        });

        $(document).on('change', '#p-num_doc_fam', function() {
			let url = "{{ route('peru-consultas-query-dni', ":dni") }}";
			url = url.replace(":dni", $(this).val());

			$.ajax({
				url: url,
				type: "GET",
				dataType: "JSON",
			}).done(function( response ) {
				if (response['success']) {
					$("#p-nombre_fam").val( response['data']['nombres']); 
					$("#p-apellido_fam").val( response['data']['apellidoPaterno'] + " " + response['data']['apellidoMaterno']); 
				}
			});
		});
    </script>

    <script>
        $('#origen_fondo_id').on('change', function() {
            if ($(this).val() == 11) {
                $('#origen_fondo_otro').removeClass('d-none');
            }
            else{
                $('#origen_fondo_otro').addClass('d-none');
            }
        })
        $('#save-operation').on('click', function(event) {
            if ($('#select-user').val() == "" || $('#select-account-send').val() == "" || $('#select-account-to-deposit').val() == "" || 
                $('select-account-transfer').val() == "" || $('#coin-send').val() == "" || $('#coin-receive').val() == "" || $('#cambio').val() == "" || 
                $('#taza').val() == ""
            ) {
                event.preventDefault();
                alertify.set('notifier','position', 'top-right');
                alertify.error("Debe completar todos los datos solicitados!");
                return;
            }
            
            if ($('#origen_fondo_id').val() == null || $('#origen_fondo_id').val() == "") {
                event.preventDefault();
                alertify.set('notifier','position', 'top-right');
                alertify.error("Debe seleccionar el origen de los fondos");
                return;
            }
            if ($('#origen_fondo_id').val() == 11 && ($('#origen_fondo_otro_input').val() == null || $('#origen_fondo_otro_input').val() == "")) {
                alertify.set('notifier','position', 'top-right');
                alertify.error("Debe ingresar el origen de los fondos");
                event.preventDefault();
                return;
            }

            $('#amount').val( parseFloat($('#amount').val().replace(/,/g, '')) );
        })
    </script>

    <script>
        $(document).on('change', '#p-documento_frente', function(){
            //get the file name
            var fileName = $(this).val().replace('C:\\fakepath\\', '');
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
        $(document).on('change', '#p-documento_dorso', function(){
            //get the file name
            var fileName = $(this).val().replace('C:\\fakepath\\', '');
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
        $(document).on('change', '#e-documento_frente', function(){
            //get the file name
            var fileName = $(this).val().replace('C:\\fakepath\\', '');
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
        $(document).on('change', '#e-documento_dorso', function(){
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
@endsection