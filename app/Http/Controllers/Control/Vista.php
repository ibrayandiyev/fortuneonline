<?php

namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Vista extends Controller{
	public function cuentasbancarias(){
		$ls=\App\Modelo\Cuentabancaria::with("tipo","banco","moneda")->where("usuario_id",Auth::User()->usuario_id)->get();
		return view('admin.cuentasbancarias', compact("ls"));
	}
    public function operacion(){
		return view('admin.operacion');
	}
	public function reportesbs(){
		$ls=\App\Modelo\Operacion::with("cuentabancariae","cuentabancariat","cuentabancariad","cuentabancariat","monedae","monedad","usuario","origen_fondo")->whereBetween('created_at', [now()->subdays(35)->startOfDay(), now()->endOfDay()])->where("estado",2)->get();
		return view('admin.reportesbs',compact("ls"));
	}
	public function reporte(){
		$ls=\App\Modelo\Operacion::with("cuentabancariae","cuentabancariat","cuentabancariad","cuentabancariat","monedae","monedad","usuario")->whereBetween('created_at', [now()->subdays(30)->startOfDay(), now()->endOfDay()])->get();
		return view('admin.historial',compact("ls"));
	}
	public function historial(){
		$ls=\App\Modelo\Operacion::with("cuentabancariae","cuentabancariat","cuentabancariad","cuentabancariat","monedae","monedad","usuario")->where("usuario_id",Auth::User()->usuario_id)->get();
		return view('admin.historial',compact("ls"));
	}
	public function ayuda(){
		return view('admin.ayuda');
	}    
    public function empresa(){
		return view('admin.empresa');
	}
	public function tipocambio(){
		return view('admin.tipocambio');
	}
	public function perfil(){		
		if(!is_null(Auth::User()->usuario_id)){
			return view('admin.perfil');
		}else{
    		return redirect('personal_o_empresa');/*decia: usuario */
    	}
	} 
	public function usuario(){
		if(is_null(Auth::User()->usuario_id)){
			return view('admin.usuario');
		}else{
    		return redirect('perfil');
    	}		
	} 
	public function personal_o_empresa(){
		if(is_null(Auth::User()->usuario_id)){
			return view('admin.personal_o_empresa');
		}else{
    		return redirect('perfil');
    	}		
	} 
	public function usuario_empresa(){
		if(is_null(Auth::User()->usuario_id)){
			return view('admin.usuario_empresa');
		}else{
    		return redirect('perfil');
    	}		
	} 
}
