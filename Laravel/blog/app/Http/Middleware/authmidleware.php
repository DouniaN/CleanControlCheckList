<?php

namespace App\Http\Middleware;

use Closure;
class authmidleware
{
    /***
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  is an anonymous function  are often used as callback methods and can be used as a parameter in a function. $next 
     * @return mixed
     ***/
    
    public function handle($request, Closure $next)
    {
         if(!session()->has('dataSession')){
            return redirect('login');
         }
         
                
        return $next($request);
    }
}
