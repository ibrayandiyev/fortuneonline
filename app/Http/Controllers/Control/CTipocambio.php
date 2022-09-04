<?php

namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CTipocambio extends Controller{
    public function ftipocambio() {
		$tc=\App\Modelo\Tipocambio::orderBy('tipocambio_id', 'DESC')->first();
		return $tc;
    }
    public function ltipocambio() {
        $tc=\App\Modelo\Tipocambio::whereBetween('created_at', [now()->subdays(45)->startOfDay(), now()->endOfDay()])->get();
        return $tc;
    }
    public function stipocambio(Request $r){
		if(!is_null(Auth::User()->usuario_id)){
			$tc=new \App\Modelo\Tipocambio();
			$tc->compra=$r->Input('compra');
			$tc->venta=$r->Input('venta');
			$tc->created_by=Auth::User()->username;
			$tc->save();
			return $tc;
		}else{
			return redirect('personal_o_empresa');
		}
    }

	public function updateCuantoestaeldolar(Request $request){
		try {
			$token = $this->auth();

			if($token != ''){
				$res = $this->updateRemoteData($token, $request->compra, $request->venta);

				return response()->json([
					'error' => false,
					'token' => $token,
					'response_update' => $res
				]);
			}

			return response()->json([
				'error' => true,
				'message' => "Token empty"
			]);
		} catch (Exception $e) {
			Log::error("updateCuantoestaeldolar ERROR: " . $e->getMessage());
			return response()->json([
				'error' => true,
				'message' => $e->getMessage()
			]);
		}
	}

	public function auth(){
		if (Cache::has('cuantoestaeldolar_token')) {
			return Cache::get('cuantoestaeldolar_token');
		}

		$url = config('exchange-rate.base_url').'/auth';

		$client = new Client();
        $res = $client->request(
            'POST', 
            $url,
            [
				'form_params' => [
					'email' => config('exchange-rate.email'),
					'password' => config('exchange-rate.password'),
				],
            ]
        );

		if($res->getStatusCode() == 200){
			$json = json_decode($res->getBody());
			if($json->status == 200){
				Cache::put('cuantoestaeldolar_token', $json->token, now()->addHours(7));
				return $json->token;
			}
        }

		return '';
	}

	public function updateRemoteData($token, $compra, $venta){
		Log::debug("Nuevo tipo de cambio: compra: " . strval($compra) . ", venta: " . strval($venta));
		$url = config('exchange-rate.base_url').'/actualizar';
		$authorization = "Bearer {$token}";

		$params = array(
			'compra' => strval($compra),
			'venta' => strval($venta)
		);

		$client = new Client();
        $res = $client->request(
            'POST', 
            $url,
            [
				'form_params' => $params,
				'headers' => [
					'Authorization' => $authorization
				]
            ]
        );

		return json_decode($res->getBody());
	}
}
