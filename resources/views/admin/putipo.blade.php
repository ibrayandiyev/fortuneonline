<input type="text" id="id" value="{{$us->id}}" hidden>
<h3>{{$us->username}} | {{$us->firstname}} {{$us->lastname}}</h3>
<form action="/" id="tc">
	<table class="table">
		<tr class="d-none">
			<th>Estado</th>
			<th>
				<select name="regdate" class="form-control select2 custom-select">
					<option value="1" selected>Activo</option>
				</select>
			</th>
		</tr>
		<tr>
			<th>Compra</th>
			<th><input type="text" name="timestamp" class="form-control" value="{{$us->timestamp}}" required></th>
		</tr>
		<tr>
			<th>Venta</th>
			<th><input type="text" name="previous_visit" class="form-control" value="{{$us->previous_visit}}" required></th>
		</tr>
		<tr>
			<th><span class="label label-warning" id="msg"></span></th>
			<th><input type="submit" class="btn btn-primary" value="Actualizar"></th>
		</tr>
	</table>
</form>