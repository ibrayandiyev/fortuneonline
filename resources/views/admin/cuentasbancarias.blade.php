@extends('layouts.app')

@push('css')
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
    </style>
@endpush





@section('content')
    @php
        $mos=\App\Modelo\Moneda::all();
        $ban=\App\Modelo\Banco::all();
        $tpo=\App\Modelo\Tipocuenta::all();
        $doc=\App\Modelo\Tiposdocumento::all();
    @endphp

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

<img src="{{asset('assets/images/misbancos.png')}}" alt="img">


                </div>

                <div class="card-body">
                    <form action="{{url('scuentasbancaria')}}" method="POST" id="form_add_account">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group ">
                                    <label class="form-label">Banco*</label>
                                    <select class="form-control select2 custom-select" data-placeholder="Elija uno" name="ba">
                                        @foreach($ban as $ba)
                                            <option value="{{$ba->banco_id}}">{{$ba->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group ">
                                    <label class="form-label">Tipo de cuenta*</label>
                                    <select class="form-control select2 custom-select" data-placeholder="Elija uno" name="ti">
                                        @foreach($tpo as $tc)
                                            <option value="{{$tc->tipocuenta_id}}">{{$tc->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group ">
                                    <label class="form-label">Moneda*</label>
                                    <select class="form-control select2 custom-select" data-placeholder="Elija uno" name="mo">
                                        @foreach($mos as $mo)
                                            <option value="{{$mo->moneda_id}}">{{$mo->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Número de cuenta*</label>
                                    <input type="number" class="form-control" name="nu" placeholder="Ingrese el número de cuenta" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Número de cuenta CCI*</label>
                                    <input type="number" class="form-control" name="nucci" placeholder="Ingrese el número de cuenta CCI" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        Alias de tu cuenta*
                                        <span class="form-help bg-primary text-white" data-toggle="popover" data-placement="top"
                                            data-content="<p>Ingresa el alias para identificar esta cuenta, por ejemplo: <strong><b>mi BCP soles</b></strong></p>

                                            ">?
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" name="al" placeholder="Ingrese un alias">
                                </div>

                                {{--
                                @if (\Auth::User()->usuario)
                                    @if (\Auth::User()->usuario->personal == 1)
                                        <div class="form-group ">
                                            <div class="form-label">
                                                ¿Esta cuenta es propia?
                                            </div>
                                            <div class="custom-controls-stacked">
                                                <label class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input cuenta_propia"  name="cp" value="1" checked>
                                                    <span class="custom-control-label">Si</span>
                                                </label>
                                                <label class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input cuenta_propia"  name="cp" value="0">
                                                    <span class="custom-control-label">No</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="d-none" id="div_cuenta_propia">
                                            <div class="form-group ">
                                                <label class="form-label">Tipo de documento</label>
                                                <select class="form-control select2 custom-select" name="tipo_doc" id="tipo_doc" data-placeholder="Elija uno">
                                                    <option label="Elija uno"></option>
                                                    @foreach($doc as $do)'
                                                        <option value="{{$do->tiposdocumento_id}}">{{$do->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">*Número documento</label>
                                                <input type="text" class="form-control" name="numero_doc" id="numero_doc" placeholder="Ingrese el número de documento">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">¿A nombre de quien esta la cuenta?</label>
                                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresar nombre">
                                            </div>

                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="autorizo_deposito" id="autorizo_deposito" class="custom-switch-input">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">Autorizo que se deposite a esta cuenta</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                 --}}

                                {{-- TODO: no falta un boton para guardar la cuenta? --}}
                                <div class="card-body">
                                    <div class="btn-list">
                                        <input class="btn btn-primary" type="submit" value="Guardar cuenta" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listado de cuentas bancarias</h3>
                </div>

                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>Banco</th>
                                <th>Moneda</th>
                                <th>tipo  de cuenta</th>
                                <th>Alias</th>
                                <th>Nº Cuenta</th>
                                <th>Nº Cuenta CCI</th>
                                {{--
                                    <th>Cuenta propia</th>
                                    <th>A nombre de</th>
                                --}}
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($ls as $l)
                                <tr id="{{$l->cuentabancaria_id}}">
                                    {{-- <td><a href="store.html" class="text-inherit">{{$l->banco->nombre}} </a></td> --}}
                                    <th>{{$l->banco->nombre}}</th>
                                    <th>{{$l->moneda->nombre}}</th>
                                    <th>{{$l->tipo->nombre}}</th>
                                    <th>{{$l->alias}}</th>
                                    <th>{{$l->nrocuenta}}</th>
                                    <th>{{$l->nrocuentacci}}</th>
                                    {{--
                                    <th>
                                        @if($l->cuentapropia == 1) Si @else No @endif
                                    </th>
                                    <th>{{$l->nombre}}</th>
                                    --}}
                                    <th>
                                        <a class="icon" href=""></a>
                                        <a href="{{route('fcuentasbancaria', $l->cuentabancaria_id)}}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> </a>
                                        <a class="icon" href="#"></a>
                                        <a href="#" class="btn btn-secondary btn-sm" onclick="remove({{$l->cuentabancaria_id}})"><i class="fas fa-trash"></i></a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(".cuenta_propia").on("change", function(){
            let cuenta_propia = $('input[name=cp]:checked').val();

            //Si no es cuenta propia, habilito que ingrese datos de la cuenta NO propia
            if( cuenta_propia == 0 ){
                $("#div_cuenta_propia").removeClass("d-none");

                //Si es una cuenta NO propia, los campos que se habilitan deben ser requeridos
                $("#nombre").attr("required", true);
                $("#tipo_doc").attr("required", true);
                $("#numero_doc").attr("required", true);
                $("#autorizo_deposito").attr("required", true);
            }
            else if (cuenta_propia == 1){
                $("#div_cuenta_propia").addClass("d-none");

                //Si es una cuenta propia, los campos que se deshabilitan les borro el valor actual
                $("#nombre").val("");
                $("#tipo_doc").val("");
                $("#numero_doc").val("");
			    $("#autorizo_deposito").removeAttr("checked");
			    $("#autorizo_deposito").val("");

                //Si es una cuenta propia, los campos que se deshabilitan ya no son requeridos
                $('#nombre').removeAttr("required");
                $('#tipo_doc').removeAttr("required");
                $('#numero_doc').removeAttr("required");
                $('#autorizo_deposito').removeAttr("required");
            }
        })
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/alertify.min.js"></script>
    <script>
        function remove(i) {
            alertify.confirm("Eliminar Cuenta","¿Esta seguro con eliminar su cuenta?",
                function(){
                    $.get("dcuentasbancaria/"+i,function(msg){
                        $("tr[id="+i+"]").remove();
                        alertify.success(msg);
                    });
                },
                function(){
                    alertify.error("Eliminación cancelada");
                }
            );
        }
    </script>

    <script>
        $(document).on('change', '#numero_doc', function() {
            let url = "{{ route('peru-consultas-query-dni', ":dni") }}";
            url = url.replace(":dni", $(this).val());

            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
            }).done(function( response ) {
                console.log(response);
                if (response['success']) {
                    $("#nombre").val(response['data']['nombres'] + " " + response['data']['apellidoPaterno'] + " " + response['data']['apellidoMaterno']);
                }
            });
        });
    </script>
@endsection
