@extends('layouts.app')

@push('titulo_completo')
    Perfil de usuario
@endpush

@push('titulo')
Editar Perfil
@endpush

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/css/alertify.min.css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}">
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
        .edita{
            color: #005a87;
        }
        .ajs-message{color: white;}
        .beneficiario-row {
            padding: 0.3rem;
        }
        .beneficiario-row:nth-child(even) {
            background-color: #0061da52;
        }
        .beneficiario-add-btn, .beneficiario-remove-btn {
            display: inline-block !important;
            margin: 0 !important;
            width: 42px;
            height: 42px;
            border-radius: .27rem;
            cursor: pointer;
            border: none;
        }
        .beneficiario-remove-btn {
            background: #ea7d7d !important;
        }
        .beneficiario-add-btn {
            background: #77c258 !important;
        }
        .beneficiario-remove-btn:hover, .beneficiario-add-btn:hover {
            opacity: .9;
        }
        .beneficiario-add-btn svg, .beneficiario-remove-btn svg {
            vertical-align: middle;
        }
        .required-mark {
            color: #fff;
        }
    </style>
@endpush

@section('content')
    @php
        $us=\App\Modelo\Usuario::find(\Auth::User()->usuario_id);
        $td=\App\Modelo\Tiposdocumento::all();
        $ocs=\App\Modelo\Ocupacion::all();
        $doc=\App\Modelo\Tiposdocumento::all();
        $beneficiarios = \App\Modelo\EmpresaBeneficiario::where('usuario_id', \Auth::User()->usuario_id)->get();

        $pas=\App\Modelo\Pais::all();
    @endphp

    <div class="row">
        <div class="col-xl-12  col-md-12">
            <form action="" id="fus" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Editar Datos de Perfil</div>
                    </div>
                    <div class="card-body">
                        <div class="card-title font-weight-bold">Datos</div>
                        <div class="row">
                            @if($us->empresa==1)
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group ">
                                        <label class="form-label">Registro Único de Contribuyentes (RUC)</label>
                                        <input type="text" class="form-control" placeholder="Número de ruc" required  name="nr" value="{{$us->ruc}}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group ">
                                        <label class="form-label edita">Razón social</label>
                                        <input type="text" class="form-control" placeholder="Razón social" required  name="rz" value="{{$us->razon_social}}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group ">
                                        <label class="form-label edita">Giro de negocio</label>
                                        <input type="text" class="form-control" placeholder="Giro de negocio" required  name="gn" value="{{$us->giro_negocio}}">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Dirección fiscal</label>
                                    <input type="text" class="form-control" placeholder="City" name="dirf" required value="{{$us->Direccion}}">
                                </div>
                                @if(!is_null($us->ficha_ruc))
                                    <div class="form-group col-md-12">
                                        <label class="form-label edita">Ficha RUC</label>
                                        @if (str_contains(strtolower($us->ficha_ruc), '.pdf'))
                                            <embed src="{{asset('assets/documentos/'.$us->ficha_ruc)}}" height="400"  width="400">
                                        @else
                                            <img src="{{asset('assets/documentos/'.$us->ficha_ruc)}}" alt="" height="250" width="250">
                                        @endif
                                    </div>
                                @endif
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">País</label>
                                    <select class="form-control custom-select" id="pad" name="pad" required>
                                        @foreach($pas as $pa)
                                            <option value="{{$pa->pais_id}}" {{ $pa->pais_id == $us->paisdireccion_id ? 'selected' : ''}}>{{$pa->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Departamento</label>
                                    <select name="dep" class="form-control custom-select" id="dep" required></select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Provincia</label>
                                    <select name="pro" class="form-control custom-select" id="pro" required></select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Distrito</label>
                                    <select name="dis" class="form-control custom-select" id="dis" required></select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Correo electrónico</label>
                                    <input type="text" class="form-control" name="correo" maxlength="35"  placeholder="Correo electrónico" value="{{$us->correo_electronico}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Teléfono</label>
                                    <input type="text" class="form-control" name="tel" maxlength="50"  placeholder="Teléfono" value="{{$us->telefono}}">
                                </div>


                                <div class="col-sm-6 col-md-6">
                                    <div class="card-title font-weight-bold">Legal</div>
                                    <div class="form-group">
                                        <label class="form-label edita">Primer Nombre</label>
                                        <input type="text"  class="form-control" placeholder="First Name" required name="pn" value="{{$us->primernombre}}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                <div class="card-title font-weight-bold">&nbsp;</div>
                                    <div class="form-group">
                                        <label class="form-label edita">Segundo Nombre</label>
                                        <input type="text" class="form-control" placeholder="Second Name" name="sn" value="{{$us->segundonombre}}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label edita">Apellido Paterno</label>
                                        <input type="text" class="form-control" placeholder="Last Name" name="ap" value="{{$us->primeroapellido}}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label edita">Apellido Materno</label>
                                        <input type="text" class="form-control" placeholder="Last Name" name="am" value="{{$us->segundoapellido}}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group ">
                                        <label class="form-label edita">Tipo de Documento</label>
                                        <select class="form-control select2 custom-select" id="td" name="td" >
                                            @foreach($doc as $do)
                                            <option value="{{$do->tiposdocumento_id}}">{{$do->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label edita">Número de Documento</label>
                                        <input type="text" class="form-control" placeholder="Numero de Documento" required  name="nd" value="{{$us->nrodocumento}}">
                                    </div>
                                </div>
                                @if(!is_null($us->documento_frente))
                                    <div class="form-group col-md-6">
                                        <label class="form-label edita">Documento (frente)</label>
                                        @if (str_contains(strtolower($us->documento_frente), '.pdf'))
                                            <embed src="{{asset('assets/documentos/'.$us->documento_frente)}}" height="400"  width="400">
                                        @else
                                            <img src="{{asset('assets/documentos/'.$us->documento_frente)}}" alt="" height="250" width="250">
                                        @endif
                                    </div>
                                @endif
                                @if(!is_null($us->documento_dorso))
                                    <div class="form-group col-md-6">
                                        <label class="form-label edita">Documento (dorso)</label>
                                        @if (str_contains(strtolower($us->documento_dorso), '.pdf'))
                                            <embed src="{{asset('assets/documentos/'.$us->documento_dorso)}}" height="400"  width="400">
                                        @else
                                            <img src="{{asset('assets/documentos/'.$us->documento_dorso)}}" alt="" height="250" width="250">
                                        @endif
                                    </div>
                                @endif
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label edita">Ocupación</label>
                                        <select class="form-control select2 custom-select" id="oc" name="oc">
                                            @foreach($ocs as $oc)
                                                <option value="{{$oc->ocupacion_id}}">{{$oc->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{-- --}}
                                </div>


                                <div class="col-sm-6 col-md-6">
                                    <div class="card-title font-weight-bold">Contacto</div>
                                    <div class="form-group">
                                        <label class="form-label edita">Primer nombre (contacto)</label>
                                        <input type="text"  class="form-control" placeholder="First Name" required name="pnc" value="{{$us->primernombre_c}}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                <div class="card-title font-weight-bold">&nbsp;</div>
                                    <div class="form-group">
                                        <label class="form-label edita">Segundo nombre (contacto)</label>
                                        <input type="text" class="form-control" placeholder="Second Name" name="snc" value="{{$us->segundonombre_c}}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label edita">Apellido paterno (contacto)</label>
                                        <input type="text" class="form-control" placeholder="Last Name" name="apc" value="{{$us->primerapellido_c}}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label edita">Apellido materno (contacto)</label>
                                        <input type="text" class="form-control" placeholder="Last Name" name="amc" value="{{$us->segundoapellido_c}}">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Tipo de Documento (Contacto)</label>
                                    <select class="form-control select2 custom-select" id="tdc" name="tdc">
                                        @foreach($doc as $do)
                                        <option value="{{$do->tiposdocumento_id}}">{{$do->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Número de documento (contacto)</label>
                                    <input type="text" class="form-control" name="ndc" maxlength="35"  placeholder="Número de documento" value="{{$us->nrodocumento_c}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Teléfono de contacto</label>
                                    <input type="text" class="form-control" name="telc" maxlength="35"  placeholder="Teléfono de contacto" value="{{$us->telefono_c}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Ocupación</label>
                                    <select class="form-control select2 custom-select" id="oc_c" name="oc_c">
                                        @foreach($ocs as $oc)
                                            <option value="{{$oc->ocupacion_id}}">{{$oc->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Información beneficiarios finales -->
                                <div class="col-md-12" style="margin-top: 0.7rem;margin-bottom: 1.5rem;">
                                    <div class="card-title font-weight-bold">Información beneficiarios finales</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-label edita"><b>1.</b>&nbsp;&nbsp;&nbsp;¿Es usted el único beneficiario final con el 100% de participación, es decir no existe participación de otras personas en la empresa?</div>
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control custom-radio persona-expuesta">
                                            <input required type="radio" class="custom-control-input required" name="unico_beneficiario_final" id="beneficiarios_questao_1_si" value="si" {{ $us->unico_beneficiario_final == 'si' ? "checked" : "" }}>
                                            <span class="custom-control-label">SI</span>
                                        </label>
                                        <label class="custom-control custom-radio persona-expuesta">
                                            <input required type="radio" class="custom-control-input required" name="unico_beneficiario_final" value="no" {{ $us->unico_beneficiario_final == 'no' ? "checked" : "" }}>
                                            <span class="custom-control-label">NO</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{-- --}}
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-label edita"><b><b>2.</b>&nbsp;&nbsp;&nbsp;¿Existen beneficiarios finales o encargados del control de la empresa con más del 25% de participación?</div>
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control custom-radio persona-expuesta">
                                            <input required type="radio" class="custom-control-input required" name="beneficiario_participacion" id="beneficiarios_questao_2_si" value="si" {{ $us->beneficiario_participacion == 'si' ? "checked" : "" }}>
                                            <span class="custom-control-label">SI</span>
                                        </label>
                                        <label class="custom-control custom-radio persona-expuesta">
                                            <input required type="radio" class="custom-control-input required" name="beneficiario_participacion" id="beneficiarios_questao_2_no" value="no" {{ $us->beneficiario_participacion == 'no' ? "checked" : "" }}>
                                            <span class="custom-control-label">NO</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{-- --}}
                                </div>
                                <div class="form-group col-md-8">
                                    <div id="beneficiario-form" style="display: {{ $us->beneficiario_participacion == 'si' ? 'block' : 'none' }}">
                                        <div class="beneficiario-form-top">
                                            <h5>NOTA LEGAL EN ESTA SECCIÓN ES OBLIGATORIA:</h5>
                                            <h5>INFORMACION de BENEFICIARIOS FINALES</h5>
                                            <p>La Resolución Nº SBS 789-2018, en el capítulo III, Artículo 14 y 16 solicita identificar los beneficiarios finales o encargados del control de la empresa con más de 25% de participación.</p>
                                        </div>
                                        <h5 style="background-color: #81acee;color: #000;">Accionista, Socio o asociado (SOLO PARA 4 ACCIONISTAS – 25% CADA UNO)</h5>
                                        <div id="beneficiario-form-content">
                                            @foreach ($beneficiarios as $beneficiario)
                                            <div class="beneficiario-row js-beneficiario-row row">
                                                <div class="form-group col-md-6">
                                                    <div class="form-holder">
                                                        <label class="form-label">Nombre completo</label>
                                                        <input type="text" class="form-control required-step5" name="beneficiario_nombre[]" value="{{ $beneficiario->beneficiario_nombre }}" placeholder="Escreva nombre completo" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <div class="form-holder">
                                                        <label class="form-label">Tipo de documento</label>
                                                        <select class="form-control select2 custom-select required-step5" name="beneficiario_documento_tipo[]" data-placeholder="Elija uno" required>
                                                            @foreach ($doc as $do)
                                                                <option value="{{ $do->tiposdocumento_id }}" <?= $beneficiario->tiposdocumento_id == $do->tiposdocumento_id ? 'selected' : '' ?>>{{ $do->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <div class="form-holder">
                                                        <div class="form-holder">
                                                            <label class="form-label">Número de documento</label>
                                                            <input type="number" class="form-control required-step5" name="beneficiario_documento_numero[]" value="{{ $beneficiario->nrodocumento }}" placeholder="Número de documento" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <div class="form-holder">
                                                        <label class="form-label">Nacionalidad</label>
                                                        <select class="form-control select2 custom-select required-step5" data-placeholder="Elija uno" name="beneficiario_nacionalidad[]" required>
                                                            <option label="Elija uno">
                                                            </option>
                                                            @foreach ($pas as $pa)
                                                                <option value="{{ $pa->pais_id }}" <?= $beneficiario->paisdireccion_id == $pa->pais_id ? 'selected' : '' ?>>{{ $pa->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div style="margin-top: .27rem">
                                            <button type="button" class="beneficiario-remove-btn js-beneficiario-remove-btn" onclick="retirarBeneficiario()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z"/>
                                                </svg>
                                            </button>
                                            <button type="button" class="beneficiario-add-btn js-beneficiario-add-btn" onclick="agregarBeneficiario()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            @elseif($us->personal==1)
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Primer Nombre</label>
                                    <input type="text"  class="form-control" placeholder="First Name" required name="pn" value="{{$us->primernombre}}">
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label edita">Segundo Nombre</label>
                                        <input type="text" class="form-control" placeholder="Second Name" name="sn" value="{{$us->segundonombre}}">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Apellido Paterno</label>
                                    <input type="text" class="form-control" placeholder="Last Name" name="ap" value="{{$us->primeroapellido}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Apellido Materno</label>
                                    <input type="text" class="form-control" placeholder="Last Name" name="am" value="{{$us->segundoapellido}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Tipo de Documento</label>
                                    <select class="form-control select2 custom-select" id="td" name="td" >
                                        @foreach($doc as $do)
                                        <option value="{{$do->tiposdocumento_id}}">{{$do->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Número de Documento</label>
                                    <input type="text" class="form-control" placeholder="Numero de Documento" required  name="nd" value="{{$us->nrodocumento}}">
                                </div>
                                @if(!is_null($us->documento_frente))
                                    <div class="form-group col-md-6">
                                        <label class="form-label edita">Documento (frente)</label>
                                        <img src="{{asset('assets/documentos/'.$us->documento_frente)}}" alt="" height="250" width="250">
                                    </div>
                                @endif
                                @if(!is_null($us->documento_dorso))
                                    <div class="form-group col-md-6">
                                        <label class="form-label edita">Documento (dorso)</label>
                                        <img src="{{asset('assets/documentos/'.$us->documento_dorso)}}" alt="" height="250" width="250">
                                    </div>
                                @endif
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" value="{{$us->fecnacimiento}}" name="fn">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Teléfono</label>
                                    <input type="text" class="form-control" name="cel" maxlength="30"  placeholder="Teléfonos de contacto" value="{{\Auth::User()->userid}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Celular</label>
                                    <input type="text" class="form-control" name="cel1" maxlength="35" value="{{\Auth::User()->actkey}}"  placeholder="Número de Celular" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Celular 2</label>
                                    <input type="text" class="form-control" name="cel2" maxlength="50" value="{{\Auth::User()->user_home_path}}"  placeholder="Otro Número">
                                </div>

                                <div class="form-group col-md-6">
                                    <div class="card-title font-weight-bold">Domicilio</div>
                                    <label class="form-label edita">País</label>
                                    <select class="form-control custom-select" id="pad" name="pad" required>
                                        @foreach($pas as $pa)
                                            <option value="{{$pa->pais_id}}" {{ $pa->pais_id == $us->paisdireccion_id ? 'selected' : ''}}>{{$pa->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="card-title font-weight-bold">&nbsp;</div>
                                    <label class="form-label edita">Departamento</label>
                                    <select name="dep" class="form-control custom-select" id="dep" required></select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Provincia</label>
                                    <select name="pro" class="form-control custom-select" id="pro" required></select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label edita">Distrito</label>
                                    <select name="dis" class="form-control custom-select" id="dis" required></select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label edita">Dirección</label>
                                    <input type="text" class="form-control" placeholder="City" name="dir" required value="{{$us->Direccion}}">
                                </div>


                                <div class="form-group col-md-6">
                                    <div class="card-title font-weight-bold">Ocupación</div>
                                    <label class="form-label edita">Ocupación</label>
                                    <select class="form-control select2 custom-select" id="oc" name="oc">
                                        @foreach($ocs as $oc)
                                            <option value="{{$oc->ocupacion_id}}">{{$oc->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    {{-- --}}
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-label edita">Confirme por favor si usted es una persona políticamente expuesta.</div>
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control custom-radio persona-expuesta">
                                            <input required type="radio" class="custom-control-input required" name="pe" value="1" {{$us->personaexpuesta ? "checked":""}}>
                                            <span class="custom-control-label">SI SOY</span>
                                        </label>
                                        <label class="custom-control custom-radio persona-expuesta">
                                            <input required type="radio" class="custom-control-input required" name="pe" value="0" {{$us->personaexpuesta ? "":"checked"}}>
                                            <span class="custom-control-label">NO SOY</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{-- --}}
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="row {{ $us->personaexpuesta ? "" : "d-none"}}" id="pe-fields">
                                        <div class="form-group col-md-6">
                                            <label class="form-label edita">Cargo</label>
                                            <input type="text" class="form-control" placeholder="Cargo"  name="cargo" value="{{$us->cargo}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label edita">Lugar de trabajo</label>
                                            <input type="text" class="form-control" placeholder="Lugar de trabajo"  name="lugar_de_trabajo" value="{{$us->lugar_de_trabajo}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <div class="form-label edita">Confirme por favor si usted tiene familiar hasta tercer grado políticamente expuesta.</div>
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control custom-radio persona-expuesta-fam">
                                            <input required type="radio" class="custom-control-input required" name="exp_fam" value="1" {{$us->familiar_expuesto ? "checked":""}}>
                                            <span class="custom-control-label">Si</span>
                                        </label>
                                        <label class="custom-control custom-radio persona-expuesta-fam">
                                            <input required type="radio" class="custom-control-input required" name="exp_fam" value="0" {{$us->familiar_expuesto ? "":"checked"}}>
                                            <span class="custom-control-label">No</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{-- --}}
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="row {{ $us->familiar_expuesto ? "" : "d-none"}}" id="pe-fam-fields">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group ">
                                                <label class="form-label edita">Tipo de Documento</label>
                                                <select class="form-control select2 custom-select" id="tipo_doc_fam" name="tipo_doc_fam" value="{{$us->tipo_doc_fam_expuesto}}">
                                                    @foreach($doc as $do)
                                                    <option value="{{$do->tiposdocumento_id}}">{{$do->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label edita">Número de Documento</label>
                                                <input type="text" class="form-control" placeholder="Numero de Documento" required  name="num_doc_fam" id="num_doc_fam" value="{{$us->num_doc_fam_expuesto}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label edita">Nombre/s</label>
                                            <input type="text" class="form-control" placeholder="Nombre/s"  name="nombre_fam" id="nombre_fam" value="{{$us->nombre_fam_expuesto}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label edita">Apellido/s</label>
                                            <input type="text" class="form-control" placeholder="Apellido/s"  name="apellido_fam" id="apellido_fam" value="{{$us->apellido_fam_expuesto}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label edita">Cargo</label>
                                            <input type="text" class="form-control" placeholder="Cargo"  name="cargo_fam" id="cargo_fam" value="{{$us->cargo_fam_expuesto}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label edita">Lugar de trabajo</label>
                                            <input type="text" class="form-control" placeholder="Lugar de trabajo"  name="lugar_de_trabajo_fam" id="lugar_de_trabajo_fam" value="{{$us->lugar_de_trabajo_fam_expuesto}}">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button href="#" class="btn btn-primary">Cambiar</button>
                        <a href="#" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/alertify.min.js"></script>
    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>

    <script>
        var us=<?php echo $us; ?>;

        $(document).on('change', '.persona-expuesta', function(e){
            if($('input[name=pe]:checked', '#fus').val() == 1){
                //Expuesta
                $("#pe-fields").removeClass("d-none")
            }
            else{
                //No expuesta
                $("#pe-fields").addClass("d-none")
            }
        });

        $(document).on('change', '.persona-expuesta-fam', function(e){
            if($('input[name=exp_fam]:checked', '#fus').val() == 1){
                //Expuesta
                $("#pe-fam-fields").removeClass("d-none")
            }
            else{
                //No expuesta
                $("#pe-fam-fields").addClass("d-none")
            }
        });

        $(document).ready(function(){

            $("#oc").val(us.ocupacion_id);
            $("#oc_c").val(us.ocupacion_c_id);
            $("#td").val(us.tiposdocumento_id);

            $.get("{{url('api/departamento')}}").then(function(ls){
                for (var i =  0; i < ls.length; i++) {
                    $("#dep").append('<option value="'+ls[i].dDepartamento+'">'+ls[i].Descripcion+'</option>');
                }
                $("#dep").val(us.departamento_id);
                provincia($("#dep").val());
            });
            function provincia(i) {
                $("#pro option").remove();
                $.get("{{url('api/provincia')}}/"+i).then(function(ls){
                    for (var i =  0; i < ls.length; i++) {
                        $("#pro").append('<option value="'+ls[i].codProvincia+'">'+ls[i].Descripcion+'</option>');
                    }
                    $("#pro").val(us.provincia_id);
                    distrito($("#dep").val(),$("#pro").val());
                });
            }
            function distrito(i,j) {
                $("#dis option").remove();
                $.get("{{url('api/distrito')}}/"+i+"/"+j).then(function(ls){
                    for (var i =  0; i < ls.length; i++) {
                        $("#dis").append('<option value="'+ls[i].codDistrito+'">'+ls[i].Descripcion+'</option>');
                    }
                    $("#dis").val(us.distrito_id);
                });
            }
            $('#dep').on('change', function(){
                provincia($("#dep").val());
            });
            $('#pro').on('change', function(){
                distrito($("#dep").val(),$("#pro").val());
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
        $(document).on('submit', '#fus', function (e) {
            e.preventDefault();
            if({{$us->personal}}==1){
                $.post("uusuario/"+{{$us->usuario_id}},$("#fus").serialize(),function (msg) {
                    alertify.success(msg);
                    });
            }
            else if({{$us->empresa}}==1){
                $.post("uusuario_empresa/"+{{$us->usuario_id}},$("#fus").serialize(),function (msg) {
                    alertify.success(msg);
                    });
            }
        });

        $(function() {
            $('#beneficiarios_questao_1_si, #beneficiarios_questao_2_no').on('change', function(e) {
                if (e.target.checked) {
                    reconfirmacionAlert();
                }
            });

            $('input[name="beneficiario_participacion"]').on('change', function(e) {
                if ($('input[name="beneficiario_participacion"]:checked').val() === 'si') {
                    $('input, select', '#beneficiario-form').attr('disabled', false);
                    $('#beneficiario-form').show();
                } else {
                    $('input, select', '#beneficiario-form').attr('disabled', true);
                    $('#beneficiario-form').hide();
                }
            });
        });

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
            var beneficiarioHtml = '<div class="beneficiario-row js-beneficiario-row row">\
                                        <div class="form-group col-md-6">\
                                            <div class="form-holder">\
                                                <label class="form-label">Nombre completo</label>\
                                                <input type="text" class="form-control required-step5" name="beneficiario_nombre[]" placeholder="Escreva nombre completo" required>\
                                            </div>\
                                        </div>\
                                        <div class="form-group col-md-6">\
                                            <div class="form-holder">\
                                                <label class="form-label">Tipo de documento</label>\
                                                <select class="form-control select2 custom-select required-step5" name="beneficiario_documento_tipo[]" data-placeholder="Elija uno" required>\
                                                    @foreach ($doc as $do)\
                                                        <option value="{{ $do->tiposdocumento_id }}">{{ $do->nombre }}</option>\
                                                    @endforeach\
                                                </select>\
                                            </div>\
                                        </div>\
                                        <div class="form-group col-md-6">\
                                            <div class="form-holder">\
                                                <div class="form-holder">\
                                                    <label class="form-label">Número de documento</label>\
                                                    <input type="number" class="form-control required-step5" name="beneficiario_documento_numero[]" placeholder="Número de documento" required>\
                                                </div>\
                                            </div>\
                                        </div>\
                                        <div class="form-group col-md-6">\
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
@endsection