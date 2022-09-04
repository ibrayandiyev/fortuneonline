@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/css/alertify.min.css">
@endpush
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body bg-primary">
                <div class="dash-widget text-center">
                    <h3 class="font-weight-extrabold">Tipo de cambio</h3>
                    <h4>Preferencial</h4>                                      
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget text-center">
                    <p>COMPRA</p>
                    <div class="col">
                        <p class="mt-1 mb-1"><i class="fas fa-arrow-circle-down text-danger"></i> <h3 class="font-weight-extrabold pure">0.00</h3> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget text-center">
                    <p>VENTA</p>
                    <div class="col">
                        <p class="mt-1 mb-1"><i class="fas fa-arrow-circle-up text-success"></i> <h3 class="font-weight-extrabold sale">0.00</h3></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/alertify.min.js"></script>
<script>
	var dc=<?php echo \Auth::User()->timestamp ?>;
    var dv=<?php echo \Auth::User()->previous_visit ?>;
    var cam=0.00;
    var cron=900;
    var pref=true;
    $(".pure").html(dc);
    $(".sale").html(dv);
    //timestamp dc
    //previous_visit dv
    //regdate 1,0
</script>
@endpush