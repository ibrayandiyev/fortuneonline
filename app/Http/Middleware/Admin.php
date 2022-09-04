<?php

namespace App\Http\Middleware;

use Closure;

class Admin{
    public function handle($request, Closure $next){
        if ($request->User()->hasRole('Administrators')) {
            return $next($request);
        }
        else{
            abort(403, 'This action is unauthorized.');
        }
    }
}
