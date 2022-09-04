<?php

namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelo\CodigoDescuento;

class CCodigoDescuento extends Controller{
	public function codigosdescuento(){
		return view('admin.codigos_descuento');
	}
    public function store(Request $request){
		$discountCode = new CodigoDescuento();

        $discountCode->code = $request->code;
        $discountCode->discount = $request->discount;
        $discountCode->is_active = $request->is_active;

        $discountCode->save();
        return redirect()->route('lcodigosdescuento');
	}
    public function update(Request $request){
        $discountCode = CodigoDescuento::find($request->discount_code_id);

        if (!$discountCode) {
            return redirect()->route('lcodigosdescuento');
        }

        if (isset($request->code)) {
            $discountCode->code = $request->code;
        }

        if (isset($request->discount)) {
            $discountCode->discount = $request->discount;
        }

        if (isset($request->is_active)) {
            $discountCode->is_active = $request->is_active;
        }

        $discountCode->save();
        return redirect()->route('lcodigosdescuento');
	}
}
