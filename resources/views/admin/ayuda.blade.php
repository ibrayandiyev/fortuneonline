@extends('layouts.app')

@push('css')
    <!-- select2 Plugin -->
    <link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
    <!--mutipleselect css-->
    <link href="{{asset('assets/plugins/multipleselect/multiple-select.css')}}" rel="stylesheet">
@endpush



@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
<img src="{{asset('assets/images/ayuda.png')}}" alt="img">
                </div>

                <div class="card-body">
                    <div id="accordion" class="w-100 ">
                        <div class="card mb-0 border">
                            <div class="accor bg-primary" id="headingOne">
                                <h5 class="m-0">
                                    <a href="#collapseOne" class="text-white" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                                    ¿Qué divisas aceptan?
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                    Solo aceptamos dólares.
                                </div>
                            </div>
                        </div>

                        <div class="card mb-0 border">
                            <div class="accor  bg-primary" id="headingTwo">
                                <h5 class="m-0">
                                    <a href="#collapseTwo" class="collapsed text-white" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
                                      ¿Aceptan depósitos en sus cuentas privadas?
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse b-b0" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                No, manejamos una cuenta directa por medio de nuestro sistema.
                                </div>
                            </div>
                        </div>

                        <div class="card border mb-0">
                            <div class="accor  bg-primary" id="headingThree">
                                <h5 class="m-0">
                                    <a href="#collapseThree" class="collapsed text-white" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree">
                                      ¿Cuánto tarda la transacción?
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse b-b0" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                  Nuestros cambios son de manera inmediata e interbancaria.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

@endsection
