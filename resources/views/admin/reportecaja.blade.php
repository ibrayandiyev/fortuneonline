@extends('layouts.app')

@push('css')
    <link href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/css/alertify.min.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Caja inicial del d铆a</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('reporte-caja-save') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="initial_box_pen">Caja inicial PEN S/</label>
                                    <input type="text" name="initial_box_pen" id="initial_box_pen" class="form-control allow_numeric_with_decimal" placeholder="Ingrese la caja inicial de soles" value="{{ \Cache::get('initial_box_pen', '0') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="initial_box_dol">Caja inicial DOL USD</label>
                                    <input type="text" name="initial_box_dol" id="initial_box_dol" class="form-control allow_numeric_with_decimal" placeholder="Ingrese la caja inicial de dólares" value="{{ \Cache::get('initial_box_dol', '0') }}" required>
                                </div>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 text-left">
                                <a class="btn btn-info cursor-pointer" id="btn-download-report">
                                    Descargar balance
                                </a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary" id="btn-save-initial-box">
                                    Guardar caja inicial
                                </button>
                                <a href="{{ route('reporte-caja-reset') }}" class="btn btn-secondary">
                                    Reiniciar caja inicial
                                </a>
                            </div>
                        </div>
                    </form>

                    <form {{ route('reporte-caja-download') }} class="d-none" method="POST" id="form-download-report">
                        @csrf

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Alertify --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/alertify.min.js"></script>

    <script>
        $( document ).ready(function() {
            $('#initial_box_pen').val( numberFormat($('#initial_box_pen').val()) );
            $('#initial_box_dol').val( numberFormat($('#initial_box_dol').val()) );
        });

        $('#btn-save-initial-box').on('click', function (event) {
            if ($('#initial_box_pen').val() == 0 || $('#initial_box_pen').val() == '0' || $('#initial_box_dol').val() == 0 || $('#initial_box_dol').val() == '0') {
                alertify.set('notifier','position', 'top-right');
                alertify.error("Debe ingresar los valores de caja iniciales");
                event.preventDefault();
            }

            $('#initial_box_pen').val( parseFloat($('#initial_box_pen').val().replace(/,/, '')) );
            $('#initial_box_dol').val( parseFloat($('#initial_box_dol').val().replace(/,/, '')) );
        })

        $('#btn-download-report').on('click', function() {
            $.ajax({
                url: "{{ route('reporte-caja-download') }}",
                type: "GET",
                xhrFields: {
                    responseType: 'blob',
                },
                success: function(result, status, xhr) {
                    var today = new Date();
                    var date = today.getFullYear() + '-' + (today.getMonth()+1) + '-' + today.getDate();
                    var hour = today.getHours() + "-" + today.getMinutes() + "-" + today.getSeconds();

                    const fileName = 'BALANCE ' + date + ' ' + hour + '.xlsx';

                    var disposition = xhr.getResponseHeader('content-disposition');
                    var matches = /"([^"]*)"/.exec(disposition);
                    var filename = (matches != null && matches[1] ? matches[1] : fileName);

                    // The actual download
                    var blob = new Blob([result], {
                        type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = filename;

                    document.body.appendChild(link);

                    link.click();
                    document.body.removeChild(link);
                }
            });
        });
    </script>

    <script>
        $(".allow_numeric_with_decimal").on("keypress keyup blur",function (event) {
            $(this).val($(this).val().replace(/[^0-9\.|\,]/g,''));
            if (
                (event.which != 46 || $(this).val().indexOf('.') != -1)
                && 
                (event.which != 44)
                && 
                (event.which < 48 || event.which > 57 || event.whitch === 188 || event.which === 110)) {
                event.preventDefault();
            }
        });
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
@endsection