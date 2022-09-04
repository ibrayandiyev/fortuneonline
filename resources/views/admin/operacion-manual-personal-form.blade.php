<div class="row d-none" id="user-personal-form">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h5>Datos personales</h5>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Tipo de documento</label>
        <select class="form-control select2 custom-select" name="p-tipo_documento" id="p-tipo_documento" data-placeholder="Elija uno" style="width: 100%!important">
            @foreach($tiposDeDocumento as $tipoDeDocumento)
                <option value="{{$tipoDeDocumento->tiposdocumento_id}}">{{$tipoDeDocumento->nombre}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Número de documento</label>
        <input type="text" class="form-control" name="p-numero_documento" id="p-numero_documento" placeholder="Número de documento">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Documento (frente)</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="p-documento_frente" name="p-documento_frente" accept="image/png, .jpeg, .jpg, image/gif, .pdf">
            <label class="custom-file-label">Elegir archivo</label>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Documento (dorso)</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="p-documento_dorso" name="p-documento_dorso" accept="image/png, .jpeg, .jpg, image/gif, .pdf">
            <label class="custom-file-label">Elegir archivo</label>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Primer nombre</label>
        <input type="text" class="form-control" name="p-primer_nombre" id="p-primer_nombre" placeholder="Primer nombre">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Segundo nombre</label>
        <input type="text" class="form-control" name="p-segundo_nombre" id="p-segundo_nombre" placeholder="Segundo nombre">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Primer Apellido</label>
        <input type="text" class="form-control" name="p-primer_apellido" id="p-primer_apellido" placeholder="Primer Apellido">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Segundo Apellido</label>
        <input type="text" class="form-control" name="p-segundo_apellido" id="p-segundo_apellido" placeholder="Segundo Apellido">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Fecha de nacimiento</label>
        <input type="date" class="form-control" name="p-fecha_nacimiento" id="p-fecha_nacimiento" value="{{date('Y-m-d')}}">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Teléfono</label>
        <input type="text" class="form-control" name="p-celular" id="p-celular" placeholder="Teléfono">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Celular</label>
        <input type="text" class="form-control" name="p-celular1" id="p-celular1" placeholder="Celular">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Otro celular</label>
        <input type="text" class="form-control" name="p-celular2" id="p-celular2" placeholder="Otro celular">
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">
        <hr class="mt-2 mb-2">
        <h5>Datos del domicilio</h5>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">País</label>
        <select class="form-control select2 custom-select" data-placeholder="Elija uno" name="p-personal-pais" id="p-personal-pais" style="width: 100%!important">
            <option label="Elija uno">
            </option>
                @foreach($paises as $pais)
                    <option value="{{$pais->pais_id}}" {{ $pais->pais_id == 1 ? 'selected' : '' }}>{{$pais->nombre}}</option>
                @endforeach
        </select>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Departamento</label>
        <select class="form-control select2 custom-select" name="p-personal-departamento" id="p-personal-departamento" data-placeholder="Elija uno" style="width: 100%!important"></select>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Provincia</label>
        <select class="form-control select2 custom-select" name="p-personal-provincia" id="p-personal-provincia" data-placeholder="Elija uno" style="width: 100%!important"></select>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
    <label class="form-label">Distrito</label>
        <select class="form-control select2 custom-select" name="p-personal-distrito" id="p-personal-distrito" data-placeholder="Elija uno" style="width: 100%!important"></select>
    </div>
    <div class="col-12 col-sm-12">
        <label class="form-label">Dirección</label>
        <input type="text" class="form-control" name="p-direccion" id="p-direccion" placeholder="Dirección">
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">
        <hr class="mt-2 mb-2">
        <h5>Ocupación</h5>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 mb-1">
        <label class="form-label">Ocupación</label>
        <select class="form-control select2 custom-select" name="p-ocupacion" id="p-ocupacion" data-placeholder="Elija uno" style="width: 100%!important">
            @foreach($ocupaciones as $ocupacion)
                <option value="{{$ocupacion->ocupacion_id}}">{{$ocupacion->nombre}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1 mt-2">
        <label class="form-label">Confirme por favor si usted es una persona políticamente expuesta.</label>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <label class="custom-control custom-radio">
            <input required type="radio" class="custom-control-input required persona-expuesta" name="p-persona_expuesta" value="1" checked>
            <span class="custom-control-label">Si</span>
        </label>
        <label class="custom-control custom-radio">
            <input required type="radio" class="custom-control-input required persona-expuesta" name="p-persona_expuesta" value="0">
            <span class="custom-control-label">No</span>
        </label>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12" id="pe-fields">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                <label class="form-label">Cargo</label>
                <input type="text" class="form-control" name="p-cargo" id="p-cargo" placeholder="Cargo">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                <label class="form-label">Lugar de trabajo</label>
                <input type="text" class="form-control" name="p-lugar_de_trabajo" id="p-lugar_de_trabajo" placeholder="Lugar de trabajo">
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 mb-1 mt-2">
        <label class="form-label">Confirme por favor si usted tiene familiar hasta tercer grado políticamente expuesta.</label>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <label class="custom-control custom-radio">
            <input required type="radio" class="custom-control-input required persona-expuesta-fam" name="p-persona_expuesta_fam" value="1" checked>
            <span class="custom-control-label">Si</span>
        </label>
        <label class="custom-control custom-radio">
            <input required type="radio" class="custom-control-input required persona-expuesta-fam" name="p-persona_expuesta_fam" value="0">
            <span class="custom-control-label">No</span>
        </label>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12" id="pe-fam-fields">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                <label class="form-label">Tipo de documento</label>
                <select class="form-control select2 custom-select" name="p-tipo_doc_fam" id="p-tipo_doc_fam" data-placeholder="Elija uno" style="width: 100%!important">
                    @foreach($tiposDeDocumento as $tipoDeDocumento)
                        <option value="{{$tipoDeDocumento->tiposdocumento_id}}">{{$tipoDeDocumento->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                <label class="form-label">Número de documento</label>
                <input type="text" class="form-control" name="p-num_doc_fam" id="p-num_doc_fam" placeholder="Número de documento">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                <label class="form-label">Nombre/s</label>
                <input type="text" class="form-control" name="p-nombre_fam" id="p-nombre_fam" placeholder="Nombre/s">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                <label class="form-label">Apellido/s</label>
                <input type="text" class="form-control" name="p-apellido_fam" id="p-apellido_fam" placeholder="Apellido/s">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                <label class="form-label">Cargo</label>
                <input type="text" class="form-control" name="p-cargo_fam" id="p-cargo_fam" placeholder="Cargo">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
                <label class="form-label">Lugar de trabajo</label>
                <input type="text" class="form-control" name="p-lugar_de_trabajo_fam" id="p-lugar_de_trabajo_fam" placeholder="Lugar de trabajo">
            </div>
        </div>
    </div>
</div>