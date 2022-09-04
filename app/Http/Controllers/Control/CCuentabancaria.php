<?php

namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CCuentabancaria extends Controller{
    public function scuentasbancaria(Request $r){
    	if(!is_null(Auth::User()->usuario_id)){
        $cb=new \App\Modelo\Cuentabancaria();
        $cb->usuario_id=Auth::User()->usuario_id;
        $cb->banco_id=$r->input('ba');
        $cb->tipocuenta_id=$r->input('ti');
        $cb->moneda_id=$r->input('mo');
        $cb->nrocuenta=$r->input('nu');
        $cb->nrocuentacci=$r->input('nucci');
        $cb->alias=$r->input('al');
        $cb->cuentapropia=$r->input('cp');

        //Agregue estos nuevos para cuando la cuenta no es propia
        $cb->nombre=$r->input('nombre');
        $cb->tiposdocumento_id=$r->input('tipo_doc');
        $cb->nro_documento=$r->input('numero_doc');

        if($r->input('autorizo_deposito') == "on"){
          $cb->autorizo_deposito = 1;
        }

        $cb->save();
        return redirect('cuentasbancarias');

         //Antes se retornaba a una vista especifica para ver las cuentas bancarias
         // return redirect('lcuentasbancaria');
      
    	}else{
    		return redirect('personal_o_empresa');
    	}
    }
    public function ucuentasbancaria(Request $r,$i){
      if(!is_null(Auth::User()->usuario_id)){
        $cb=\App\Modelo\Cuentabancaria::find($i);
        $cb->usuario_id=Auth::User()->usuario_id;
        $cb->banco_id=$r->input('ba');
        $cb->tipocuenta_id=$r->input('ti');
        $cb->moneda_id=$r->input('mo');
        $cb->nrocuenta=$r->input('nu');
        $cb->nrocuentacci=$r->input('nucci');
        $cb->alias=$r->input('al');
        $cb->cuentapropia=$r->input('cp');

        //Agregue estos nuevos para cuando la cuenta no es propia
        $cb->nombre=$r->input('nombre');
        $cb->tiposdocumento_id=$r->input('tipo_doc');
        $cb->nro_documento=$r->input('numero_doc');

        if($r->input('autorizo_deposito') == "on"){
          $cb->autorizo_deposito = 1;
        }
        else{
          $cb->autorizo_deposito = null;
        }

        $cb->save();
        return redirect('cuentasbancarias');

        //Antes se retornaba a una vista especifica para ver las cuentas bancarias
        // return redirect('lcuentasbancaria');
      }else{
        return redirect('personal_o_empresa');
      }
    }
    public function lcuentasbancaria(){
    	$ls=\App\Modelo\Cuentabancaria::with("tipo","banco","moneda")->where("usuario_id",Auth::User()->usuario_id)->get();
    	return view('admin.lcuentasbancarias',compact("ls"));
    }
    public function dcuentasbancaria($i){
      $ls=\App\Modelo\Cuentabancaria::find($i);
      $ls->delete();
      return "Eliminado Correctamente";
    }
    public function fcuentasbancaria($i){
      $ls=\App\Modelo\Cuentabancaria::find($i);
      return view("admin.ucuentasbancarias",compact("ls"));
    }

    public function saveAccountOperacionManual(Request $request)
    {
        if(!$request->usuario_id){
          return response()->json([
            'success' => false,
            'message' => 'El usuario es requerido'
          ]);
        }

        $cuentaBancaria = new \App\Modelo\Cuentabancaria();
        $cuentaBancaria->usuario_id = $request->usuario_id;
        $cuentaBancaria->banco_id = $request->banco_id;
        $cuentaBancaria->tipocuenta_id = $request->tipo_cuenta_id;
        $cuentaBancaria->moneda_id = $request->moneda_id;
        $cuentaBancaria->nrocuenta = $request->numero_cuenta;
        $cuentaBancaria->nrocuentacci = $request->numero_cuenta_cci;
        $cuentaBancaria->alias = $request->alias;
        $cuentaBancaria->cuentapropia = $request->cuenta_propia;

        if ($request->cuenta_propia == 0) {
          $cuentaBancaria->nombre = $request->nombre;
          $cuentaBancaria->tiposdocumento_id = $request->tipo_documento_id;
          $cuentaBancaria->nro_documento = $request->numero_documento;
        }

        if($request->input('autorizo_deposito') == "on"){
          $cuentaBancaria->autorizo_deposito = 1;
        }

        $cuentaBancaria->save();

        $cuentaBancariaFullData = \App\Modelo\Cuentabancaria::with("tipo","moneda","banco")->where("cuentabancaria_id", $cuentaBancaria->cuentabancaria_id)->first();

        return response()->json([
          'success' => true,
          'account' => $cuentaBancariaFullData,
        ]);
    }

    public function getAccountsOperacionManual($userId)
    {
      if (!$userId) {
        return response()->json([
          'success' => false,
          'message' => 'El usuario es requerido'
        ]);
      }

      $accounts = \App\Modelo\Cuentabancaria::with("tipo", "moneda", "banco")->join('banco', 'banco.banco_id', 'cuentabancaria.banco_id')->where('banco.is_active', 1)->where("usuario_id", $userId)->get();

      return response()->json([
        'success' => true,
        'accounts' => $accounts
      ]);
    }
}
