<?php

namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelo\CodigoDescuento;
use App\Modelo\Operacion;
use App\Modelo\Usuario;
use \App\Notifications\MOperacion;
use App\User;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class COperacion extends Controller{
    public function soperacion(Request $r){
        if(!is_null(Auth::User()->usuario_id)){
            $op=new \App\Modelo\Operacion();
			$op->cuentabancariae_id=$r->Input("baa");
			$op->cuentabancariad_id=$r->Input("cuenta");

            if ($r->Input("monto_con_descuento")) {
                $op->monto = $r->Input("monto_con_descuento");

                $discountCode = CodigoDescuento::where('code', $r->Input('discount_code'))->first();

                if ($discountCode) {
                    $op->discount_code = $discountCode->code;
                    $op->discount_amount = $discountCode->discount;
                }
            }
            else {
                $op->monto=$r->Input("monto");
            }

			$op->moneda_id=$r->Input("moe");
			$op->tmoneda_id=$r->Input("mor");
			$op->cuentabancariat_id=$r->Input("bar");
			
            $files = array();
            if($r->hasFile("vou")){
				$op->voucher=rand(1000000, 100000000).$r->File('vou')->getClientOriginalName();
                $r->File('vou')->move(public_path().'/assets/voucher/',$op->voucher);
                array_push($files, public_path().'/assets/voucher/'.$op->voucher);
            }
            
            if($r->hasFile("vou2")){
				$op->voucher2=rand(1000000, 100000000).$r->File('vou2')->getClientOriginalName();
                $r->File('vou2')->move(public_path().'/assets/voucher/',$op->voucher2);
                array_push($files, public_path().'/assets/voucher/'.$op->voucher2);
            }
            
            if($r->hasFile("vou3")){
				$op->voucher3=rand(1000000, 100000000).$r->File('vou3')->getClientOriginalName();
                $r->File('vou3')->move(public_path().'/assets/voucher/',$op->voucher3);
                array_push($files, public_path().'/assets/voucher/'.$op->voucher3);
            }
            
            if($r->hasFile("vou4")){
				$op->voucher4=rand(1000000, 100000000).$r->File('vou4')->getClientOriginalName();
                $r->File('vou4')->move(public_path().'/assets/voucher/',$op->voucher4);
                array_push($files, public_path().'/assets/voucher/'.$op->voucher4);
			}

			$op->cambio=$r->Input("cambio");
			$op->taza=$r->Input("compra");
			$op->origen_fondo_id=$r->Input("origen_fondo_id");

			if ($r->Input("origen_fondo_id") == 11) {
                $op->origen_fondo_otro = $r->Input("origen_fondo_otro");
            }

			$op->usuario_id=Auth::User()->usuario_id;
			$op->save();


            $userEmail = Auth::User()->email;
            $userName =  Auth::User()->usuario->empresa ? Auth::User()->usuario->razon_social : Auth::User()->usuario->primernombre.' '.Auth::User()->usuario->segundonombre. ' '.Auth::User()->usuario->primeroapellido.' '.Auth::User()->usuario->segundoapellido;

            $us=array('email' => $userEmail,'name' => $userName);

            $usuario = Usuario::find(Auth::User()->usuario_id);
            $dni = $usuario->nrodocumento;
            $tipoDocumento = $usuario->tiposdocumento->nombre;

            $data = array(
                'operacion' => \App\Modelo\Operacion::with("cuentabancariat","cuentabancariae","cuentabancariad","monedae","monedad","usuario","origen_fondo")->find($op->operacion_id),
                'admin' => 1,
                'email_cliente' => Auth::User()->email,
                'dni' => $dni,
                'tipoDocumento' => $tipoDocumento,
                'mensaje' => 'HA HECHO UNA TRANSACCIÓN'
            );
            $admin=\App\User::first();
            $rem=$admin->email;

            Mail::send('mail.operacion', $data, function ($message) use($us,$rem,$files) {
                $message->from($us['email'],$us['name']);
                $message->to($rem,'Operaciones Fortune Online')->subject('Operaciones Fortune Online');

                foreach ($files as $file){
                    $message->attach($file);
                }
            });
            
            Mail::send('mail.operacion', $data, function ($message) use($us,$rem,$files) {
                $message->from($us['email'],$us['name']);
                $message->to('administracion@fortuneonline.com','Operaciones Fortune Online')->subject('Operaciones Fortune Online');

                foreach ($files as $file){
                    $message->attach($file);
                }
            });

            return redirect('historial');
        }else{
            return redirect('personal_o_empresa');
        }
    }
    public function uoperacion($i) {
        $op=\App\Modelo\Operacion::find($i);
        $op->estado=$op->estado+1;

        switch($op->estado){
            //Si paso a estado "Procesando"
            case 1:
                $user = User::where("usuario_id", $op->usuario_id)->first();
                
                $userEmail = $user->email;
                $userName =  $user->usuario->empresa ? Auth::User()->usuario->razon_social : Auth::User()->usuario->primernombre.' '.Auth::User()->usuario->segundonombre. ' '.Auth::User()->usuario->primeroapellido.' '.Auth::User()->usuario->segundoapellido;

                $us=array('email' => $userEmail,'name' => $userName);

                $admin=\App\User::first();
                $rem=$admin->email;

                $data = array(
                    'operacion' => \App\Modelo\Operacion::with("cuentabancariat","cuentabancariae","cuentabancariad","monedae","monedad","usuario","origen_fondo")->find($op->operacion_id),
                    'mensaje' => "En estos momentos tu operación con Fortune Online esta siendo PROCESADA."
                );
                Mail::send('mail.cambioEstado', $data, function ($message) use($us,$rem) {
                        $message->to($us['email'], $us['name']);
                        $message->from($rem,'Operaciones Fortune Online')->subject('Operaciones Fortune Online');
                    });
                break;
            //Si paso a estado "Terminado"
            case 2:
                $user = User::where("usuario_id", $op->usuario_id)->first();
                
                $userEmail = $user->email;
                $userName =  $user->usuario->empresa ? Auth::User()->usuario->razon_social : Auth::User()->usuario->primernombre.' '.Auth::User()->usuario->segundonombre. ' '.Auth::User()->usuario->primeroapellido.' '.Auth::User()->usuario->segundoapellido;

                $us=array('email' => $userEmail,'name' => $userName);

                $admin=\App\User::first();
                $rem=$admin->email;

                $data = array(
                    'operacion' => \App\Modelo\Operacion::with("cuentabancariat","cuentabancariae","cuentabancariad","monedae","monedad","usuario","origen_fondo")->find($op->operacion_id),
                    'mensaje' => "Ha finalizado tu transacción exitosamente.",
                    'admin' => 0
                );
                Mail::send('mail.operacion', $data, function ($message) use($us,$rem) {
                        $message->to($us['email'], $us['name']);
                        $message->from($rem,'Operaciones Fortune Online')->subject('Operaciones Fortune Online');
                    });
                break;
        }
        $op->last_user=Auth::User()->username;
        $op->save();
        return $op;
    }
    public function doperacion($i) {
        $op=\App\Modelo\Operacion::find($i);
        $op->estado=3;
        $op->last_user=Auth::User()->username;
        $op->save();
        return "Proceso Anulado";
    }
    public function foperacion($i) {
        $op=\App\Modelo\Operacion::with("cuentabancariat","cuentabancariae","cuentabancariad","monedae","monedad","usuario","origen_fondo")->find($i);
        return view("admin.ficha",compact("op"));
    }

    public function svoucher(Request $request){

        try{
            $op=\App\Modelo\Operacion::find($request->id_operacion);
    
            if($request->hasFile("vou")){
                $op->voucher=rand(1000000, 100000000).$request->File('vou')->getClientOriginalName();
                $request->File('vou')->move(public_path().'/assets/voucher/',$op->voucher);;
            }

            if($request->hasFile("vou2")){
                $op->voucher2=rand(1000000, 100000000).$request->File('vou2')->getClientOriginalName();
                $request->File('vou2')->move(public_path().'/assets/voucher/',$op->voucher2);;
            }

            if($request->hasFile("vou3")){
                $op->voucher3=rand(1000000, 100000000).$request->File('vou3')->getClientOriginalName();
                $request->File('vou3')->move(public_path().'/assets/voucher/',$op->voucher3);;
            }

            if($request->hasFile("vou4")){
                $op->vouche4r=rand(1000000, 100000000).$request->File('vou4')->getClientOriginalName();
                $request->File('vou4')->move(public_path().'/assets/voucher/',$op->vouche4r);;
            }
    
            $op->num_ope = $request->Input("num_ope");
            $op->num_ope2 = $request->Input("num_ope2");
            $op->num_ope3 = $request->Input("num_ope3");
            $op->num_ope4 = $request->Input("num_ope4");
            $op->save();

            return response([
                "success"=>true,
                "mensaje"=>"Operación actualizada correctamente"
            ]);
        }catch(Exception $e){
            return response([
                "success"=>false,
                "mensaje"=>"Error al actualizar la operación"
            ]);
        }
    }
    
    public function iniciarOperacionManual()
    {
        $users = User::select('usuario.*')
                        ->join('users_groups', 'users.id', 'users_groups.user_id')
                        ->join('usuario', 'users.usuario_id', 'usuario.usuario_id')
                        ->whereNotNull('users.usuario_id')
                        ->where('users_groups.group_id', 3)
                        ->get();

        $paises = \App\Modelo\Pais::all();
        $tiposDeDocumento = \App\Modelo\Tiposdocumento::all();
        $ocupaciones = \App\Modelo\Ocupacion::all();
        $cuentasBancarias = \App\Modelo\Cuentabancaria::with("tipo","moneda","banco")->join('banco', 'banco.banco_id', 'cuentabancaria.banco_id')->where("usuario_id", 1)->get();
        $bancos = \App\Modelo\Banco::all();
        $tiposDeMoneda = \App\Modelo\Moneda::all();
        $tiposDeCuenta = \App\Modelo\Tipocuenta::all();
        $origenFondos = \App\Modelo\OrigenFondo::all();
        $discountCodes = \App\Modelo\CodigoDescuento::where('is_active', 1)->get();

        return view('admin.operacion-manual')->with('users', $users)
                                            ->with('paises', $paises)
                                            ->with('tiposDeDocumento', $tiposDeDocumento)
                                            ->with('ocupaciones', $ocupaciones)
                                            ->with('cuentasBancarias', $cuentasBancarias)
                                            ->with('bancos', $bancos)
                                            ->with('tiposDeMoneda', $tiposDeMoneda)
                                            ->with('tiposDeCuenta', $tiposDeCuenta)
                                            ->with('origenFondos', $origenFondos)
                                            ->with('discountCodes', $discountCodes);
    }

    public function guardarOperacionManual(Request $request){
        if(!is_null($request->user_id)){
            $operacion = new \App\Modelo\Operacion();
			$operacion->usuario_id = $request->user_id;
			$operacion->cuentabancariae_id = $request->Input("cuenta_envio_id");
			$operacion->cuentabancariad_id = $request->Input("cuenta_deposito_id");
			$operacion->cuentabancariat_id = $request->Input("cuenta_transfiere_id");
			$operacion->moneda_id = $request->Input("moneda_envia");
			$operacion->tmoneda_id = $request->Input("moneda_recibe");
            $operacion->cambio = $request->Input("cambio");
			$operacion->taza = $request->Input("taza");

			if ($request->Input("monto_con_descuento")) {
                $operacion->monto = $request->Input("monto_con_descuento");

                $discountCode = CodigoDescuento::where('code', $request->Input('discount_code'))->first();

                if ($discountCode) {
                    $operacion->discount_code = $discountCode->code;
                    $operacion->discount_amount = $discountCode->discount;
                }
            }
            else {
                $operacion->monto = $request->Input("monto");
            }

			$operacion->origen_fondo_id = $request->Input("origen_fondo_id");

			if ($request->Input("origen_fondo_id") == 11) {
                $operacion->origen_fondo_otro = $request->Input("origen_fondo_otro");
            }

            if($request->hasFile("vou")){
				$operacion->voucher=rand(1000000, 100000000).$request->File('vou')->getClientOriginalName();
                $request->File('vou')->move(public_path().'/assets/voucher/',$operacion->voucher);;
            }
            if($request->hasFile("vou2")){
				$operacion->voucher2=rand(1000000, 100000000).$request->File('vou2')->getClientOriginalName();
                $request->File('vou2')->move(public_path().'/assets/voucher/',$operacion->voucher2);;
            }
            if($request->hasFile("vou3")){
				$operacion->voucher3=rand(1000000, 100000000).$request->File('vou3')->getClientOriginalName();
                $request->File('vou3')->move(public_path().'/assets/voucher/',$operacion->voucher3);;
            }
            if($request->hasFile("vou4")){
				$operacion->voucher4=rand(1000000, 100000000).$request->File('vou4')->getClientOriginalName();
                $request->File('vou4')->move(public_path().'/assets/voucher/',$operacion->voucher4);;
			}

			$operacion->save();

            $user = User::where("usuario_id", $operacion->usuario_id)->first();
            $userEmail = $user->email;
            $userName =  $user->usuario->empresa ? $user->usuario->razon_social : $user->usuario->primernombre.' '.$user->usuario->segundonombre. ' '.$user->usuario->primeroapellido.' '.$user->usuario->segundoapellido;

            $us = array('email' => $userEmail, 'name' => $userName);
            $dni = $user->usuario->nrodocumento;
            $tipoDocumento = $user->usuario->tiposdocumento->nombre;

            $data = array(
                'operacion' => \App\Modelo\Operacion::with("cuentabancariat","cuentabancariae","cuentabancariad","monedae","monedad","usuario","origen_fondo")->find($operacion->operacion_id),
                'admin' => 1,
                'email_cliente' => $userEmail,
                'dni' => $dni,
                'tipoDocumento' => $tipoDocumento,
                'mensaje' => 'HA HECHO UNA TRANSACCIÓN'
            );

            $admin = \App\User::first();
            $rem = $admin->email;

            Mail::send('mail.operacion', $data, function ($message) use($us, $rem) {
                $message->from($us['email'], $us['name']);
                $message->to($rem,'Operaciones Fortune Online')->subject('Operaciones Fortune Online');
            });

            Mail::send('mail.operacion', $data, function ($message) use($us) {
                $message->from($us['email'], $us['name']);
                $message->to('administracion@fortuneonline.com','Operaciones Fortune Online')->subject('Operaciones Fortune Online');
            });

            return redirect('reporte');
        }else{
            return redirect('home');
        }
    }
}
