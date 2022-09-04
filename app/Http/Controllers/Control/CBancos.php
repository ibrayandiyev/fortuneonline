<?php

namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelo\Banco;

class CBancos extends Controller{
	public function bancos(){
		return view('admin.bancos');
	}
    public function update(Request $request){
        $banco = Banco::where('banco_id', $request->bank_id)->first();

        if (!$banco) {
            return redirect()->route('lbancos');
        }

        if (isset($request->name)) {
            $banco->nombre = $request->name;
        }

        if (isset($request->is_active)) {
            $banco->is_active = $request->is_active;
        }

        $banco->save();
        return redirect()->route('lbancos');
	}
}
