<?php

namespace App\Http\Controllers\Control;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;

class CUsuario extends Controller{
    public function susuario(Request $r) {
    	$us=new \App\Modelo\Usuario();
		$us->tiposdocumento_id=$r->input('td');
		$us->nrodocumento=$r->input('nd');
		$us->pais_id=$r->input('pa');
		$us->primernombre=$r->input('pn');
		$us->segundonombre=$r->input('sn');
		$us->primeroapellido=$r->input('ap');
		$us->segundoapellido=$r->input('am');
		$us->fecnacimiento=$r->input('fn');
		$us->paisdireccion_id=$r->input('pad');
		$us->departamento_id=$r->input('dep');
		$us->provincia_id=$r->input('pro');
		$us->distrito_id=$r->input('dis');
		$us->direccion=$r->input('dir');
		$us->ocupacion_id=$r->input('oc');
		$us->personaexpuesta=$r->input('pe');
		$us->cargo=$r->input('cargo');
		$us->lugar_de_trabajo=$r->input('lugar_de_trabajo');
		$us->personal=1;
		$us->empresa=0;

		if($r->hasFile("documento_frente")){
			$us->documento_frente=rand(1000000, 100000000).'_documento_frente.'.$r->File('documento_frente')->extension();
			$r->File('documento_frente')->move(public_path().'/assets/documentos/',$us->documento_frente);;
		}
		if($r->hasFile("documento_dorso")){
			$us->documento_dorso=rand(1000000, 100000000).'_documento_dorso.'.$r->File('documento_dorso')->extension();
			$r->File('documento_dorso')->move(public_path().'/assets/documentos/',$us->documento_dorso);;
		}

		$us->familiar_expuesto = $r->input('exp_fam');
		$us->tipo_doc_fam_expuesto = $r->input('tipo_doc_fam');
		$us->num_doc_fam_expuesto = $r->input('num_doc_fam');
		$us->nombre_fam_expuesto = $r->input('nombre_fam');
		$us->apellido_fam_expuesto = $r->input('apellido_fam');
		$us->cargo_fam_expuesto = $r->input('cargo_fam');
		$us->lugar_de_trabajo_fam_expuesto = $r->input('lugar_de_trabajo_fam');

		$us->save();

		$user=\Auth::User();
		$user->userid=$r->input('cel');
		$user->actkey=$r->input('cel1');
		$user->user_home_path=$r->input('cel2');
		$user->userlevel=1;
		$user->firstname=$us->primernombre;
		$user->lastname=$us->primeroapellido;
		$user->usuario_id=$us->usuario_id;
		$user->save();

    	return redirect("home");
    }

    public function uusuario(Request $r,$i) {
    	$us=\App\Modelo\Usuario::find($i);
    	$us->tiposdocumento_id=$r->input('td');
		$us->nrodocumento=$r->input('nd');
		$us->primernombre=$r->input('pn');
		$us->segundonombre=$r->input('sn');
		$us->primeroapellido=$r->input('ap');
		$us->segundoapellido=$r->input('am');
		$us->fecnacimiento=$r->input('fn');
		$us->direccion=$r->input('dir');
		$us->departamento_id=$r->input('dep');
		$us->provincia_id=$r->input('pro');
		$us->distrito_id=$r->input('dis');
		$us->ocupacion_id=$r->input('oc');
		$us->personaexpuesta=$r->input('pe');
		$us->cargo=$r->input('cargo');
		$us->lugar_de_trabajo=$r->input('lugar_de_trabajo');
		$us->familiar_expuesto = $r->input('exp_fam');
		$us->tipo_doc_fam_expuesto = $r->input('tipo_doc_fam');
		$us->num_doc_fam_expuesto = $r->input('num_doc_fam');
		$us->nombre_fam_expuesto = $r->input('nombre_fam');
		$us->apellido_fam_expuesto = $r->input('apellido_fam');
		$us->cargo_fam_expuesto = $r->input('cargo_fam');
		$us->lugar_de_trabajo_fam_expuesto = $r->input('lugar_de_trabajo_fam');
		$us->save();

		$user=\Auth::User();
		$user->userid=$r->input('cel');
		$user->actkey=$r->input('cel1');
		$user->user_home_path=$r->input('cel2');
		$user->firstname=$us->primernombre;
		$user->lastname=$us->primeroapellido;
		$user->save();
    	return "Actualizado Correctamente";
    }
    function lusuario(){
    	$ls=\App\Modelo\Usuario::with("tiposdocumento","pais","paisdireccion","ocupacion","cuenta","user")->where('usuario_id', "!=", 1)->get();
    	return view("admin.lusuario",compact("ls"));
    }
    function pusuario($id){
    	$us=\App\User::where("usuario_id",$id)->first();
    	if(!is_null($us)){
    		return view("admin.datos",compact("us"));
    	}else{
    		return "Usuario Eliminado";
    	}
    }
    function dusuario($id){
		$us=User::where("usuario_id",$id)->first();
		$us->userlevel=!$us->userlevel;
		$us->save();
		return $us->usuario_id;
    }
    function ausuario(Request $r,$id){
    	$us=\App\User::find($id);
		$us->password=bcrypt($r->ps);
		$us->save();
		return "Actualizado Correctamente";
    }
    function putipo($id){
    	$us=\App\User::where("usuario_id",$id)->first();
    	if(!is_null($us)){
    		return view("admin.putipo",compact("us"));
    	}else{
    		return "Usuario Eliminado";
    	}
    }
    function uutipo(Request $r,$id){
		$us=\App\User::find($id);
		$us->regdate=$r->Input("regdate");
		$us->timestamp=$r->Input("timestamp");
		$us->previous_visit=$r->Input("previous_visit");
		$us->save();
		
		DB::insert('insert into tipocambio_aux (compra, venta, id_user, hora_seteado) values ('.$r->Input("timestamp").', '.$r->Input("previous_visit").', '.$id.', "'.date('H:i:s').'")');

		return "Actualizado Correctamente";
	}
	
	
	public function susuario_empresa(Request $r) {
		$us=new \App\Modelo\Usuario();
		
		$us->ruc=$r->input('nr');
		$us->razon_social=$r->input('rz');
		$us->giro_negocio=$r->input('gn');

		$us->primernombre=$r->input('pn');
		$us->segundonombre=$r->input('sn');
		$us->primeroapellido=$r->input('ap');
		$us->segundoapellido=$r->input('am');
		$us->tiposdocumento_id=$r->input('td');
		$us->nrodocumento=$r->input('nd');
		$us->ocupacion_id=$r->input('oc');

		$us->paisdireccion_id=$r->input('pad');
		$us->departamento_id=$r->input('dep');
		$us->provincia_id=$r->input('pro');
		$us->distrito_id=$r->input('dis');
		$us->direccion=$r->input('dirf');
		$us->telefono=$r->input('tel');
		$us->correo_electronico=$r->input('correo');

		$us->primernombre_c=$r->input('pnc');
		$us->segundonombre_c=$r->input('snc');
		$us->primerapellido_c=$r->input('apc');
		$us->segundoapellido_c=$r->input('amc');
		$us->tiposdocumentoc_id=$r->input('tdc');
		$us->nrodocumento_c=$r->input('ndc');
		$us->telefono_c=$r->input('telc');
		$us->ocupacion_c_id=$r->input('oc_c');

		$us->pais_id=1;//Se lo pongo por defecto a Peru
		$us->personal=0;
		$us->empresa=1;

		$us->unico_beneficiario_final = $r->input('no_participacion');
		$us->beneficiario_participacion = $r->input('more_participacion');

		if($r->hasFile("documento_frente")){
			$us->documento_frente=rand(1000000, 100000000).'_documento_frente.'.$r->File('documento_frente')->extension();
			$r->File('documento_frente')->move(public_path().'/assets/documentos/',$us->documento_frente);;
		}
		if($r->hasFile("documento_dorso")){
			$us->documento_dorso=rand(1000000, 100000000).'_documento_dorso.'.$r->File('documento_dorso')->extension();
			$r->File('documento_dorso')->move(public_path().'/assets/documentos/',$us->documento_dorso);;
		}
		if($r->hasFile("ficha_ruc")){
			$us->ficha_ruc=rand(1000000, 100000000).'_ficha_ruc.'.$r->File('ficha_ruc')->extension();
			$r->File('ficha_ruc')->move(public_path().'/assets/documentos/',$us->ficha_ruc);;
		}

		$us->save();

		foreach ($r->input('beneficiario_nombre') as $key => $nombre) {
			$beneficiario = new \App\Modelo\EmpresaBeneficiario();
			$beneficiario->usuario_id = $us->usuario_id;
			$beneficiario->beneficiario_nombre = $nombre;
			$beneficiario->tiposdocumento_id = $r->input('beneficiario_documento_tipo')[$key];
			$beneficiario->nrodocumento = $r->input('beneficiario_documento_numero')[$key];
			$beneficiario->paisdireccion_id = $r->input('beneficiario_nacionalidad')[$key];
			$beneficiario->save();
		}

		$user=\Auth::User();
		/*
		$user->userid=$r->input('cel');
		$user->actkey=$r->input('cel1');
		$user->user_home_path=$r->input('cel2');
		*/

		$user->userlevel=1;
		$user->firstname=$us->primernombre;
		$user->lastname=$us->primeroapellido;
		$user->usuario_id=$us->usuario_id;

		$user->save();

    	return redirect("home");
	}
	
	public function uusuario_empresa(Request $r, $i) {
		$us=\App\Modelo\Usuario::find($i);

		$us->ruc=$r->input('nr');
		$us->razon_social=$r->input('rz');
		$us->giro_negocio=$r->input('gn');

		$us->primernombre=$r->input('pn');
		$us->segundonombre=$r->input('sn');
		$us->primeroapellido=$r->input('ap');
		$us->segundoapellido=$r->input('am');
		$us->tiposdocumento_id=$r->input('td');
		$us->nrodocumento=$r->input('nd');
		$us->ocupacion_id=$r->input('oc');

		$us->departamento_id=$r->input('dep');
		$us->provincia_id=$r->input('pro');
		$us->distrito_id=$r->input('dis');
		$us->direccion=$r->input('dirf');
		$us->telefono=$r->input('tel');
		$us->correo_electronico=$r->input('correo');

		$us->primernombre_c=$r->input('pnc');
		$us->segundonombre_c=$r->input('snc');
		$us->primerapellido_c=$r->input('apc');
		$us->segundoapellido_c=$r->input('amc');
		$us->tiposdocumentoc_id=$r->input('tdc');
		$us->nrodocumento_c=$r->input('ndc');
		$us->telefono_c=$r->input('telc');
		$us->ocupacion_c_id=$r->input('oc_c');

		$us->personal=0;
		$us->empresa=1;

		$us->unico_beneficiario_final = $r->input('unico_beneficiario_final');
		$us->beneficiario_participacion = $r->input('beneficiario_participacion');
		
		$us->save();

		\App\Modelo\EmpresaBeneficiario::where('usuario_id', $us->usuario_id)->delete();
		foreach ($r->input('beneficiario_nombre') as $key => $nombre) {
			$beneficiario = new \App\Modelo\EmpresaBeneficiario();
			$beneficiario->usuario_id = $us->usuario_id;
			$beneficiario->beneficiario_nombre = $nombre;
			$beneficiario->tiposdocumento_id = $r->input('beneficiario_documento_tipo')[$key];
			$beneficiario->nrodocumento = $r->input('beneficiario_documento_numero')[$key];
			$beneficiario->paisdireccion_id = $r->input('beneficiario_nacionalidad')[$key];
			$beneficiario->save();
		}

		$user=\Auth::User();
		/*
		$user->userid=$r->input('cel');
		$user->actkey=$r->input('cel1');
		$user->user_home_path=$r->input('cel2');
		*/
		$user->firstname=$us->primernombre;
		$user->lastname=$us->primeroapellido;
		$user->save();
    	return "Actualizado Correctamente";
    }
	
	public function saveUserOperacionManual(Request $request)
	{
	    $userAux = User::where('email', $request->email)->orWhere('username', $request->username)->first();
		if ($userAux) {
		    if (is_null($userAux->usuario_id)) {
				return response()->json([
					'success' => false,
					'message' => 'El usuario ya existe pero no tiene ninguna cuenta asignada',
					'user' => $userAux,
				]);
			}
			if ($userAux->usuario->personal == 1) {
				$userData = $userAux->usuario->primernombre ?? '' . ' ' . $userAux->usuario->segundonombre ?? '' . ' ' . $userAux->usuario->primeroapellido ?? '' . ' ' . $userAux->usuario->segundoapellido ?? '';
			}
			else {
				$userData = $userAux->usuario->razon_social ?? '' . ' ' . $userAux->usuario->ruc ?? '';
			}

			return response()->json([
				'success' => false,
				'message' => 'El usuario ya existe: ' . $userData,
				'user' => $userAux,
				'usuario' => $userAux->usuario
			]);
		}

		$user = new User();
		$user->username = $request->username;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);

		if ($request->user_type == 'personal') {
			$user->firstname = $request->p_primer_nombre;
			$user->lastname = $request->p_primero_apellido;
		}

		if ($request->user_type == 'personal') {
			$usuario->primernombre = $request->p_primer_nombre;
			$usuario->segundonombre = $request->p_segundo_nombre;
			$usuario->primeroapellido = $request->p_primero_apellido;
			$usuario->segundoapellido = $request->p_segundo_apellido;
			$usuario->tiposdocumento_id = $request->p_tipo_documento;
			$usuario->nrodocumento = $request->p_numero_documento;
			$usuario->fecnacimiento = $request->p_fecha_nacimiento;

			$usuario->pais_id = $request->p_pais;
			$usuario->paisdireccion_id = $request->p_pais;
			$usuario->departamento_id = $request->p_departamento;
			$usuario->provincia_id = $request->p_provincia;
			$usuario->distrito_id = $request->p_distrito;
			$usuario->direccion = $request->p_direccion;

			$usuario->ocupacion_id = $request->p_ocupacion;
			$usuario->personaexpuesta = $request->p_persona_expuesta;
			$usuario->cargo = $request->p_cargo;
			$usuario->lugar_de_trabajo = $request->p_lugar_de_trabajo;
			$usuario->personal = 1;
			$usuario->empresa = 0;

			$usuario->familiar_expuesto = $request->p_persona_expuesta_fam;
			$usuario->tipo_doc_fam_expuesto = $request->p_tipo_doc_fam;
			$usuario->num_doc_fam_expuesto = $request->p_num_doc_fam;
			$usuario->nombre_fam_expuesto = $request->p_nombre_fam;
			$usuario->apellido_fam_expuesto = $request->p_apellido_fam;
			$usuario->cargo_fam_expuesto = $request->p_cargo_fam;
			$usuario->lugar_de_trabajo_fam_expuesto = $request->p_lugar_de_trabajo_fam;

			$user->userid = $request->p_celular;
			$user->actkey = $request->p_celular1;
			$user->user_home_path = $request->p_celular2;
		}
		else if ($request->user_type == 'empresa') {
			$usuario->ruc = $request->e_numero_ruc;
			$usuario->razon_social = $request->e_razon_social;
			$usuario->giro_negocio = $request->e_giro_negocio;
			$usuario->direccion = $request->e_direccion_fiscal;
			$usuario->pais_id = $request->e_pais;
			$usuario->paisdireccion_id = $request->e_pais;
			$usuario->departamento_id = $request->e_departamento;
			$usuario->provincia_id = $request->e_provincia;
			$usuario->distrito_id = $request->e_distrito;
			$usuario->correo_electronico = $request->e_correo;
			$usuario->telefono = $request->e_telefono;

			$usuario->primernombre = $request->e_primer_nombre;
			$usuario->segundonombre = $request->e_segundo_nombre;
			$usuario->primeroapellido = $request->e_primero_apellido;
			$usuario->segundoapellido = $request->e_segundo_apellido;
			$usuario->tiposdocumento_id = $request->e_tipo_documento;
			$usuario->nrodocumento = $request->e_numero_documento;
			$usuario->ocupacion_id = $request->e_ocupacion;
			
			$usuario->primernombre_c = $request->e_primer_nombre_contacto;
			$usuario->segundonombre_c = $request->e_segundo_nombre_contacto;
			$usuario->primerapellido_c = $request->e_primero_apellido_contacto;
			$usuario->segundoapellido_c = $request->e_segundo_apellido_contacto;
			$usuario->tiposdocumentoc_id = $request->e_tipo_documento_contacto;
			$usuario->nrodocumento_c = $request->e_numero_documento_contacto;
			$usuario->telefono_c = $request->e_telefono_contacto;
			$usuario->ocupacion_c_id = $request->e_ocupacion_contacto;
			$usuario->personal = 0;
			$usuario->empresa = 1;
		}

		if($request->hasFile("documento_frente")){
			$usuario->documento_frente=rand(1000000, 100000000).'_documento_frente.'.$request->File('documento_frente')->extension();
			$request->File('documento_frente')->move(public_path().'/assets/documentos/',$usuario->documento_frente);;
		}
		if($request->hasFile("documento_dorso")){
			$usuario->documento_dorso=rand(1000000, 100000000).'_documento_dorso.'.$request->File('documento_dorso')->extension();
			$request->File('documento_dorso')->move(public_path().'/assets/documentos/',$usuario->documento_dorso);;
		}
		if($request->hasFile("ficha_ruc")){
			$usuario->ficha_ruc=rand(1000000, 100000000).'_ficha_ruc.'.$request->File('ficha_ruc')->extension();
			$request->File('ficha_ruc')->move(public_path().'/assets/documentos/',$usuario->ficha_ruc);;
		}

		$usuario->save();

		$user->usuario_id = $usuario->usuario_id;
		$user->userlevel = 1;
		$user->email_verified_at = now();
		$user->save();
		
		$role = \App\Groups::find(3);
        $user->group()->save($role);

		return response()->json([
			'success' => true,
			'user' => $user,
			'usuario' => $usuario
		]);
	}
}
