<?php

namespace App\Http\Middleware;

use Closure;

class Empresa{
    public function handle($request, Closure $next){
        if ($request->User()->userlevel != 1) {
            \Auth::guard()->logout();
            $request->session()->invalidate();
            return abort(403, 'Usuario inhabilitado.');
        }
        else{
            return $next($request);
        }    
    }
}
