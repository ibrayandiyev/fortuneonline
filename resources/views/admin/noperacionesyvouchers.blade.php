<div>
	<table class="table">
        <tr>
            <div class="form-group">
                <input type="number" class="form-control" id="num_ope" placeholder="Ingrese el numero de operación" value="{{$ope->num_ope}}">
            </div>
        </tr>
		<tr>
			<div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input vouchers" id="vou" accept="image/png, .jpeg, .jpg, image/gif">
                    <label class="custom-file-label">@if(isset($ope->voucher)) {{$ope->voucher}} @else Elegir archivo @endif</label>
                </div>
            </div>
        </tr>

        <tr>
            <div class="form-group">
                <input type="number" class="form-control" id="num_ope2" placeholder="Ingrese el numero de operación" value="{{$ope->num_ope2}}">
            </div>
        </tr>
		<tr>
			<div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input vouchers" id="vou2" accept="image/png, .jpeg, .jpg, image/gif">
                    <label class="custom-file-label">@if(isset($ope->voucher2)) {{$ope->voucher2}} @else Elegir archivo @endif</label>
                </div>
            </div>
        </tr>

        <tr>
            <div class="form-group">
                <input type="number" class="form-control" id="num_ope3" placeholder="Ingrese el numero de operación" value="{{$ope->num_ope3}}">
            </div>
        </tr>
		<tr>
			<div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input vouchers" id="vou3" accept="image/png, .jpeg, .jpg, image/gif">
                    <label class="custom-file-label">@if(isset($ope->voucher3)) {{$ope->voucher3}} @else Elegir archivo @endif</label>
                </div>
            </div>
        </tr>

        <tr>
            <div class="form-group">
                <input type="number" class="form-control" id="num_ope4" placeholder="Ingrese el numero de operación" value="{{$ope->num_ope4}}">
            </div>
        </tr>
		<tr>
			<div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input vouchers" id="vou4" accept="image/png, .jpeg, .jpg, image/gif">
                    <label class="custom-file-label">@if(isset($ope->voucher4)) {{$ope->voucher4}} @else Elegir archivo @endif</label>
                </div>
            </div>
		</tr>
	</table>
</div>

<script>
    $('.vouchers').on('change',function(e){
        //get the file name
        var fileName = e.target.files[0].name;
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
</script>