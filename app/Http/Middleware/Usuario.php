<?php

namespace App\Http\Middleware;

use Closure;

class Usuario{
    public function handle($request, Closure $next){
        if ($request->User()->hasRole('Usuario')) {        	
            return $next($request);
        }
        else{
            abort(403, 'This action is unauthorized.');
        }
    }
}
