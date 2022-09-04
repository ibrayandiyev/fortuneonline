<div class="row d-none" id="user-empresa-form">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h5>Datos de la empresa</h5>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Número de RUC</label>
        <input type="text" class="form-control integer" name="e-numero_ruc" id="e-numero_ruc" placeholder="Número de RUC" required>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Razón Social</label>
        <input type="text" class="form-control" name="e-razon_social" id="e-razon_social" placeholder="Razón Social">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Giro del negocio</label>
        <input type="text" class="form-control" name="e-giro_negocio" id="e-giro_negocio" placeholder="Giro del negocio">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Dirección</label>
        <input type="text" class="form-control" name="e-direccion_fiscal" id="e-direccion_fiscal" placeholder="Dirección">
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 mb-1">
        <label class="form-label">Ficha RUC</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="ficha_ruc" name="ficha_ruc" accept="image/png, .jpeg, .jpg, image/gif, .pdf">
            <label class="custom-file-label">Elegir archivo</label>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">País</label>
        <select class="form-control select2 custom-select" data-placeholder="Elija uno" name="e-empresa-pais" id="e-empresa-pais" style="width: 100%!important">
            <option label="Elija uno">
            </option>
                @foreach($paises as $pais)
                    <option value="{{$pais->pais_id}}" {{ $pais->pais_id == 1 ? 'selected' : '' }}>{{$pais->nombre}}</option>
                @endforeach
        </select>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Departamento</label>
        <select class="form-control select2 custom-select" name="e-empresa-departamento" id="e-empresa-departamento" data-placeholder="Elija uno" style="width: 100%!important"></select>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Provincia</label>
        <select class="form-control select2 custom-select" name="e-empresa-provincia" id="e-empresa-provincia" data-placeholder="Elija uno" style="width: 100%!important"></select>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Distrito</label>
        <select class="form-control select2 custom-select" name="e-empresa-distrito" id="e-empresa-distrito" data-placeholder="Elija uno" style="width: 100%!important"></select>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Correo Electrónico</label>
        <input type="text" class="form-control email" name="e-correo" id="e-correo" maxlength="35" placeholder="Correo Electrónico">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Teléfono</label>
        <input type="text" class="form-control" name="e-telefono" id="e-telefono" maxlength="50" placeholder="Teléfono">
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">
        <hr class="mt-2 mb-2">
        <h5>Datos del Representante Legal</h5>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Tipo de documento</label>
        <select class="form-control select2 custom-select" name="e-tipo_documento" id="e-tipo_documento" data-placeholder="Elija uno" style="width: 100%!important">
            @foreach($tiposDeDocumento as $tipoDeDocumento)
                <option value="{{$tipoDeDocumento->tiposdocumento_id}}">{{$tipoDeDocumento->nombre}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Número de documento</label>
        <input type="text" class="form-control" name="e-numero_documento" id="e-numero_documento" placeholder="Número de documento" required>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Documento (frente)</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="e-documento_frente" name="e-documento_frente" accept="image/png, .jpeg, .jpg, image/gif, .pdf">
            <label class="custom-file-label">Elegir archivo</label>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Documento (dorso)</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="e-documento_dorso" name="e-documento_dorso" accept="image/png, .jpeg, .jpg, image/gif, .pdf">
            <label class="custom-file-label">Elegir archivo</label>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Primer nombre</label>
        <input type="text" class="form-control" name="e-primer_nombre" id="e-primer_nombre" placeholder="Primer nombre">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Segundo nombre</label>
        <input type="text" class="form-control" name="e-segundo_nombre" id="e-segundo_nombre" placeholder="Segundo nombre">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Primer Apellido</label>
        <input type="text" class="form-control" name="e-primer_apellido" id="e-primer_apellido" placeholder="Primer Apellido">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Segundo Apellido</label>
        <input type="text" class="form-control" name="e-segundo_apellido" id="e-segundo_apellido" placeholder="Segundo Apellido">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Ocupación</label>
        <select class="form-control select2 custom-select" name="e-ocupacion" id="e-ocupacion" data-placeholder="Elija uno" style="width: 100%!important">
            @foreach($ocupaciones as $ocupacion)
                <option value="{{$ocupacion->ocupacion_id}}">{{$ocupacion->nombre}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">
        <hr class="mt-2 mb-2">
        <h5>Datos del Contacto</h5>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Tipo de documento</label>
        <select class="form-control select2 custom-select" name="e-tipo_documento_contacto" id="e-tipo_documento_contacto" data-placeholder="Elija uno" style="width: 100%!important">
            @foreach($tiposDeDocumento as $tipoDeDocumento)
                <option value="{{$tipoDeDocumento->tiposdocumento_id}}">{{$tipoDeDocumento->nombre}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Número de documento</label>
        <input type="text" class="form-control" name="e-numero_documento_contacto" id="e-numero_documento_contacto" placeholder="Número de documento">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Primer nombre</label>
        <input type="text" class="form-control" name="e-primer_nombre_contacto" id="e-primer_nombre_contacto" placeholder="Primer nombre">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Segundo nombre</label>
        <input type="text" class="form-control" name="e-segundo_nombre_contacto" id="e-segundo_nombre_contacto" placeholder="Segundo nombre">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Primer Apellido</label>
        <input type="text" class="form-control" name="e-primer_apellido_contacto" id="e-primer_apellido_contacto" placeholder="Primer Apellido">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Segundo Apellido</label>
        <input type="text" class="form-control" name="e-segundo_apellido_contacto" id="e-segundo_apellido_contacto" placeholder="Segundo Apellido">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Télefono</label>
        <input type="text" class="form-control" name="e-telefono_contacto" id="e-telefono_contacto" maxlength="35" placeholder="Télefono" required>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mb-1">
        <label class="form-label">Ocupación</label>
        <select class="form-control select2 custom-select" name="e-ocupacion_contacto" id="e-ocupacion_contacto" data-placeholder="Elija uno" style="width: 100%!important">
            @foreach($ocupaciones as $ocupacion)
                <option value="{{$ocupacion->ocupacion_id}}">{{$ocupacion->nombre}}</option>
            @endforeach
        </select>
    </div>
</div>