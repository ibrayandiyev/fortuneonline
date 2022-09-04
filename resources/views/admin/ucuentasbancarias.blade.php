@extends('layouts.app')

@push('titulo_completo')
    Editar cuenta bancaria
@endpush

@push('titulo')
    Bancos
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
                    <h4>Añade todas las cuentas bancarias en la cual deseas recibir o enviar dinero.</h4>
                </div>

                <div class="card-body">
                    <form action="{{route('ucuentasbancaria', $ls->cuentabancaria_id)}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group ">
                                    <label class="form-label">*Banco</label>
                                    <select class="form-control select2 custom-select" data-placeholder="Elija uno" name="ba" id="ba">
                                        @foreach($ban as $ba)
                                            <option value="{{$ba->banco_id}}">{{$ba->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group ">
                                    <label class="form-label">*Tipo de cuenta</label>
                                    <select class="form-control select2 custom-select" data-placeholder="Elija uno" name="ti" id="ti">
                                        @foreach($tpo as $tc)
                                            <option value="{{$tc->tipocuenta_id}}">{{$tc->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group ">
                                    <label class="form-label">*Moneda</label>
                                    <select class="form-control select2 custom-select" data-placeholder="Elija uno" name="mo" id="mo">
                                        @foreach($mos as $mo)
                                            <option value="{{$mo->moneda_id}}">{{$mo->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">*Número de cuenta</label>
                                    <input type="number" class="form-control" name="nu" id="nu" placeholder="Ingrese el número de cuenta" required> 
                                </div>

                                <div class="form-group">
                                    <label class="form-label">*Número de cuenta CCI</label>
                                    <input type="number" class="form-control" name="nucci" id="nucci" placeholder="Ingrese el número de cuenta CCI" required> 
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        *Alias de la cuenta 
                                        <span class="form-help bg-primary text-white" data-toggle="popover" data-placement="top"
                                            data-content="<p>Ingresa el alias para identificar esta cuenta, por ejemplo: bcp dolares de mamá</p>
                                            <p class='mb-0'><a href=''>Bcp</a></p>
                                            ">?
                                        </span>   
                                    </label>
                                    <input type="text" class="form-control" name="al" id="al" placeholder="Ingrese un alias">
                                </div>

                               {{--
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

                                <div class="@if($ls->cuentapropia != null) d-none @endif" id="div_cuenta_propia">
                                    <div class="form-group">
                                        <label class="form-label">¿A nombre de quien esta la cuenta?</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresar nombre">
                                    </div>
        
                                    <div class="form-group ">
                                        <label class="form-label">Tipo de documento</label>
                                        <select class="form-control select2 custom-select" data-placeholder="Elija uno"  name="tipo_doc" id="tipo_doc">
                                            <option label="Elija uno"></option>
                                            @foreach($doc as $do)'
                                                <option value="{{$do->tiposdocumento_id}}">{{$do->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
        
                                    <div class="form-group">
                                        <label class="form-label">*Número documento</label>
                                        <input type="text" class="form-control" name="numero_doc" id="numero_doc" placeholder="Ingrese el número de cuenta">
                                    </div>
        
                                    <div class="form-group">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="autorizo_deposito" id="autorizo_deposito" class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Autorizo que se deposite a esta cuenta</span>
                                        </label>
                                    </div>
                                </div>
                                --}}
                                {{-- TODO: no falta un boton para guardar la cuenta? --}}
                                <div class="card-body">
                                    <div class="btn-list">
                                        <input class="btn btn-primary" type="submit" value="Guardar cuenta">
                                        <a href="{{route('cuentasbancarias')}}" class="btn btn-danger">Cancelar</a>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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

    <script>
        var data=<?php echo $ls ?>;
        $(document).ready(function(){ 
            $("#ba").val(data.banco_id);
            $("#nu").val(data.nrocuenta);
            $("#nucci").val(data.nrocuentacci);
            $("#mo").val(data.moneda_id);
            $("#al").val(data.alias);
            $("#ti").val(data.tipocuenta_id);

            if(data.cuentapropia != undefined){
                $("input[name=cp][value='"+data.cuentapropia+"']").prop("checked",true);

                $("#nombre").val(data.nombre);
                $("#tipo_doc").val(data.tiposdocumento_id);
                $("#numero_doc").val(data.nro_documento);

                console.log(data.autorizo_deposito == 1);
                if(data.autorizo_deposito == 1){
                    $("#autorizo_deposito").prop("checked",true);
                }
            }
        });
    </script>
@endsection
