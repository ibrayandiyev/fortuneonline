{{-- //TODO: vistas copiadas de fortune.. APARENTEMENTE ESTA NI SE USA --}}
@php 
function departamento($id){
	$dp=\App\Modelo\Ubigeo::where("dDepartamento",$id)->where("codProvincia",0)->where("codDistrito",0)->first();
	return $dp->Descripcion;
}
function provincia($dp,$pr){
	$pro=\App\Modelo\Ubigeo::where("dDepartamento",$dp)->where("codProvincia",$pr)->where("codDistrito",0)->first();
	return $pro->Descripcion;
}
function distrito($dp,$pr,$ds){
	$dis=\App\Modelo\Ubigeo::where("dDepartamento",$dp)->where("codProvincia",$pr)->where("codDistrito",$ds)->first();
	return $dis->Descripcion;
}
@endphp

<table class="table">
	<tr>
		<th>Correo</th>
		<td>{{$us->email}}</td>		
	</tr>
	<tr>
		<th>Telefono</th>
		<td>{{$us->userid}} <br>
			{{$us->actkey}} <br>
			{{$us->user_home_path}}</td>
	</tr>
	<tr>
		<th>Departamento</th>
		<td>{{departamento($us->usuario->departamento_id)}}</td>
	</tr>
	<tr>
		<th>Provincia</th>
		<td>{{provincia($us->usuario->departamento_id,$us->usuario->provincia_id)}}</td>
	</tr>
	<tr>
		<th>Distrito</th>
		<td>{{distrito($us->usuario->departamento_id,$us->usuario->provincia_id,$us->usuario->distrito_id)}}</td>
	</tr>
	<tr>
		<th>Estado <a href="#" onclick="dusuario({{$us->id}})"><i class="fas fa-edit"></i></a></th>
		<td>{{$us->userlevel ? "Activo":"Inactivo"}}</td>
	</tr>
	<tr>
		<th>Contraseña</th>
		<th><input type="password" class="form-control" id="ps"></th>
	</tr>

	<tr>
		<td><span class="label label-warning" id="msg">Actualiza la Contraseña de este Usuario</span></td>
		<th><a href="#" class="btn btn-success" onclick="Actuliza({{$us->id}})">Actualizar</a></th>
	</tr>
</table>