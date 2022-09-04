@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/css/alertify.min.css">
@endpush
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    TIPO DE CAMBIO
                    <h5>del díaa</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card bg-success text-center">
            <div class="card-body">
                <div class="dash-widget textocambio">

                    <div class="col">
                        <p class="mt-1 mb-1"><i class="fas fa-arrow-circle-down text-danger"></i> <h3 class="font-weight-extrabold pure">0.00</h3> </p>
                    <p>FORTUNE COMPRA</p>

					</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget textocambio">

                    <div class="col">
                        <p class="mt-1 mb-1"><i class="fas fa-arrow-circle-up text-success"></i> <h3 class="font-weight-extrabold sale">0.00</h3></p>
                  <p>FORTUNE VENDE</p>

				  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.11.4/alertify.min.js"></script>
<script>
	var dc=0.00;
    var dv=0.00;
    var cam=0.00;
    var cron=900;
    var pref=false;
    $(document).ready(function(){
    	$.get("ftipocambio",function (msg) {
    		dc=eval(msg.compra);
    		dv=eval(msg.venta);
    		$(".pure").html(dc);
        	$(".sale").html(dv);
    	});
    	function tipocambio() {
    		if(cron===0){
    			$.get("ftipocambio",function (msg) {
		    		dc=eval(msg.compra);
		    		dv=eval(msg.venta);
		    		$(".pure").html(dc);
		        	$(".sale").html(dv);
		        	alertify.alert('Ha caducado el tiempo', '¡Actualizaremos las tasas!', function(){
                        alertify.success('Ok');
                        location.reload();
                    });
		    	});
    		}else{
    			cron-=1;
                var tim=parseInt(cron/60)+":"+(cron%60);
    			$('.cronometro').html(tim);
    		}
    	}
    	setInterval(tipocambio, 1000);
    });
</script>
@endpush
